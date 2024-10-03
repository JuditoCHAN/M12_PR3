<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class NurseController extends AbstractController
{
 #[Route('/nurse', name: 'app_nurse', methods: ['GET'])]
    public function getAll(): JsonResponse
    {
        $nurses = [
            ["id" => 1, "nombre" => "Juan", "correo" => "juan@gmail.com", "password" => "1234"],
            ["id" => 2, "nombre" => "Maria", "correo" => "Maria@gmail.com", "password" => "1234"],
            ["id" => 3, "nombre" => "Pepa", "correo" => "Pepa@gmail.com", "password" => "1234"],
            ["id" => 4, "nombre" => "Marc", "correo" => "Marc@gmail.com", "password" => "1234"]
        ];

        return new JsonResponse($nurses, Response::HTTP_OK);
        //return $this->json($nurses);
        //return new Response(json_encode($nurses), Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }


    
    #[Route('/nurse/name/{name}', name: 'findByName', methods: ['GET'])]
    public function findByName(string $name): Response {
        $nurses = [
            ["id" => 1, "nombre" => "Juan", "correo" => "juan@gmail.com", "password" => "1234"],
            ["id" => 2, "nombre" => "Maria", "correo" => "Maria@gmail.com", "password" => "1234"],
            ["id" => 3, "nombre" => "Pepa", "correo" => "Pepa@gmail.com", "password" => "1234"],
            ["id" => 4, "nombre" => "Marc", "correo" => "Marc@gmail.com", "password" => "1234"]
        ];

        for($i=0; $i < count($nurses); $i++) {
            if(in_array($name, $nurses[$i])) {
                return new Response(json_encode($nurses[$i]), Response::HTTP_OK, ['Content-Type'=> 'application/json']);
            } 
        }

        //si no lo ha encontrado en el bucle for
        return new Response('No se ha encontrado el nombre', Response::HTTP_OK);
    }

    
    #[Route('/login', name: 'app_nurse', methods:['POST'])]
    public function login(Request $request): JsonResponse
    {
        $gmail = $request->request->get('gmail');
        $password = $request->request->get('password');

        if (is_null($gmail) || is_null($password)) {
            return $this->json(['Missing parameters'], Response::HTTP_BAD_REQUEST);
        }

        $data = [
            [
                'id' => 1,
                'nombre' => 'David',
                'gmail' => 'david@example.com',
                'password' => '1234'
            ],
            [
                'id' => 2,
                'nombre' => 'Maria',
                'gmail' => 'maria@example.com',
                'password' => 'abcd'
            ]
        ];

        

        foreach ($data as $user) {

            if ($user['gmail'] === $gmail && $user['password'] === $password) {
                return $this->json(true) ;
            }
        }
        return new JsonResponse(false);
        
    }
}
