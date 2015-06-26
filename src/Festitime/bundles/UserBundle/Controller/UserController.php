<?php

namespace Festitime\bundles\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Festitime\DatabaseBundle\Document\User;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

class UserController extends Controller
{
    public function loginAction()
    {
        $session = $this->container->get('session');
        $userService = $this->container->get('festitime.user_service');
        $query = $this->container->get('request_stack')->getCurrentRequest()->request->all();

        if (!empty($query['connect']['pseudo'])) {
            $response = $userService->connectUser();

            if ($response instanceof User) {
                $session->set('user_id', $response->getId());
                $session->set('user_pseudo', $response->getPseudo());

                return $this->redirect($this->generateUrl('index'));
            }
        }
        $formConnect = $userService->getConnectForm();
        $formRegister = $userService->getRegisterForm();
        return $this->render(
            'FestitimeUserBundle:User:index.html.twig',
            array(  'formConnect' => $formConnect->createView(),
                    'formRegister' => $formRegister->createView()
            )
        );
    }

    /**
     * @author Romain Grelet
     *
     * login with OAuth2
     * @param  string $provider
     */
    public function loginOauthAction($provider, Request $request)
    {
        $session = $this->container->get('session');
        $homeUrl = $this->generateUrl('home');

        if ($session->has('accessToken') && $session->has('user')) {
            return $this->redirect($homeUrl);
        }

        if ($provider == 'google') {
            $this->client = $this->get('google.oauth_provider')->getGoogleClient();
            $this->client->setScopes(array('email', 'profile'));
            $this->client->setApprovalPrompt('auto');
            $code = $request->query->get('code');
            if ($code) {
                $this->client->authenticate($code);
                if ($this->client->getAccessToken()) {
                    $userService = $this->container->get('festitime.user_service');
                    $this->client->setAccessToken($this->client->getAccessToken());

                    // get user infos
                    $this->oauth2 = $this->get('festitime.google_oauth_provider');
                    $userData = $this->oauth2->getUserInfos();

                    $user = $userService->getUserBy(array('email' => $userData['email']));

                    if (is_null($user)) {
                        $user = $userService->postUserFromOAuth($userData);
                    }

                    $session->set('accessToken', $this->client->getAccessToken());
                    $session->set('user', $user->toArray());

                    return $this->redirect($homeUrl);
                }
            }
        }

        return $this->redirect($homeUrl);
    }

    /**
     * @author Romain Grelet
     * logout action
     */
    public function logoutAction()
    {
        $session = $this->container->get('session');
        if ($session->has('user_id')) {
            $session->invalidate();
            return $this->redirect($this->generateUrl('login'));
        }
        if ($session->has('user')) {
            $session->invalidate();
            return $this->redirect($this->generateUrl('home'));
        }
    }

    public function postUserAction()
    {
        $userService = $this->container->get('festitime.user_service');
        $response = $userService->postUser();

        if ($response instanceof User) {
            // $this->get('session')->getFlashBag()->add('success', 'Votre compte a bien été créé');
            return $this->redirect($this->generateUrl('home'));
        } else {
            // $this->get('session')->getFlashBag()->add('error', 'Le formulaire comporte des erreurs');
            return $this->forward('FestitimeUserBundle:User:login');
        }
    }

    public function paymentAction(Request $request)
    {
        $session = $request->getSession();
        $postData = $request->request->all();
        $paypalProvider = $this->get('festitime.paypal_provider');
        $payer = $paypalProvider->getNewPayer();

        //get Ticket and add it to the ItemList
        $ticket = $paypalProvider->findTicket($postData['chosen_ticket']);
        $paypalProvider->addItemToList(
            $paypalProvider->getItemFromTicket($ticket, $postData['chosen_ticket_quantity'])
        );
        if (!empty($postData['chosen_hotel'])) {
            $hotel = $paypalProvider->findHotel($postData['chosen_hotel']);
            $paypalProvider->addItemToList(
                $paypalProvider->getItemFromHotel($hotel, $postData['chosen_hotel_quantity'])
            );
        }
        if (!empty($postData['chosen_travel_name'])) {
            $paypalProvider->addItemToList(
                $paypalProvider->getItemFromTravelData(
                    $postData['chosen_travel_name'],
                    $postData['chosen_travel_quantity'],
                    $postData['chosen_travel_price']
                )
            );
        }

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($this->generateUrl('paymentStatus', array(), true))
            ->setCancelUrl($this->generateUrl('paymentStatus', array(), true));

        $payment = $paypalProvider->getPayment(
            $payer,
            $redirectUrls,
            $paypalProvider->getTransaction()
        );

        try {
            $payment->create($paypalProvider->getApiContext());
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                echo "Exception: " . $ex->getMessage() . PHP_EOL;
                $err_data = json_decode($ex->getData(), true);
                exit;
            } else {
                die('Some error occur, sorry for inconvenient');
            }
        }
        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirectUrl = $link->getHref();
                break;
            }
        }

        $session->set('paypal_payment_id', $payment->getId());
        $paypalProvider->saveOrder($payment->getId());

        if(isset($redirectUrl)) {
            // redirect to paypal
            return $this->redirect($redirectUrl);
        }

        return $this->redirect($this->generateUrl('home'));
    }

    public function paymentStatusAction(Request $request)
    {
        $paypalProvider = $this->get('festitime.paypal_provider');

        // Get the payment ID before session clear
        $session = $request->getSession();
        $paymentIdSession = $session->get('paypal_payment_id');
        // clear the session payment ID
        $session->remove('paypal_payment_id');

        $paymentId = $request->query->get('paymentId');
        $token = $request->query->get('token');
        if (empty($paymentId) || empty($token)) {
            die('here');
            return Redirect::route('home')
                ->with('error', 'Payment failed');
        }

        $payment = Payment::get($paymentId, $paypalProvider->getApiContext());
        $execution = new PaymentExecution();
        $execution->setPayerId($request->query->get('PayerID'));

        // Execute the payment
        $result = $payment->execute($execution, $paypalProvider->getApiContext());
        // ini_set('xdebug.var_display_max_depth', 30);
// die(var_dump($result));
//         echo '<pre>';print_r($result);echo '</pre>';exit;  //  DEBUG RESULT, remove it later
        if ($result->getState() == 'approved') { // payment made
            $paypalProvider->validateOrder($paymentId);
            $session->getFlashBag()->add('success', "Votre commande a bien été validée. Toute l'équipe Festitime vous remercie pour votre achat.");
        } else {
            $session->getFlashBag()->add('error', "Une erreur c'est produise durant le payement. Nous vous prions de bien vouloir recommencer.");
        }
        return $this->redirect($this->generateUrl('home'));
    }

    public function testAction(Request $request)
    {
        $session = $request->getSession();
        $session->getFlashBag()->add('success', 'test la efp eezfp pjoejfj zepoz jfe pf');
        return $this->redirect($this->generateUrl('home'));
    }
}
