<?php

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\ApiServices\ApiConsumer;

class PruebaController extends AbstractController
{
    /**
     * @Route("/prueba", name="prueba")
     */



    public function test(ApiConsumer $apiConsumer)
    {
        $get_data = $apiConsumer->callAPI('GET', 'http://www.omdbapi.com/?s=papaya', false);
        $test = "pollardo";
        $response = json_decode($get_data, true);
        return $this->render('prueba/prueba.html.twig', [
            'controller_name' => 'PruebaController',
            'test' => $test,
            'results' => $response['Search'],
        ]);
}
    /**
     * @Route("/prueba/admin")
     */
    public function admin()
    {
        return new Response('<html><body>Admin page!</body></html>');
    }



}
