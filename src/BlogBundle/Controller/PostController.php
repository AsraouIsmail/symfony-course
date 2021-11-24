<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use BlogBundle\Entity\Post;
use BlogBundle\Entity\Image;
use BlogBundle\Form\PostType;

// use Symfony\Component\Form\Extension\Core\Type\FormType;
// use Symfony\Component\Form\Extension\Core\Type\TextType;
// use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
// use Symfony\Component\Form\Extension\Core\Type\SubmitType;
// use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;

class PostController extends Controller
{
    /**
     * 
     * @Route("/post/create", name="create_post")
     */

    public function createAction(Request $request)
    {

        
        // utiliser le service doctrine et le service manager
        $em = $this->getDoctrine()->getManager();

        //instancier Entity Post
        $post = new Post();


        $formPost = $this->get('form.factory')->createBuilder(PostType::class, $post);
                            // ->add('title', TextType::class)
                            // ->add('description', TextType::class)
                            // ->add('slug', TextareaType::class)
                            // ->add('active', CheckboxType::class)
                            // ->add('enregistrer', SubmitType::class);

                            $form = $formPost->getForm();


                            if ($request->isMethod('POST')) {
                                

                                $form->handleRequest($request);

                                if ($form->isValid()) {

                                    $file = $post->getImage()->getUrl();

                                    $fileName = $file->getClientOriginalName().'.'.$file->guessExtension();

                                    $file->move($this->getParameter('uploads_directory').'/posts', $fileName);

                                    $post->getImage()->setUrl($fileName);
                                        //recupere les categories de la base de donnes
                                    $categories = $em->getRepository("BlogBundle:Category")->findAll();


                                    foreach ($categories as $category) {
                                        $post->addCategory($category);
                                    }

                                    $repositoryAuthor =  $em->getRepository("BlogBundle:Author");
            
                                    $author = $repositoryAuthor->find(2);

                                    //associer author recupere de la base de donnes a l'objet post

                                    $post->setAuthor($author);
                                    //fonction pour associer l'objet image avec l'objet post
                                    // $post->setImage($image);

                                    //persister l'objet dans la base de donnees

                                    $em->persist($post);

                                    $em->flush();

                                    $request->getSession()->getFlashBag()->add('success', "un nouveau post a etait bien ajouter!!");

                                    return $this->redirectToRoute("index_post");

                                   
                                }


                               
                                                                                
                               
                            }


                            return $this->render('@Blog/Post/create.html.twig', ['formulaire' => $form->createView()]);

        
    }
    /**
     * @Route("/post/show")
     */

    public function showAction()
    {
        // return $this->render('@Blog/Post/show.html.twig');

        //use getRepository to get the data from the database

    //    $repositoryPost = $this->getDoctrine()->getRepository("BlogBundle:Post");

    //    $posts =  $repositoryPost->findAll(); 

        //    $postById =$repositoryPost->find(2);

        // $postByTitle = $repositoryPost->findOneByTitle("RAJA CLUB ATHLETIC present son nouveau entraineur");

        //   var_dump($posts);

        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery("SELECT p FROM BlogBundle:Post p");

        $posts = $query->getResult();
       echo "<pre>", print_r($posts) ,"</pre>";

      return new Response("data was fetched successfully");

    }

    /**
     * @Route("/post", name="index_post")
     */
    public function indexAction()
    {
        // $data = [
        //     [
        //         "id" => 1,
        //         "titre" => "Symfony Tutorials",
        //         "post" => "RAJA CLUB ATHLETIC signe un contrat de deux ans avec l'entraineur Belge Wilmots",
        //         "date" => date('Y-m-d')
        //     ],
        //     [
        //         "id" => 2,
        //         "titre" => "Symfony Tutorials",
        //         "post" => "RAJA CLUB ATHLETIC resilie son contrat avec le coach tunisien",
        //         "date" => date('Y-m-d')
        //     ],
        //     [
        //         "id" => 3,
        //         "titre" => "Symfony Tutorials",
        //         "post" => "RAJA CLUB ATHLETIC Aniss Mahfoud nouveau president elu par les adherants rajaouis",
        //         "date" => date('Y-m-d')
        //     ]
        //     ];

        //afficher et recupere la liste des post de la base de donnes
       $repositoryPost = $this->getDoctrine()->getManager()->getRepository("BlogBundle:Post");

       $posts = $repositoryPost->findAll();

        return $this->render('@Blog/Post/index.html.twig', ["posts" => $posts]);

        // return $this->appel();

        // return $this->showData();
    }

    public function appel()
    {
        return new Response('je suis dans la methode appel');
    }

    public function showData()
    {
        return $this->json(['username' => 'jane.doe']);
    }

}
