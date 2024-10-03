<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class NurseController extends AbstractController
{
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
