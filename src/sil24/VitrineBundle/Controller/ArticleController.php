<?php

namespace sil24\VitrineBundle\Controller;

use sil24\VitrineBundle\Entity\Article;
use sil24\VitrineBundle\Entity\Categorie;
use sil24\VitrineBundle\Entity\Panier;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Article controller.
 *
 */
class ArticleController extends Controller
{

    public function catalogueAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository(Categorie::class)->findAll();

        if(!$categories){
            throw $this->createNotFoundException('Aucune catégories trouvés');
        }

        return $this->render('sil24VitrineBundle:Article:catalogue.html.twig',array(
            'categories'=>$categories
        ));
    }

    public function articlesParCategorieAction(Request $request, $categorie){
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $panier = $session->get('panier', new Panier());

        $cat = $em->getRepository(Categorie::class)->find($categorie); //récupère current cat
        $session->set('categorie',$categorie); //enregistre cat dans session
        $contenu = $panier->getContenu(); //recupère le contenu du panier
        $routeName = $request->get('_route'); //récupère current route name
        $session->set('previous_route',$routeName); //enregistre route dans session
        $articles = $em->getRepository(Article::class)->findBy(array(
            'categorie'=>$cat // récupère tous les articles en fonction de la catégorie
        ));

        return $this->render('sil24VitrineBundle:Article:articlesParCategorie.html.twig',array(
            'categorie' => $cat,
            'articles' => $articles,
            'contenu' => $contenu
        ));
    }

    public function plusVenduAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $articles = $em->getRepository('sil24VitrineBundle:Article')->getTopArticle(3);
        $topArticles = Array();

        for($i = 0; $i < sizeof($articles); $i++){
            $em = $this->getDoctrine()->getManager();
            $article = $em->getRepository(Article::class)->find($articles[$i]['art']->getId());
            array_push($topArticles,$article);
        }

        return $this->render('sil24VitrineBundle:Article:plusVendu.html.twig',array(
            'articles'=>$topArticles
        ));
    }

    public function ficheArticleAction(Request $request, $article){
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();

        $articleObj = $em->getRepository('sil24VitrineBundle:Article')->find($article);
        $panier = $session->get('panier', new Panier());
        $contenu = $panier->getContenu();
        $routeName = $request->get('_route');
        $session->set('previous_route',$routeName);

        return $this->render('sil24VitrineBundle:Article:ficheArticle.html.twig',array(
            'article' => $articleObj,
            'contenu' => $contenu
        ));
    }

    /**
     * Lists all article entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $articles = $em->getRepository('sil24VitrineBundle:Article')->findAll();

        return $this->render('sil24VitrineBundle:Article:index.html.twig', array(
            'articles' => $articles,
        ));
    }

    /**
     * Creates a new article entity.
     *
     */
    public function newAction(Request $request)
    {
        $article = new Article();
        $form = $this->createForm('sil24\VitrineBundle\Form\ArticleType', $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('article_show', array('id' => $article->getId()));
        }

        return $this->render('sil24VitrineBundle:Article:new.html.twig', array(
            'article' => $article,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a article entity.
     *
     */
    public function showAction(Article $article)
    {
        $deleteForm = $this->createDeleteForm($article);

        return $this->render('sil24VitrineBundle:Article:show.html.twig', array(
            'article' => $article,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing article entity.
     *
     */
    public function editAction(Request $request, Article $article)
    {
        $deleteForm = $this->createDeleteForm($article);
        $editForm = $this->createForm('sil24\VitrineBundle\Form\ArticleType', $article);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('article_edit', array('id' => $article->getId()));
        }

        return $this->render('sil24VitrineBundle:Article:edit.html.twig', array(
            'article' => $article,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a article entity.
     *
     */
    public function deleteAction(Request $request, Article $article)
    {
        $form = $this->createDeleteForm($article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($article);
            $em->flush();
        }

        return $this->redirectToRoute('article_index');
    }

    /**
     * Creates a form to delete a article entity.
     *
     * @param Article $article The article entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Article $article)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('article_delete', array('id' => $article->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
