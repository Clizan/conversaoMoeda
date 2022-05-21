<?php
 try{
  #Local Database
  $server = "localhost"; /*maquina a qual o banco de dados está*/
  $user   = "root"; /*usuario do banco de dados MySql*/
  $pass   = ""; /*senha do banco de dados MySql*/
  
  $connection = mysqli_connect($server,$user,$pass);  /*Conecta no bando de dados MySql*/
  
 }catch (connect_errno $e) {
   printf("Connect failed: %s\n", $e->connect_error);
   exit();
 }
?>