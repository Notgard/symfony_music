<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    /**
     * @Route("/hello", name="hello")
     */
    public function index(): Response
    {
        return $this->render('hello/index.html.twig', [
            'controller_name' => 'HelloController',
        ]);
    }


    /**
     * @Route("/hello/{name}/{times}", requirements={"times"="\d+"})
     */
    public function helloManyTimes(string $name, int $times = 3): Response
    {
        return $this->render('hello/hellomanytimes.html.twig',
            [
                'name' => $name,
                'times' => $times,
            ]);
    }


    /**
     * @Route("/hello/{name}")
     */
    public function hello(string $name): Response
    {
        return $this->render('hello/hello.html.twig',
        [
            'name' => $name,
        ]);
    }
}
