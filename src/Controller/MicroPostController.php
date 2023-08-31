<?php

namespace App\Controller;

use DateTime;
use App\Entity\MicroPost;
use App\Form\MicroPostType;
use App\Repository\MicroPostRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class MicroPostController extends AbstractController
{
    #[Route('/micro/post', name: 'app_micro_post')]
    public function index(MicroPostRepository $microPost): Response
    {
        // QUESTO E' UN POSSIBILE MODO PER AGGIUNGERE I POST, MA E' FATTO A MANO QUINDI MEGLIO EVITARE
        // $microPost1 = new MicroPost();
        // $microPost1->setTitle("Fourth post");
        // $microPost1->setText("New post");
        // $microPost1->setCreated(new DateTime());

        // $microPost->save($microPost1,true);
        /*
            E' POSSIBILE TROVARE I RECORD E FARLI VEDERE IN PAGINA
            ATTRAVERSO IL METODO FIND() DEL REPOSITORY CHE CERCA
            IN BASE ALL'ID FORNITO
        */

        return $this->render('micro_post/index.html.twig', [
            'controller_name' => 'MicroPostController',
            "posts" => $microPost->findAll(),
        ]);
    }

    #[Route('/micro/post/show/{id<\d+>}', name: 'app_micro_post_show')]
    public function showOne(int $id, MicroPostRepository $microPostOne): Response
    {
        //dd($microPostOne->find($id));
        return $this->render('micro_post/show.html.twig',[
            'post'=>$microPostOne->find($id),
            ]
        );
    }

    #[Route('/micro/post/add', name:'app_micro_post_add',methods:['GET','POST'])]
    public function add(Request $request, MicroPostRepository $posts): Response
    {

        $microPost = new MicroPost();
        $form = $this->createForm(MicroPostType::class,$microPost);
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $post = $form->getData();
            $post->setCreated(new DateTime());
            
            $posts->save($post,true);
            
            $this->addFlash('success','Post saved correctly');
            return $this->redirectToRoute('app_micro_post');
        }

        return $this->renderForm('micro_post/add.html.twig',
            [
                'form' => $form
            ]
        );
    }

    #[Route('/micro/post/{id}/edit', name:'app_micro_post_edit',methods:['GET','POST'])]
    public function edit(int $id,Request $request, MicroPostRepository $posts): Response
    {
        $found = $posts->findOneBy(['id' => $id ]);

        $form = $this->createForm(MicroPostType::class,$found);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $post = $form->getData();

            $posts->save($post,true);
            
            $this->addFlash('success','Post updated correctly');
            return $this->redirectToRoute('app_micro_post');
        }

        return $this->renderForm('micro_post/add.html.twig',
            [
                'form' => $form
            ]
        );
    }
}
