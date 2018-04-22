<?php

namespace App;

require("vendor/autoload.php");

use GuzzleHttp\Client;

class getUnicornData
{
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

  public function getOneUnicorn($id) {
  // Skapa en HTTP-client
  $client = new Client();

  // Anropa URL: http://unicorns.idioti.se/
  $res = $client->request('GET', 'http://unicorns.idioti.se/' . $id, [
      'headers' => [
      'Accept' => 'application/json'
      ]
  ]);

  // Omvandla JSON-svar till datatyper
  $data = json_decode($res->getBody());
  return $data;
  }
}

?>
