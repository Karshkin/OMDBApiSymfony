<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PruebaController extends AbstractController
{
    /**
     * @Route("/prueba", name="prueba")
     */
    public function index()
    {
        $test = "pollardo";
        return $this->render('prueba/index.html.twig', [
            'controller_name' => 'PruebaController',
            'test' => $test,
        ]);
    }
    public function test()
    {

            $url="http://www.omdbapi.com/?i=tt3896198&apikey=6acd7a13";
                  //  Initiate curl
            $ch = curl_init();
            // Disable SSL verification
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            // Will return the response, if false it print the response
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // Set the url
            curl_setopt($ch, CURLOPT_URL,$url);
            // Execute
            $result=curl_exec($ch);
            // Closing
            curl_close($ch);

            // Will dump a beauty json :3
            $arraychido=json_decode($result, true);
              $info="pollardo";

              //var_dump($arraychido);
              

              echo $arraychido['Title'];

        return $this->render('prueba/index.html.twig', [
            'controller_name' => 'PruebaController',
            'test' => $info,
        ]);
    }
}
