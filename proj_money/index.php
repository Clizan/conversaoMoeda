<!DOCTYPE html>
<html lang="br">
 <head>
  <title>Project</title>
  <meta charset="utf-8"><!--Tag Usada para aceitar acentos -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"><!--Tag de redimensionameto -->
  <link rel="stylesheet" href="./css/estilo.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"><!--Estilos CSS -->

  <style>
.container {
width: 100vw;
height: 100vh;
display: flex;
flex-direction: row;
justify-content: center;
align-items: center;
}
.box {
width: 300px;
height: 300px;
}
body {
margin: 0px;
}

.row{
    margin-top: 40px;
}

#usuario, #senha{
 margin-top: 15px;
 border: 1px solid lightgray;
 border-radius: 5px;
 font-size: 13px;
 width: 250px;
 height: 35px;
}

.btn{
    margin-top: 10px;
    width: 150px;
}

#criarBanco{
    text-decoration: underline;
    font-size: 12px;
    margin-top: 20px;
    color:blue;
    cursor: pointer;
}
</style>
 </head>
 <body>
 
  <div class="container">
   
   <div class="box">
    
    <div class="row">  
   
     <div class="col-md-12">
      
      <input type="text" id="usuario" placeholder="Informe o usuario">

     </div> 

     <div class="col-md-12">
      
      <input type="password" id="senha" placeholder="Informe a senha">

     </div> 

     <div class="col-md-12">
      
      <button class="btn btn-success" id="entrar" disabled>Entrar</button>

     </div> 

     <div class="col-md-12">
      
      <label id="criarBanco">Criar Banco de dados</label>

     </div> 

    </div> 
    
    <div class="mensagem"></div>

   </div>


  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="./js/script.js"></script><!--Script for page timeout-->

 </body>

</html>