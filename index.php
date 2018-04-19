<?php
require("vendor/autoload.php");

use GuzzleHttp\Client;

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
$dataLength = count($data);

// @TODO Gör något fantastiskt med vår data!
?>
<!DOCTYPE html>
  <html>
    <head>
    <title>Testing, testing</title>
    </head>
    <body>
      <h1>Enhörningar</h1>
      <?php
          foreach ($data as $item) {
            $id = $item->id;
            $name = $item->name;
            $details = $item->details;
            echo $id . $name . $details;
          };
      ?>
    </body>
  </html>
