<?php

namespace Festitime\bundles\UserBundle\Services;

use Festitime\bundles\UserBundle\Document\User;

class UserService
{
    protected $request;
    protected $mongoManager;
    protected $form;
    protected $formConnect;
    protected $formRegister;

    public function getUsers()
    {
        $R_user = $this->mongoManager->getRepository('FestitimeUserBundle:User');
        $users = $R_user->findAll();
        return $users;
    }

    public function __construct($request, $doctrineMongodb, $form, $formConnect, $formRegister)
    {
        $this->request = $request;
        $this->mongoManager = $doctrineMongodb->getManager();
        $this->form = $form;
        $this->formConnect = $formConnect;
        $this->formRegister = $formRegister;
    }

    public function postUser()
    {
        $request = $this->request->getCurrentRequest();
        $query = $request->request->all();
        die(var_dump($query));
        if (!empty($query['submit']))
        {
            //$query non-object
            if ($query->isValid()) {
                // fait quelque chose comme sauvegarder la tâche dans la bdd

                return $this->redirect($this->generateUrl('task_success'));
            }
            /*$user = new User();
            if(!empty($query['user']['pseudo']) && !empty($query['user']['password']))
            {
                $user->setPseudo($query['user']['pseudo']);
                $user->setPassword($query['user']['password']);

                $this->mongoManager->persist($user);
                $this->mongoManager->flush();
                
                return $user;
            }*/
        }
        return null;
    }

    public function getConnectForm()
    {
        $user = new User();
        $form = $this->form->create($this->formConnect, $user);
        return $form;
    }

    public function getRegisterForm()
    {
        $user = new User();
        $form = $this->form->create($this->formRegister, $user);
        return $form;
    }

    public function connectUser()
    {
        $R_user = $this->mongoManager->getRepository('FestitimeUserBundle:User');   
        $request = $this->request->getCurrentRequest();
        $query = $request->request->all();

        if(!empty($query['submit']))
        {
            $user = $R_user->findOneBy(array('pseudo' => $query['connect']['pseudo']));
            if(!is_null($user) && $user->getPassword() === $query['connect']['password'])
            {
                return $user;
            }
        }
        return false;
    }
}
