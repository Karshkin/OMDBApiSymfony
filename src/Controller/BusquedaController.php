<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use App\Services\ApiServices\ApiConsumer;
use App\Controller\PruebaController;

class BusquedaController extends AbstractController{
    /**
     * @Route("/busqueda", name="busqueda")
     */

    public function barraBusqueda(Request $request, ApiConsumer $apiConsumer){
      $defaultData = array('message' => 'Type your message here');
      $form = $this->createFormBuilder($defaultData)
        ->add('buscador', TextType::class)
        ->add('send', SubmitType::class)
        ->getForm();
                $data = "test";
                $data = urlencode($data);
                $url = 'http://www.omdbapi.com/?s='.$data;
                $get_data = $apiConsumer->callAPI('GET', $url, false);
                $response = json_decode($get_data, true);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

        $data = $form->getData();

        $data = $data['buscador'];
        $data = urlencode($data);
        $url = 'http://www.omdbapi.com/?s='.$data;
        $get_data = $apiConsumer->callAPI('GET', $url, false);
        $response = json_decode($get_data, true);
        var_dump($response);
        } else {
          $data = "erroooooor";
        }

        return $this->render('busqueda/index.html.twig', [
          'form'=> $form->createView(),
          'data' => $data,
          'results' => $response['Search'],
        ]);
    }
}
