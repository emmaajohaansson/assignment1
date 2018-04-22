<?php
require("vendor/autoload.php");
require("getUnicornData.php");
require("log.php");

use GuzzleHttp\Client;
use App\GetUnicornData;
use App\Log;

$unicornData = new GetUnicornData();
$log = new Log();

//Loggar att en användare visat alla enhörningar, varje gång index.php visas
$log->createLogEntries("A user requested info about all unicorns");
?>

<!DOCTYPE html>
<html>
   <head>
       <meta charset="utf-8">
       <meta name="viewport" content="initial-scale=1, width=device-width">
       <title>Enhörningar</title>
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
       integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
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
                       Du kan när som helst klicka på "Visa alla enhörningar" för att komma tillbaka till
                       startsidan igen.
                   </p>
               </div>
           </div>
           <div class="row">
               <div class="col-xs-6 col-xs-offset-3">
                   <form action="unicorn.php" method="GET">
                       <label for="inputId" class="col-xs-12">Id på enhörning</label>
                       <input type="text" name="id" placeholder="Ange enhörningens id" required/>
                       <button type="submit" class="btn btn-success">Visa enhörning</button>
                   </form>
                   <a href="index.php" class="btn btn-primary unicornButton">Visa alla enhörningar</a>
                   <hr>
               </div>
           </div>
           <div class="row">
               <div class="col-xs-6 col-xs-offset-3 section">
                   <h2>Alla enhörningar</h2>
                   <ul>
                       <?php
                       //Funktion som itererar igenom alla enhörningar och skriver
                       //ut dess id och namn med hjälp av funktionen generateUnicornList
                       foreach ($unicornData->getUnicorns() as $item) {
                           $id = $item->id;
                           $name = $item->name;
                           if ((!$id == "") && (!$name == "")) {
                               echo GetUnicornData::generateUnicornList($id, $name);
                           }
                       }
                       ?>
                   </ul>
               </div>
           </div>
		     </div>
   </body>
</html>
