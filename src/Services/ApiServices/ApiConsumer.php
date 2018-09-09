<?php

namespace App\Services\ApiServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
class ApiConsumer{

            /*$url="http://www.omdbapi.com/?i=tt3896198&apikey=6acd7a13";
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


            echo  $arraychido['Year'];
*/
          public  function callAPI($method, $url, $data){
               $curl = curl_init();
               $url= $url.'&apikey=6acd7a13';
               switch ($method){
                  case "POST":
                     curl_setopt($curl, CURLOPT_POST, 1);
                     if ($data)
                        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                     break;
                  case "PUT":
                     curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                     if ($data)
                        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                     break;
                  default:
                     if ($data)
                        $url = sprintf("%s?%s", $url, http_build_query($data));
               }

               // OPTIONS:
               curl_setopt($curl, CURLOPT_URL, $url);
               curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                  'APIKEY: 6acd7a13',
                  'Content-Type: application/json',
               ));
               curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
               curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

               // EXECUTE:
               $result = curl_exec($curl);
               if(!$result){die("Connection Failure");}
               curl_close($curl);
               return $result;
            }


}
