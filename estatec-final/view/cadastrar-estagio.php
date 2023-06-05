<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION["rm"])) {
    header("Location: ../view/login.php");
    exit();
}

// Verifica se o RM é igual a "08670"
if ($_SESSION["rm"] !== "08670") {
    header("Location: ../view/acesso-negado.php");
    exit();
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('../src/conexao.php');

    // Coleta os valores inseridos no formulário
    $nome = mysqli_real_escape_string($conn, $_POST["nome"]);
    $assunto = mysqli_real_escape_string($conn, $_POST["assunto"]);
    $requisitos = mysqli_real_escape_string($conn, $_POST["requisitos"]);
    $carga_horaria = mysqli_real_escape_string($conn, $_POST["carga_horaria"]);
    $atividades = mysqli_real_escape_string($conn, $_POST["atividades"]);
    $salario = mysqli_real_escape_string($conn, $_POST["salario"]);
    $data_validade = mysqli_real_escape_string($conn, $_POST["data"]);

    // Verificar se o estágio já está cadastrado
    $verificar_estagio = "SELECT * FROM estagios WHERE nome=? AND assunto=?";
    $stmt = mysqli_prepare($conn, $verificar_estagio);
    mysqli_stmt_bind_param($stmt, 'ss', $nome, $assunto);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($resultado) > 0) {
        // Já existe um registro com esses dados, redirecionar para a página de cadastro com mensagem de erro
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header('Location: cadastrar-estagio.php?error=5');
        exit();
    } else {
        // Insere os valores no banco de dados
        $inserir_estagio = "INSERT INTO estagios (nome, assunto, requisitos, carga_horaria, atividades, salario, data_validade) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $inserir_estagio);
        mysqli_stmt_bind_param($stmt, 'sssssss', $nome, $assunto, $requisitos, $carga_horaria, $atividades, $salario, $data_validade);
        mysqli_stmt_execute($stmt);

        if (mysqli_affected_rows($conn) > 0) {
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: estagios-adm.php");
            exit();
        } else {
            echo "Erro ao inserir os dados";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/cadastrar-estagio.css">
    <link rel="shortcut icon" href="assets/images/Logo-03.1.ico" type="image/x-icon">
    <title>Cadastrar Estágio</title>
</head>
<body>
<form method="POST">
    <label for="nome">Nome:</label>
    <input type="text" name="nome" id="nome" placeholder="ex: consultório odontológico">
    
    <label for="assunto">Assunto:</label>
    <input type="text" name="assunto" id="assunto" placeholder="ex: Estágio em consultório">

    <label for="requisitos">Requisitos:</label>
    <textarea name="requisitos" id="requisitos" cols="30" rows="3" placeholder="ex: onde deve estudar, noções básicas, competências..."></textarea>
    
    <label for="carga-horaria">Carga horária:</label>
    <input type="text" name="carga_horaria" id="carga-horaria" placeholder="ex: segunda a sexta 6 horas por dia">

    <label for="atividades">Principais atividades:</label>
    <textarea name="atividades" id="atividades" cols="30" rows="3" placeholder="ex: atividades administrativas, atendimento ao público..."></textarea>

    <label for="salario">Salário:</label>
    <input type="text" name="salario" id="salario" placeholder="ex: bolsas + valor + seguros">

    <label for="data">Data de validade:</label>
    <input id="data" type="date" name="data"> 

    <input id="enviar" class="enviar" type="submit" value="Enviar">
</form>
<a href="estagios-adm.php" class="btn">Voltar para Estágios</a>
</body>
</html>
    