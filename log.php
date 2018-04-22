<?php

namespace App;

require("vendor/autoload.php");

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Log
{

   //Funktion som skapar en loggfil (om den inte redan finns)
   //och skriver ett log-entry varje gång funktionen körs.
   //Vad som skrivs i loggen beror på vilket meddelande som
   //skickas med till funktionen
   public function createLogEntries($message) {
       $log = new Logger('Enhörningsfantasternas samlingsplats');
       $log->pushHandler(new StreamHandler('logEntries.log', Logger::INFO));
       $log->info($message);
   }
}
