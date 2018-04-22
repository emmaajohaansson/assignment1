<?php
require("vendor/autoload.php");
require("getUnicornData.php");

use GuzzleHttp\Client;
use App\getUnicornData;

$unicornData = new getUnicornData();

if (isset($_GET["id"])) {
  $unicorn = $unicornData->getOneUnicorn($_GET["id"]);
}

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
               </div>
           </div>
           <div class="row">
               <div class="col-xs-6 col-xs-offset-3">
                 <form action="unicorn.php" method="GET">
                   <label for="inputId" class="col-xs-12">Id på enhörning</label>
                   <input type="text" name="id" placeholder="Ange enhörningens id" required/>
               </div>
           </div>
               <div class="col-xs-6 col-xs-offset-3">
                   <button type="submit" class="btn btn-success">Visa enhörning</button>
                 </form>
                   <a href="index.php" class="btn btn-primary unicornButton">Visa alla enhörningar</a>
                   <hr>
               </div>
           </div>
           <div class="row">
               <div class="col-xs-6 col-xs-offset-3 section">
                <?php
                  if($unicorn) {
                    echo getUnicornData::generateUnicornView($unicorn->name, $unicorn->spottedWhen, $unicorn->description, $unicorn->reportedBy, $unicorn->image);
                  }
                  else{
                    echo "<div class='alert alert-warning' role='alert'>
                      Du har sökt på ett ID som inte finns!
                      Testa ett annat ID eller bläddra bland enhörningarna
                      på startsidan.
                    </div>";
                  }
                ?>
               </div>
           </div>
		    </div>
    </body>
</html>
