<?php

include ('../src/conexao.php');

$buscar_cadastro = 'SELECT * FROM usuarios';
$query_cadastros = mysqli_query($conn, $buscar_cadastro);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" conteant="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/cadastrar.css">
  <link rel="shortcut icon" href="assets/images/Logo-03.1.ico" type="image/x-icon">
  <title>Cadastro ESTATEC</title>
</head>

<body>

  <div class="container">
    <div class="form-image">
      <img src="../view/assets/images/img-cadastrar.svg" alt="Imagem Cadastrar">
    </div>
    <div class="form">

      <form action="../src/cadastro.php" method="post">
        <div class="form-header">
          <div class="title">
            <h1>Cadastre-se</h1>
          </div>
          <div class="login-button">
            <button><a href="login.php">Entrar</a></button>
          </div>
        </div>

        <div class="input-group">
            <div class="input-box">
                <label for="nome">Primeiro Nome</label>
                <input id="nome" type="text" name="nome" placeholder="Digite seu primeiro nome" required>
            </div>

            <div class="input-box">
                <label for="ultimonome">Sobrenome</label>
                <input id="ultimonome" type="text" name="ultimonome" placeholder="Digite seu sobrenome" required>
            </div>

            <div class="input-box">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" placeholder="Digite seu email" required>
            </div>

            <div class="input-box">
                <label for="number">RM</label>
                <input id="rm" type="text" name="rm" placeholder="Digite seu RM" required>
            </div>

            <div class="input-box">
    <label for="senha">Senha</label>
    <input id="senha" type="password" name="senha" placeholder="Digite sua senha" required>
    <p id="alerta-senha"></p>
</div>

<div class="input-box">
    <label for="senha_confirmacao">Confirme sua senha</label>
    <input id="senha_confirmacao" type="password" name="senha_confirmacao" placeholder="Confirme sua senha" required>
</div>
        </div>

        <input id="cadastrar" class="cadastrar" type="submit" value="Cadastrar" onclick="return validarSenha();">
      </form>

    </div>
  </div>

  <script src="assets/js/cadastrar.js"></script>

</body>

</html>