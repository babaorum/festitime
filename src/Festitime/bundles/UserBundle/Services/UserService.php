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
    protected $formTool;

    public function __construct($request, $doctrineMongodb, $form, $formConnect, $formRegister, $formTool)
    {
        $this->request = $request;
        $this->mongoManager = $doctrineMongodb->getManager();
        $this->form = $form;
        $this->formConnect = $formConnect;
        $this->formRegister = $formRegister;
        $this->formTool = $formTool;
    }

    public function getUsers()
    {
        $R_user = $this->mongoManager->getRepository('FestitimeUserBundle:User');
        $users = $R_user->findAll();
        return $users;
    }

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
