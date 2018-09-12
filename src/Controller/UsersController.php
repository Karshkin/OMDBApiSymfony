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


                    $em = $this->getDoctrine()->getManager();
                      $repository = $em->getRepository('App:Favorito');
                      $query = $repository->createQueryBuilder('f')
                          ->innerJoin('f.usuario', 'u')
                          ->groupBy('f.imdbID')
                          ->where('u.id = :user_id')
                          ->setParameter('user_id', $userId)
                          ->getQuery()->getResult();

                    /*$em = $this->getDoctrine()->getManager();
                    $query = $em->createQuery(
                        'SELECT f.imdb_id FROM App:Favorito f, favorito_users fu, App:Users u
                        where f.id=fu.favorito_id and fu.users_id=u.id and u.id=:user_id'
                    )->setParameter('user_id', $userId);
                    $tasks = $query->getResult();*/



        return $this->render('users/index.html.twig', [
            'movies' => $query,
        ]);
    }
}
/*


$users = $this->getDoctrine()
->getRepository(Users::class)
->find($userId);

$favorito = $this->getDoctrine()
->getRepository(Favorito::class)
->findByUsuario($userId);

$users = $this->getDoctrine()->getRepository('App:Users')->findById($userId);
$favs = $this->getDoctrine()->getRepository('App:Favorito')->findByUsuario($userId);*/
