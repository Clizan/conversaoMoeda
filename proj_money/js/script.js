$('#cotar').click(function(){
 /*Variaveis que recebe o valor dos campos preeenchidos, que contém na tela de comprarMoedas.php*/   
 var moedaDefault          = document.getElementById('real').value;
 var nomeMoedaDefault      = document.getElementById('default').value;
 var segMoeda              = document.getElementById('outraMoeda').value;
 var nomeSegMoeda          = document.getElementById('conversaoMoeda').value;
 var resultadoConversao    = null;
 var pagamento             = document.getElementById('pagamento').value;

 if(segMoeda > 900 && segMoeda < 900000){

  $.ajax({
   type: "POST",
   url: '../controller/registros.php',
   data:{
    passMoedaDefault: moedaDefault,
    passNomeMoedaDefault: nomeMoedaDefault,
    passSegMoeda: segMoeda, 
    passNomeSegMoeda: nomeSegMoeda,
    passPagamento: pagamento
   },success: function() {
     /*Mensagem de retorno informando que os dados foram registrado no banco de dados na tabela de historico*/
     document.querySelector('.mensagem').innerHTML= '<div class="alert alert-success alert-dismissible">' + 
                                                    '<strong>Dados!</strong> registrados com sucesso.</div>';

     setTimeout(function() {
      window.location.reload(1);
     }, 1800); // 3 segundos 
   }
  });

 }else{
  /*Mensagem de retorno caso os valores informados estejam fora do parametro*/
  document.querySelector('.mensagem').innerHTML= '<div class="alert alert-warning alert-dismissible">' + 
                                                 '<strong>Atenção!</strong> O valor para segunda consta divergente do descrito, informe o valor entre $900 à $900000.</div>';   
 } 
});

//funcao responsavel por criar o banco de dados   
$('#criarBanco').click(function(){
 let button = document.querySelector(".btn");
 let criarBanco = 1;
    
 $.ajax({
  type: "POST",
  url: './controller/registros.php',
  data:{
   passCriarBanco: criarBanco
  },success: function() { 

   /*Mensagem de retorno informando que os dados foram registrado no banco de dados na tabela de historico*/
   document.querySelector('.mensagem').innerHTML= '<div class="alert alert-success alert-dismissible">' + 
                                                  '<strong>Banco de dados!</strong> criado com sucesso, <strong>Usuario: </strong> admin <strong>Senha: </strong>123</div>';

   button.disabled = false;
  }
 });
});

$('#entrar').click(function (){
 var usuario = document.getElementById('usuario').value;
 var senha   = document.getElementById('senha').value;

 $.ajax({
  type: "POST",
  url: './controller/registros.php',
  data:{
   passUsuario: usuario,
   passSenha  : senha
  },success: function() { 

   /*Mensagem de retorno informando que os dados foram registrado no banco de dados na tabela de historico*/
   document.querySelector('.mensagem').innerHTML= '<div class="alert alert-success alert-dismissible">' + 
                                                  '<strong>Aguarde</strong> você está ingressando na aplicação</div>';

   window.location.href = "./view/comprarMoeda.php";

  }
 });
});