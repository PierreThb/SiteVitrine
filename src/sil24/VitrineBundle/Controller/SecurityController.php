<?php
/**
 * Created by PhpStorm.
 * User: Pierre
 * Date: 01/04/2017
 * Time: 18:26
 */

namespace sil24\VitrineBundle\Controller;

use sil24\VitrineBundle\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller{

    public function loginAction(Request $request){
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('sil24VitrineBundle:Security:login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

    public function choixAction(Request $request){
        $client = $this->getUser();

        if($client == null){
            return $this->render('sil24VitrineBundle:security:choix_login.html.twig');
        }else{
            return $this->redirectToRoute('_monCompte', array(
                'client' => $client
            ));
        }

    }
}