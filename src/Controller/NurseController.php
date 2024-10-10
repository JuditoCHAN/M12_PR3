<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


    

    #[Route('/NurseController', name: 'Controller')]
        class NurseController extends AbstractController
{

    public array $nurses = [
        ["id" => 1, "nombre" => "Juan", "correo" => "juan@gmail.com", "password" => "1234"],
        ["id" => 2, "nombre" => "Maria", "correo" => "Maria@gmail.com", "password" => "1234"],
        ["id" => 3, "nombre" => "Pepa", "correo" => "Pepa@gmail.com", "password" => "1234"],
        ["id" => 4, "nombre" => "Marc", "correo" => "Marc@gmail.com", "password" => "1234"]
    ];


    #[Route('/nurse', name: 'app_nurse', methods: ['GET'])]
    public function getAll(): JsonResponse
    {
        return new JsonResponse($this->nurses, Response::HTTP_OK);
        //return $this->json($nurses);
        //return new Response(json_encode($nurses), Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }


    

    #[Route('/login', name: 'app_login', methods:['POST'])]
    public function login(Request $request): JsonResponse //el obj Request representa la solicitud HTTP que llega a la ruta /login
    {
        $gmail = $request->request->get('correo');
        $password = $request->request->get('password');

        if (is_null($gmail) || is_null($password)) {
            return $this->json(['Missing parameters'], Response::HTTP_BAD_REQUEST);
        }

        foreach ($this->nurses as $user) {
            if ($user['correo'] === $gmail && $user['password'] === $password) {
                return $this->json(true) ;
            }
        }
        //return new JsonResponse(false); //FALTA PONER EL Response::HTTP_OK(ES IGUAL QUE PONER 200)
        return $this->json(false);
    }
}

