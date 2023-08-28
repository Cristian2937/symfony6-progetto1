<?php

namespace App\Controller;

use App\Entity\MicroPost;
use App\Repository\MicroPostRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
        $post = $microPost->find(4)->setText("New post updated");
        $microPost->save($post,true);

        return $this->render('micro_post/index.html.twig', [
            'controller_name' => 'MicroPostController',
            "posts" => $microPost->findAll(),
        ]);
    }

    #[Route('/micro/post/show/{id<\d+>}', name: 'app_micro_post_show',methods:['GET'])]
    public function showOne(int $id, MicroPostRepository $microPostOne): Response
    {
        //dd($microPostOne->find($id));
        return $this->render('micro_post/show.html.twig',[
            'post'=>$microPostOne->find($id),
            ]
        );
    }
}
