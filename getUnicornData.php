<?php

namespace App;

require("vendor/autoload.php");

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class GetUnicornData
{
   //Funktion som hämtar alla enhörningar
   public function getUnicorns() {
       // Skapa en HTTP-client
       $client = new Client();

       // Anropa URL: http://unicorns.idioti.se/
       $res = $client->request('GET', 'http://unicorns.idioti.se/', [
           'headers' => [
           'Accept' => 'application/json'
           ]
       ]);

       // Omvandla JSON-svar till datatyper
       $data = json_decode($res->getBody());
       return $data;
   }

   //Funktion som hämtar en enhörning beroende på specifikt id som skickas med
   public function getOneUnicorn($id) {
       // Skapa en HTTP-client
       $client = new Client();

       try {
           // Anropa URL: http://unicorns.idioti.se/
           $res = $client->request('GET', 'http://unicorns.idioti.se/' . $id, [
               'headers' => [
               'Accept' => 'application/json'
               ]
           ]);

           // Omvandla JSON-svar till datatyper
           $data = json_decode($res->getBody());
           return $data;
       } catch(ClientException $e){
           return false;
       }
   }

   //Genererar html för listan med alla enhörningar
   public static function generateUnicornList($id, $name) {
       return "<li>$id: $name <a href='unicorn.php?id=$id' class='btn btn-info readMore'>Läs mer</a></li>
               <hr>";
   }

   //Genererar html för att visa en specifik enhörning
   public static function generateUnicornView($name, $spottedWhen, $description, $reportedBy, $image) {
       return "<div class='col-xs-6'>
                   <h2>$name</h2>
                   <p>$spottedWhen</p>
                   <p>$description</p>
                   <p>Reported by: $reportedBy</p>
               </div>
               <div class='col-xs-6'>
                   <img src='$image'/>
               </div>";
   }
}
