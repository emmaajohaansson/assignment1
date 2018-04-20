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
?>

<!DOCTYPEhtml>
<html>
   <head>
       <meta charset="utf-8">
		   <meta name="viewport" content="initial-scale=1, width=device-width">
		   <title>Enhörningar</title>
		   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
       <link rel=stylesheet type=text/css href="style.css">
   </head>
	 <body>
	     <div class="container-fluid">
           <div class="row">
               <div class="col-xs-6 col-xs-offset-3">
                   <h1>Enhörningsfantasternas samlingsplats</h1>
                   <hr>
                   <p>
                        Gillar du enhörningar? I så fall är detta webbplatsen för dig!
                        Sök på ett specifikt ID nedan för att hitta en särskild enhörning,
                        eller klicka dig fram i listan nedan.
                   </p>
               </div>
           </div>
           <div class="row">
               <div class="col-xs-6 col-xs-offset-3">
                   <label for="inputId" class="col-xs-12">Id på enhörning</label>
                   <input type="text" name="inputId">
               </div>
           </div>
           <div class="row">
               <div class="col-xs-6 col-xs-offset-3">
                   <button type="button" class="btn btn-success">Visa enhörning</button>
                   <button type="button" class="btn btn-primary">Visa alla enhörningar</button>
                   <hr>
               </div>
           </div>
           <div class="row">
               <div class="col-xs-6 col-xs-offset-3">
                   <h2>Alla enhörningar</h2>
                   <ul>
                        <?php
                        foreach ($data as $item) {
                            $id = $item->id;
                            $name = $item->name;
                            $details = $item->details;
                            if ((!$id == "") && (!$name == "") && (!$details == "")) {
                                echo "<li> " . $id . ": " . $name . " <button type='button' class='btn btn-info readMore'>Läs mer</button><hr></li>";
                            }
                        ?>
                  </ul>
               </div>
           </div>
		    </div>
	  </body>
</html>
