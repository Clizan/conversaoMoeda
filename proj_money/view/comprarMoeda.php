<!DOCTYPE html>
<html lang="br">
 <head>
  <title>Project</title>
  <meta charset="utf-8"><!--Tag Usada para aceitar acentos -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"><!--Tag de redimensionameto -->
  <link rel="stylesheet" href="../css/estilo.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"><!--Estilos CSS -->
 </head>
 <body>
  
  <div class="container">
 
   <div class="row">

    <div class="col-sm-2">
 
     <input type="number" id="real" value="5.30" readonly>

     <br />
 
     <input type="number" id="outraMoeda" min="900" max="900000" required>    
     
     <br />

     <label class="lbl">Formas de Pagamentos</label>

     <select id="pagamento" class="form-select form-select-sm">
      <option value="boleto">Boleto Bancário</option>
      <option value="credito">Cartão Credito</option>
     </select>

     <button class="btn btn-success" id="cotar"> Cotar</button>

    </div>

    <div class="col-sm-4">

     <select id="default" class="form-select form-select-sm">
      <option value="real" selected>Real</option>
     </select>

     <br />

     <select id="conversaoMoeda" class="form-select form-select-sm">
      <option value="dolar">Dolar</option>
      <option value="euro">Euro</option>
      <option value="pesoMexicano">Peso Mexicano</option>
     </select>

    </div>

    <div class="col-sm-6" id="historicoCompra">
    
     <?php 
      #incluindo a classe conexao
      include_once "../model/conexao.php";

      $select = mysqli_query($connection, "SELECT * FROM projmoney.ctrl_historytransitions");

      foreach($select as $rows){
       echo "<label style='font-weight:  bold'>" .$rows['dataTransacao']. "</label><br/>";   
       echo "<label> Base Cálculo R$: " .$rows['moedaDefault']. "</label><br/>";   
       echo "<label> Moeda Origem: " .$rows['nomeMoedaDefault']. "</label><br/>";   
       echo "<label> Valor Conversão $: " .$rows['segMoeda']. "</label><br/>";   
       echo "<label> Moeda destino: " .$rows['nomeSegMoeda']. "</label><br/>";
       echo "<label> Valor adquirido fora taxas: $ " .$rows['resultadoConversao']. "</label><br/>";
       echo "<label> Forma de pagamento: " .$rows['pagamento'] . "</label><br/>";
       echo "<label> Taxa de pagamento $: " .$rows['taxa'] . "</label><br/>";
       echo "<label> Taxa de conversão $: " .$rows['conversao'] . "</label><br/>";
       echo "<hr>";
      }
      
     ?>

 
    </div>

   </div> 

   <div class="mensagem"></div>

  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="../js/script.js"></script><!--Script for page timeout-->

 </body>

</html>
