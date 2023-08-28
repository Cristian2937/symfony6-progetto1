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
        $post = $microPost->find(4)->setText("New post updated");
        $microPost->save($post,true);

        //dd($microPost->findAll());

        return $this->render('micro_post/index.html.twig', [
            'controller_name' => 'MicroPostController',
            "posts" => $microPost->findAll(),
        ]);
    }
}
