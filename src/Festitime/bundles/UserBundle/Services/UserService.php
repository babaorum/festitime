<?php

namespace Festitime\bundles\UserBundle\Services;

use Festitime\DatabaseBundle\Document\User;

class UserService
{
    /**
     * @var RequestStack
     */
    protected $request;

    /**
     * @var MongoManager
     */
    protected $mongoManager;

    /**
     * @var FormBuilder
     */
    protected $form;

    /**
     * @var ConnectType
     */
    protected $formConnect;

    /**
     * @var RegisterType
     */
    protected $formRegister;

    /**
     * @var FormTool
     */
    protected $formTool;

    /**
     * @var GoogleService
     */
    protected $googleClient;

    /**
     * @param RequestStack
     * @param MongoManager
     * @param FormBuilder
     * @param ConnectType
     * @param RegisterType
     * @param FormTool
     * @param GoogleService
     */
    public function __construct($request, $doctrineMongodb, $form, $formConnect, $formRegister, $formTool, $googleClient)
    {
        $this->request = $request;
        $this->mongoManager = $doctrineMongodb->getManager();
        $this->form = $form;
        $this->formConnect = $formConnect;
        $this->formRegister = $formRegister;
        $this->formTool = $formTool;
        $this->googleClient = $googleClient;
    }

    /**
     * Get a user by id
     *
     * @param  int    $i
     *
     * @return User|null
     */
    public function getUser($id)
    {
        $user = $this->mongoManager->find('FestitimeDatabaseBundle:User', $id);
        return $user;
    }

    /**
     * Get a user by an array of conditions
     *
     * @param  array     $where
     *
     * @return User|null
     */
    public function getUserBy(array $where)
    {
        $R_user = $this->mongoManager->getRepository('FestitimeDatabaseBundle:User');
        $user = $R_user->findOneBy($where);
        return $user;
    }

    /**
     * Get all users
     *
     * @return array|null
     */
    public function getUsers()
    {
        $R_user = $this->mongoManager->getRepository('FestitimeDatabaseBundle:User');
        $users = $R_user->findAll();
        return $users;
    }

    /**
     * Add a new User
     *
     * @return User|array
     */
    public function postUser()
    {
        $request = $this->request->getCurrentRequest();

        $user = new User();
        $form = $this->form->create($this->formRegister, $user);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->mongoManager->persist($user);
            $this->mongoManager->flush();

            return $user;
        }

        return $this->formTool->getAllFormErrors($form);
    }

    /**
     * Add a new User from OAuth2
     * @param  array  $userData
     * @return User
     */
    public function postUserFromOAuth(array $userData)
    {
        $user = new User();

        $user->setEmail($userData['email'])
            ->setName($userData['name'])
            ->setFirstname($userData['firstname'])
            ->setGender($userData['firstname'])
            ->setPicture($userData['picture'])
        ;

        $this->mongoManager->persist($user);
        $this->mongoManager->flush();

        return $user;
    }

    /**
     * Give us the connect form
     *
     * @return ConnectForm
     */
    public function getConnectForm()
    {
        $user = new User();
        $form = $this->form->create($this->formConnect, $user);
        return $form;
    }

    /**
     * Give us the register form
     *
     * @return RegisterForm
     */
    public function getRegisterForm($user = null)
    {
        if (!$user) {
            $user = new User();
        }

        $form = $this->form->create($this->formRegister, $user);
        return $form;
    }

    /**
     * Connect the request user
     *
     * @return User|false
     */
    public function connectUser()
    {
        $R_user = $this->mongoManager->getRepository('FestitimeDatabaseBundle:User');
        $request = $this->request->getCurrentRequest();
        $query = $request->request->all();

        if (!empty($query['submit'])) {
            $user = $R_user->findOneBy(array('pseudo' => $query['connect']['pseudo']));
            if (!is_null($user) && $user->getPassword() === $query['connect']['password']) {
                return $user;
            }
        }
        return false;
    }
}
