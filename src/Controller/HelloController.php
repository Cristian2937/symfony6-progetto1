<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserProfile;
use App\Repository\UserProfileRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HelloController extends AbstractController
{

    private array $messages = [
        ['message' => 'Hello', 'created' => '2022/06/12'],
        ['message' => 'Hi', 'created' => '2023/04/12'],
        ['message' => 'Bye!', 'created' => '2021/05/12']
    ];

    #[Route('/', name:"app_hello")]
    public function index(UserProfileRepository $userProfiles): Response
    {
        // $user = new User();
        // $user->setEmail("prova1.prova@mail.it")
        // ->setPassword("12345678");

        // $profile = new UserProfile();
        // $profile->setUser($user);
        // $userProfiles->save($profile,true);
        $profile = $userProfiles->find(1);

        return $this->render('hello/index.html.twig',[
            'limite' => 3,
            'messaggi' => $this->messages,
            'profile' => $profile
        ]);
        // return new Response(
        //     implode(",",array_slice($this->messages, 0, 3))
        // );
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