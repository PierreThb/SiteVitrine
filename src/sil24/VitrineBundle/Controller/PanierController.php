<?php
/**
 * Created by PhpStorm.
 * User: Pierre
 * Date: 28/03/2017
 * Time: 20:35
 */

namespace sil24\VitrineBundle\Controller;


use sil24\VitrineBundle\Entity\Client;
use sil24\VitrineBundle\Entity\Commande;
use sil24\VitrineBundle\Entity\LigneDeCommande;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use sil24\VitrineBundle\Entity\Panier;
use sil24\VitrineBundle\Entity\Article;
use sil24\VitrineBundle\Entity\Categorie;

class PanierController extends Controller
{

    public function contenuPanierAction(Request $request){
        $session = $request->getSession();
        $panier = $session->get('panier',new Panier());
        $contenu = $panier->getContenu();
        $articles = array();
        $total = 0;

        if(empty($contenu)){
            $this->get('session')->getFlashBag()->add('notice','Votre panier est vide :/');
        }else{
            foreach ($contenu as $id => $qte) {
                $em = $this->getDoctrine()->getManager();
                $article = $em->getRepository(Article::class)->find($id);
                $total += ($article->getPrix())*$qte;
                array_push($articles,$article);
            }
        }

        return $this->render('sil24VitrineBundle:Panier:contenuPanier.html.twig',array(
            'articles'=>$articles,
            'contenu'=>$contenu,
            'total'=>$total
        ));
    }

    public function  ajoutArticleAction(Request $request, $idArticle, $quantite){
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository(Article::class)->find($idArticle);
        $session = $request->getSession();
        $panier = $session->get('panier',new Panier());
        $panier->ajoutArticle($idArticle,$quantite);
        $session->set('panier',$panier);
        $routeName = $session->get('previous_route');

        if($routeName == '_articlesParCategorie'){
            return $this->redirect($this->generateUrl('_articlesParCategorie',array(
                'categorie' => $article->getCategorie()->getId()
            )));
        }else{ //$routeName == '_article'
            return $this->redirect($this->generateUrl('_article',array(
                'article' => $article->getId()
            )));
        }
    }

    public function removeArticleAction(Request $request, $idArticle){
        $session = $request->getSession();
        $panier = $session->get('panier',new Panier());
        $panier->supprimeArticle($idArticle);
        $session->set('panier',$panier);

        return $this->redirect($this->generateUrl('_contenuPanier'));
    }

    public function viderPanierAction(Request $request){
        $session = $request->getSession();
        $panier = $session->get('panier');
        $panier->viderPanier();
        $session->set('panier',$panier);
        return $this->redirect($this->generateUrl('_contenuPanier'));
    }

    public function sideBarContenuPanierAction(Request $request){
        $session = $request->getSession();
        $panier = $session->get('panier',new Panier());
        $contenu = $panier->getContenu();
        $articles = array();

        if(empty($contenu)){
            $this->get('session')->getFlashBag()->add('notice','Votre panier est vide :/');
        }else{
            foreach ($contenu as $id => $qte) {
                $em = $this->getDoctrine()->getManager();
                $article = $em->getRepository(Article::class)->find($id);
                array_push($articles,$article);
            }
        }

        return $this->render('sil24VitrineBundle:Panier:sideBarContenuPanier.html.twig',array(
            'articles'=>$articles,
            'contenu'=>$contenu
        ));
    }

    public function validationPanierAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $panier = $session->get('panier', new Panier());
        $contenu = $panier->getContenu();
        $commande = new Commande();
        $client = $this->getUser();

        if(!empty($contenu)){
            $dayDate = date("d/m/Y");
            $commande->setAllParamsCommande('15-04-2017',0,$client);

            foreach ($contenu as $id => $qte) {
                $article = $em->getRepository('sil24VitrineBundle:Article')->find($id);

                $ligneDeCommande = new LigneDeCommande();
                $ligneDeCommande->setAllParams($article,$qte,$article->getPrix(),$commande);
                $commande->addLignesDeCommande($ligneDeCommande);

                $em->persist($ligneDeCommande);
            }
            $em->persist($commande);
            $em->flush();
            $panier->viderPanier();
            $session->set('panier',$panier);
        }
        return $this->redirect($this->generateUrl('_confirmation',array(
            'idCommande' => $commande->getId()
        )));
    }
}