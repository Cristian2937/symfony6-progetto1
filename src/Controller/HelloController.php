<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HelloController extends AbstractController
{

    private array $messages = [
        ['message' => 'Hello', 'created' => '2022/06/12'],
        ['message' => 'Hi', 'created' => '2023/04/12'],
        ['message' => 'Bye!', 'created' => '2021/05/12']
    ];

    #[Route('/{limit<\d+>?3}', name:"app_hello")]
    public function index($limit): Response
    {
        
        return $this->render('hello/index.html.twig',[
            'limite' => $limit,
            'messaggi' => $this->messages,
        ]);
        return new Response(
            implode(",",array_slice($this->messages, 0, $limit))
        );
    }

    #[Route('/messages/{id<\d+>}', name:'app_show_one')]
    public function showOne(int $id): Response
    {
        return $this->render('hello/show_one.html.twig',[
            "messaggi" => $this->messages[$id],
        ]);
        //return new Response($this->messages[$id]);
    }

}