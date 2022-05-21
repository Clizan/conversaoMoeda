<?php
 #setando o timeout para São Paulo
 date_default_timezone_set('America/Sao_Paulo');

 #incluindo a classe conexao
 include_once "../model/conexao.php";

 #Pegando a data atual para inserir no banco o momento em que o registro sofrer alteração
 $dataInsercao = date("Y-m-d H:i:s");

 #funcao que realiza consulta no banco de dados e verifica o usuário
 function ingressoAplicacao($connection, $user, $pass){
  $select = mysqli_query($connection, "SELECT * FROM projMoney.ctrl_usuarios WHERE usuario = '$user' AND senha = '$pass'");   
 }

 #function responsavel por inserir o registro de conversão
 function inserirRegistrosHistoricos($connection, $rcMoedaDefault, $rcNomeMoedaDefault, $rcSegMoeda, $rcNomeSegMoeda, $dataInsercao, $rcPagamento){
  $taxa = null;

  if($rcPagamento === 'boleto'){
   $rcPagamento = "Boleto Bancário";
   $taxa .= ($rcSegMoeda * 1.37) / 100;
  }else{
   $rcPagamento = "Cartão de Crédito";
   $taxa .= ($rcSegMoeda * 7.73) / 100;  
  }

  if($rcSegMoeda <= 3700){
   $conversao .= ($rcSegMoeda * 2) / 100;
  }else{
    $conversao .= ($rcSegMoeda * 1) / 100;
  }
   
  $rcResultadoConversao = $rcSegMoeda - ($taxa + $conversao);
  
  #aplicando o conceito de orientação a objeto para execução da query
  $insert = mysqli_query($connection, "INSERT INTO projMoney.ctrl_historyTransitions(moedaDefault, nomeMoedaDefault, segMoeda, nomeSegMoeda, resultadoConversao, dataTransacao, pagamento, taxa, conversao) 
                                       VALUES ('$rcMoedaDefault', '$rcNomeMoedaDefault', '$rcSegMoeda', '$rcNomeSegMoeda', '$rcResultadoConversao', '$dataInsercao', '$rcPagamento', '$taxa', '$conversao')");  
 }

 #function responsavel por criar o banco de dados
 function createDataBase($connection){
  $db     = "projMoney"; /*seleciona o banco a ser usado*/

  #Criando o banco de dados
  $create = mysqli_query($connection, "CREATE SCHEMA IF NOT EXISTS $db");
    
  if($create === TRUE){
   $createTable = mysqli_query($connection, "CREATE TABLE IF NOT EXISTS projMoney.ctrl_usuarios(
                                              id int not null auto_increment primary key, 
                                              usuario VARCHAR(10), 
                                              senha VARCHAR(10))");
   
   if($createTable === TRUE){
    $insertUsuario = mysqli_query($connection, "INSERT INTO projMoney.ctrl_usuarios(usuario, senha) VALUES ('admin', '123')");
  
    $createHistorico = mysqli_query($connection, "CREATE TABLE `ctrl_historytransitions` (
                                                   `idTransition` int(11) NOT NULL AUTO_INCREMENT,
                                                   `moedaDefault` decimal(10,2) DEFAULT NULL,
                                                   `nomeMoedaDefault` varchar(50) DEFAULT NULL,
                                                   `segMoeda` decimal(10,2) DEFAULT NULL,
                                                   `nomeSegMoeda` varchar(50) DEFAULT NULL,
                                                   `resultadoConversao` decimal(10,2) DEFAULT NULL,
                                                   `dataTransacao` timestamp NULL DEFAULT NULL,
                                                   `pagamento` varchar(50) DEFAULT NULL,
                                                   `taxa` decimal(10,2) DEFAULT NULL,
                                                   `conversao` decimal(10,2) DEFAULT NULL,
                                                    PRIMARY KEY (`idTransition`)
                                                  )");
   } 
  }else{
   mysqli_close($connection);
  } 
 }

 #validando se a variavel existe e se ela tem seu valor diferente de vazio|branco
 if(isset($_POST['passUsuario']) && (!empty($_POST['passUsuario']))){
  $user = $_POST['passUsuario'];
  $pass = $_POST['passSenha'];   

  ingressoAplicacao($connection, $user, $pass);

 }
 
 #validando se a variavel existe e se ela tem seu valor diferente de vazio|branco
 if(isset($_POST['passMoedaDefault']) && (!empty($_POST['passMoedaDefault']))){
  $rcMoedaDefault       = $_POST['passMoedaDefault'];
  $rcNomeMoedaDefault   = $_POST['passNomeMoedaDefault'];
  $rcSegMoeda           = $_POST['passSegMoeda'];
  $rcNomeSegMoeda       = $_POST['passNomeSegMoeda'];
  $rcResultadoConversao = $_POST['passResultadoConversao'];
  $rcPagamento          = $_POST['passPagamento'];

  #Chamando a função caso a variavel esteja devidamente com os seus valores preenchidos
  inserirRegistrosHistoricos($connection, $rcMoedaDefault, $rcNomeMoedaDefault, $rcSegMoeda, $rcNomeSegMoeda, $dataInsercao, $rcPagamento);
 }

 #validando se a variavel existe e se ela tem seu valor diferente de vazio|branco
 if(isset($_POST['passCriarBanco']) && (!empty($_POST['passCriarBanco']))){
  $rcCriarDb = $_POST['passCriarBanco'];

  #Chamando a função caso a variavel esteja devidamente com os seus valores preenchidos
  createDataBase($connection);
 }
?>