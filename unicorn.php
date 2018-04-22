<?php
require("vendor/autoload.php");
require("getUnicornData.php");
require("log.php");

use GuzzleHttp\Client;
use App\getUnicornData;
use App\Log;

$unicornData = new GetUnicornData();
$log = new Log();

//Tittar om det finns ett angivet id (i URL:en, ?id=),
//som skickats när användaren tryckte på "Visa enhörning".
//Finns det ett id hämtas information om enhörningen
//som har det id:t.
if (isset($_GET["id"])) {
   $unicorn = $unicornData->getOneUnicorn($_GET["id"]);
}

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
               <?php
                   //Om det har hämtats en enhörning att visa skrivs denna ut m.h.a.
                   //funktionen generateUnicornView.
                   //Finns det ingen enhörning att visa visas istället en ruta som
                   //förklarar för användaren att id:t är felaktigt.
                   if ($unicorn) {
                       echo GetUnicornData::generateUnicornView($unicorn->name, $unicorn->spottedWhen, $unicorn->description, $unicorn->reportedBy, $unicorn->image);
                       $log->createLogEntries("A user requested info about " . $unicorn->name);
                   } else {
                       echo "<div class='alert alert-warning' role='alert'>
                       Du har sökt på ett ID som inte finns!
                       Testa ett annat ID eller bläddra bland enhörningarna
                       på startsidan.
                       </div>";
                       $log->createLogEntries("A user tried to find a unicorn with a non-existing ID.");
                   }
                   ?>
               </div>
           </div>
		     </div>
   </body>
</html>
