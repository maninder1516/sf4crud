<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Article;
use App\Form\ArticleType;

class ArticleController extends AbstractController {

    /**
     * @Route("/article", name="article")
     */
    public function index() {
        return $this->render('article/index.html.twig', [
                    'controller_name' => 'ArticleController',
        ]);
    }

    /**
     * Create the Article
     * @param Request $request
     * @return type
     */
    public function createArticle(Request $request) {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $article = $form->getData();

            // Get the entity manager and save the entity
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            // Redirect to the VIEW page
            return $this->redirect('/view-article/' . $article->getId());
        }

        return $this->render('article/edit.html.twig', ['form' => $form->createView()]);        
    }

    /**
     * View the Article
     * @param type $id
     * @return type
     * @throws type
     */
    public function viewArticle($id) {
        $article = $this->getDoctrine()
                ->getRepository('App\Entity\Article')
                ->find($id);

        if (!$article) {
            throw $this->createNotFoundException(
                    'There are no articles with the following id: ' . $id
            );
        }

        return $this->render(
                        'view.html.twig',
                        array('article' => $article)
        );
    }

    /**
     * Show the Article
     * @return type
     */
    public function showArticles() {
        $articles = $this->getDoctrine()
                ->getRepository('App\Entity\Article')
                ->findAll();

        return $this->render(
                        'show.html.twig',
                        array('articles' => $articles)
        );
    }

    /**
     * Delete the Article
     * @param type $id
     * @return type
     * @throws type
     */
    public function deleteArticle($id) {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('App\Entity\Article')->find($id);

        if (!$article) {
            throw $this->createNotFoundException(
                    'There are no articles with the following id: ' . $id
            );
        }

        $em->remove($article);
        $em->flush();

        return $this->redirect('/show-articles');
    }

    /**
     *  Update the Article
     * @param Request $request
     * @param type $id
     * @return type
     * @throws type
     */
    public function updateArticle(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('App\Entity\Article')->find($id);

        if (!$article) {
            throw $this->createNotFoundException(
                    'There are no articles with the following id: ' . $id
            );
        }

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $article = $form->getData();
            $em->flush();
            return $this->redirect('/view-article/' . $id);
        }

        return $this->render(
                        'edit.html.twig',
                        array('form' => $form->createView())
        );
    }

}
