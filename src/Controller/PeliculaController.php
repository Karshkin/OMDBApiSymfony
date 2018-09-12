<?php

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\ApiServices\ApiConsumer;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Entity\Users;
use App\Entity\Favorito;
use Doctrine\ORM\EntityManagerInterface;

class PeliculaController extends AbstractController
{
    /**
     * @Route("/pelicula", name="pelicula")
     */



    public function test(ApiConsumer $apiConsumer)
    {
        $uri = $_SERVER['REQUEST_URI'];

        if (isset($_GET['id'])) {
          $id = $_GET['id'];
          $get_data = $apiConsumer->callAPI('GET', 'http://www.omdbapi.com/?i='.$id, false);
          $test = "pollardo";
          $response = json_decode($get_data, true);
          return $this->render('pelicula/pelicula.html.twig', [
              'test' => $test,
              'titulo' => $response['Title'],
              'año' => $response['Year'],
              'estreno' => $response['Released'],
              'genero' => $response['Genre'],
              'duracion' => $response['Runtime'],
              'director' => $response['Director'],
              'idioma' => $response['Language'],
              'pais' => $response['Country'],
              'ID' => $response['imdbID'],
              'poster' => $response['Poster'],

          ]);
        }else {
          $response = "No mas windex";
          $test = "pollardo";
          return $this->render('pelicula/pelicula.html.twig', [
              'test' => $test,
              'titulo' => $response,
          ]);
        }

}


          /**
           * @Route("/favorito", name="favorito")
           */
          public function addFav(UserInterface $user)
          {

              $uri = $_SERVER['REQUEST_URI'];
              $imdbID = $_GET['id'];
              $titulo = $_GET['title'];
              $userId = $user->getId();
              $users = $this->getDoctrine()
               ->getRepository(Users::class)
               ->find($userId);



             $favorito = new Favorito();
             $favorito->addUsuario($users);
             $favorito->setImdbID($imdbID);
             $favorito->setTitle($titulo);



             // relates this product to the category

             $users->addFavorito($favorito);

             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($favorito);
             $entityManager->persist($users);
             $entityManager->flush();

              return $this->redirect('pelicula\?id='.$imdbID);
          }
    /**
     * @Route("/prueba/admin")
     */
    public function admin()
    {
        return new Response('<html><body>Admin page!</body></html>');
    }



}
