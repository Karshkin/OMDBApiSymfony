<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Users;
use App\Entity\Favorito;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;

class UsersController extends AbstractController
{
    /**
     * @Route("/users", name="users")
     */
    public function index(UserInterface $user)
    {
                

                    $uri = $_SERVER['REQUEST_URI'];

                    $userId = $user->getId();

                    $posts = $this->getDoctrine()->getRepository('App:Users')->findById($userId);

        return $this->render('users/index.html.twig', [
            'posts' => $posts,
        ]);
    }
}
