<?php

    include 'conexao.php';

    // Verifica se a conexão foi estabelecida com sucesso
    if (!$conn) {
        die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
    }

    // Obtém o RM do usuário armazenado na sessão
    session_start();
    $rm = mysqli_real_escape_string($conn, $_SESSION['rm']);

    // Monta a consulta SQL para recuperar o nome e email do usuário a partir do rm
    $sql = "SELECT * FROM usuarios WHERE rm = $rm";

    // Executa a consulta SQL
    $resultado = mysqli_query($conn, $sql);

    // Verifica se a consulta retornou resultados
    if (mysqli_num_rows($resultado) > 0) {
        // Obtém o array associativo com os resultados da consulta
        $linha = mysqli_fetch_assoc($resultado);

        // Armazena o nome e email do usuário em variáveis
        $nome = $linha['nome'];
        $email = $linha['email'];
    } else {
        // Se a consulta não retornou resultados, exibe uma mensagem de erro
        echo "Erro: usuário não encontrado.";
    }

    // Encerra a conexão com o banco de dados
    mysqli_close($conn);
    ?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/perfil.css">
    <title>Perfil</title>
</head>
<body>
    <!-- Exibe o nome e email do usuário na tela -->
    <h1>Perfil do Usuário</h1>
    <div>
    <p><strong>Nome:</strong> <?php echo $nome; ?></p>
    <p><strong>Email:</strong> <?php echo $email; ?></p>
    <p><strong>RM:</strong> <?php echo $rm; ?></p>
</div>

<!-- Botão Voltar -->
<a class="btn-voltar" href="index.php">Voltar</a>
</body>
</html>
