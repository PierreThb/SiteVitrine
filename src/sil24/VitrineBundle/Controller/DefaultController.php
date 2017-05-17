<?php

namespace sil24\VitrineBundle\Controller;

use sil24\VitrineBundle\Entity\Article;
use sil24\VitrineBundle\Entity\Categorie;
use sil24\VitrineBundle\Entity\Panier;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
/*        $client = $em->getRepository('sil24VitrineBundle:Client')->find(1);*/
        $client = $this->getUser();

        if($client == null){
            $client = 'anon';
        }

        $categories = $em->getRepository('sil24VitrineBundle:Categorie')->findAll();

        $session = $request->getSession();

        $session->set('client',$client);
        $session->set('categories',$categories);

        $articles = $em->getRepository('sil24VitrineBundle:Article')->findAll();

        return $this->render('sil24VitrineBundle:Default:index.html.twig',array(
            'articles'=>$articles
        ));
    }
    
    public function mentionsAction(Request $request){
        return $this->render('sil24VitrineBundle:Default:mentions.html.twig');
    }
}
