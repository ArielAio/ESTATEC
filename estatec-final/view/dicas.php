<?php

// inclui o arquivo de conexão com o banco de dados
include ('../src/conexao.php');

// inicia a sessão
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION["rm"])) {
    header("Location: ../view/login.php");
    exit();
}

// obtém o RM do usuário armazenado na sessão e o sanitiza
$rm = filter_var($_SESSION['rm'], FILTER_SANITIZE_NUMBER_INT);

// verifica se o RM é válido
if (!is_numeric($rm)) {
    die("Erro: RM inválido.");
}


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/dicas.css">
    <link rel="shortcut icon" href="assets/images/Logo-03.1.ico" type="image/x-icon">
    <title>Dicas</title>
</head>
<body>
    <header>
       <a class="header-logo" href="../index.php">ESTATEC</a>
       <div class="header-links">
       <a href="<?= ($_SESSION["rm"] == "08670") ? 'estagios-adm.php' : 'estagios.php' ?>">Estágios</a>
       <a href="<?= ($_SESSION["rm"] == "08670") ? '../index-adm.php' : '../index.php' ?>">Estágios</a>
            <a href="dicas.php">Dicas</a>
            <button><a href="perfil.php">PERFIL</a></button>
        </div>
    </header>
    <main>
        
    </main>
</body>
<!-- 
    <div class="video-container">
        <h1>Para mais informações, assista este vídeo:</h1>
        
    </div>
    <a href="mailto:leandrobordignon@etec.sp.gov.br">Entre em contato</a>
    <a href="<?= ($_SESSION["rm"] == "08670") ? '../index-adm.php' : '../index.php' ?>" class="btn-voltar">Voltar</a>
    <iframe src="https://www.youtube.com/embed/BWktHc0PCxI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe> 
-->
</html>

