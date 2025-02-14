<?php
function db_connect()
{
   $host = "localhost";
   $db_name = "comercial";
   $username = "postgres";
   $password = "fatec";
   try {
    $PDO = new PDO("pgsql:host=$host;dbname=$db_name", $username, $password);
    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
    die();
}
   return $PDO;
}
function ConverteData($data)
{
   if (strstr($data, "/")) 
   {
       $d = explode("/", $data);
       $rstData = "$d[2]-$d[1]-$d[0]"; 
       return $rstData;
   }
   elseif(strstr($data, "-")) 
   {
       $d = explode("-", $data);
       $rstData = "$d[2]/$d[1]/$d[0]"; 
       return $rstData;
   }
   else
   {
       return "Data inválida";
   }
}
?>