<?php

include 'conexao.php';

$buscar_cadastro = 'SELECT * FROM usuarios';
$query_cadastros = mysqli_query($connx, $buscar_cadastro);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/cadastrar.css">
  <title>Cadastro ESTATEC</title>
</head>

<body>

  <div class="container">
    <div class="form-image">
      <img src="../view/assets/images/img-cadastrar.svg" alt="Imagem Cadastrar">
    </div>
    <div class="form">

      <form action="#">
        <div class="form-header">
          <div class="title">
            <h1>Cadastre-se</h1>
          </div>
          <div class="login-button">
            <button><a href="#">Entrar</a></button>
          </div>
        </div>

        <div class="input-group">
            <div class="input-box">
                <label for="firstname">Primeiro Nome</label>
                <input id="firstname" type="text" name="firstname" placeholder="Digite seu primeiro nome" required>
            </div>

            <div class="input-box">
                <label for="lastname">Sobrenome</label>
                <input id="lastname" type="text" name="lastname" placeholder="Digite seu sobrenome" required>
            </div>

            <div class="input-box">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" placeholder="Digite seu email" required>
            </div>

            <div class="input-box">
                <label for="number">RM</label>
                <input id="number" type="text" name="number" placeholder="Digite seu RM" required>
            </div>

            <div class="input-box">
                <label for="password">Senha</label>
                <input id="password" type="password" name="password" placeholder="Digite sua senha" required>
            </div>

            <div class="input-box">
                <label for="password">Confirme sua Senha</label>
                <input id="password" type="password" name="password" placeholder="Confirme sua senha" required>
            </div>
        </div>

        <div class="continue-button">
            <button><a href="#">Continuar</a> </button>
        </div>
      </form>

    </div>
  </div>

</body>

</html>