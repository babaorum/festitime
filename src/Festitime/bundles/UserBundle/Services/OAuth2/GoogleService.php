<?php

namespace Festitime\bundles\UserBundle\Services\OAuth2;

/** 
*   Interface Google OAuth2 Service with Festitime application
*/
class GoogleService extends \Google_Service_Oauth2
{
    protected $googleClient;

    public function __construct($googleApi)
    {
        $this->googleClient = $googleApi->getGoogleClient();
        parent::__construct($this->googleClient);
    }

    public function getUserInfos()
    {
        $userInfos = $this->userinfo->get();
        $userData = array(
            'email' => $userInfos->email,
            'name' => $userInfos->familyName,
            'firstname' => $userInfos->givenName,
            'gender' => $userInfos->gender,
            'picture' => $userInfos->picture
        );
        
        return $userData;
    }
}
