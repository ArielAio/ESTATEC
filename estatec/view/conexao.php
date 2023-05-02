<?php

$host = 'localhost';
$user = 'root';
$passwd = '123456';
$bd_name = 'estatec';

$connx = mysqli_connect($host,  $user, $passwd, $bd_name);

if (!$connx) {
    die("Conexão falhou: " . mysqli_connect_error());
  }

?>