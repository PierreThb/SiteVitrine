<?php

namespace sil24\VitrineBundle\Controller;

use sil24\VitrineBundle\Entity\Article;
use sil24\VitrineBundle\Entity\Commande;
use sil24\VitrineBundle\Entity\LigneDeCommande;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Commande controller.
 *
 */
class CommandeController extends Controller
{

    public function commandesAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $client = $this->getUser();

        $commandes = $em->getRepository('sil24VitrineBundle:Commande')->getCommandesForOneClient($client);

        return $this->render('sil24VitrineBundle:commande:index.html.twig', array(
            'commandes' => $commandes,
        ));
    }

    public function commandeAction(Request $request, $commande){
        $em = $this->getDoctrine()->getManager();
        $articles = array();
        $user = $this->getUser();
        $total = 0;

        $cmd = $em->getRepository(Commande::class)->find($commande);
        $lignes = $em->getRepository(LigneDeCommande::class)->findBy(array(
            'commande' => $commande
        ));

        foreach ($lignes as $ligne){
            $article = $em->getRepository(Article::class)->find($ligne->getArticle()->getId());
            $articles[$article->getId()] = $ligne->getQuantite();
            $total += $article->getPrix() * $ligne->getQuantite();
        }

        return $this->render('sil24VitrineBundle:Commande:commande.html.twig',array(
            'commande' => $cmd,
            'lignes' => $lignes,
            'articles' => $articles,
            'total' => $total
        ));
    }

    public function confirmationAction(Request $request, $idCommande){
        $em = $this->getDoctrine()->getManager();
        $articles = array();
        $user = $this->getUser();
        $total = 0;

        $commande = $em->getRepository(Commande::class)->find($idCommande);
        $lignes = $em->getRepository(LigneDeCommande::class)->findBy(array(
            'commande' => $commande
        ));

        foreach ($lignes as $ligne){
            $article = $em->getRepository(Article::class)->find($ligne->getArticle()->getId());
            $articles[$article->getId()] = $ligne->getQuantite();
            $total += $article->getPrix() * $ligne->getQuantite();
            $stock = $article->getStock();
            $stock -= $ligne->getQuantite();
            $article->setStock($stock);
            $em->persist($article);
        }
        $em->flush();

        $to = $user->getEmail();
        $from = 'queenjouet@confirm.com';
        $subject = 'Votre commande Queen Jouet';
        $body = $this->render('sil24VitrineBundle:Commande:confirm_mail.html.twig',array(
            'commande' => $commande,
            'lignes' => $lignes,
            'articles' => $articles,
            'total' => $total
        ));

        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom($from)
            ->setTo($to)
            ->setBody($body,'text/html');

        $mailer = $this->get('mailer');
        $mailer->send($message);

        return $this->render('sil24VitrineBundle:Commande:confirmationCommande.html.twig',array(
            'commande' => $commande,
            'lignes' => $lignes,
            'articles' => $articles,
            'total' => $total
        ));
    }

    /**
     * Lists all commande entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $commandes = $em->getRepository('sil24VitrineBundle:Commande')->findAll();

        return $this->render('sil24VitrineBundle:commande:index.html.twig', array(
            'commandes' => $commandes,
        ));
    }

    /**
     * Creates a new commande entity.
     *
     */
    public function newAction(Request $request)
    {
        $commande = new Commande();
        $form = $this->createForm('sil24\VitrineBundle\Form\CommandeType', $commande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commande);
            $em->flush();

            return $this->redirectToRoute('commande_show', array('id' => $commande->getId()));
        }

        return $this->render('sil24VitrineBundle:commande:new.html.twig', array(
            'commande' => $commande,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a commande entity.
     *
     */
    public function showAction(Commande $commande)
    {
        $deleteForm = $this->createDeleteForm($commande);

        return $this->render('sil24VitrineBundle:commande:show.html.twig', array(
            'commande' => $commande,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing commande entity.
     *
     */
    public function editAction(Request $request, Commande $commande)
    {
        $deleteForm = $this->createDeleteForm($commande);
        $editForm = $this->createForm('sil24\VitrineBundle\Form\CommandeType', $commande);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('commande_edit', array('id' => $commande->getId()));
        }

        return $this->render('sil24VitrineBundle:commande:edit.html.twig', array(
            'commande' => $commande,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a commande entity.
     *
     */
    public function deleteAction(Request $request, Commande $commande)
    {
        $form = $this->createDeleteForm($commande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($commande);
            $em->flush();
        }

        return $this->redirectToRoute('commande_index');
    }

    /**
     * Creates a form to delete a commande entity.
     *
     * @param Commande $commande The commande entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Commande $commande)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('commande_delete', array('id' => $commande->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
