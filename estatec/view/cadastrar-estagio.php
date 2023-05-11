<?php
include('conexao.php');

session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION["rm"])) {
    header("Location: login.php");
    exit();
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

   // Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta os valores inseridos no formulário
    $nome = mysqli_real_escape_string($conn, $_POST["nome"]);
    $assunto = mysqli_real_escape_string($conn, $_POST["assunto"]);
    $requisitos = mysqli_real_escape_string($conn, $_POST["requisitos"]);
    $carga_horaria = mysqli_real_escape_string($conn, $_POST["carga-horaria"]);
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
        header('Location: cadastrar-estagio.php?error=5');
        exit();
    }
}

// Insere os valores no banco de dados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("INSERT INTO estagios (nome, assunto, requisitos, carga_horaria, principais_atividades, salario, data_validade) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('sssssss', $nome, $assunto, $requisitos, $carga_horaria, $atividades, $salario, $data_validade);

    if ($stmt->execute()) {
        echo "Os dados foram inseridos com sucesso!";
    } else {
        echo "Erro ao inserir os dados: " . $stmt->error;
    }
}

    // Encerra a conexão com o banco de dados
    mysqli_close($conn);
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Estágio</title>
</head>
<body>
    <form method="POST">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" placeholder="ex: consultório odontológico">
        
        <label for="assunto">Assunto:</label>
        <input id="assunto" type="text" placeholder="ex: Estágio em consultório">

        <label for="requisitos">Requisitos:</label>
        <textarea name="requisitos" id="requisitos" cols="30" rows="3" placeholder="ex: onde deve estudar, noções básicas, competências..."></textarea>
        
        <label for="carga-horaria">Carga horária:</label>
        <input type="text" id="carga-horaria" placeholder="ex: 6 horas por dia (somente o numero)">

        <label for="atividades">Principais atividades:</label>
        <input type="text" name="atividades" id="atividades" placeholder="ex: atividades administrativas, atendimento ao público...">

        <label for="salario">Salário:</label>
        <input type="text" name="salario" id="salario" placeholder="ex: bolsas + valor + seguros">

        <label for="data">Data de validade:</label>
        <input id="data" type="date"> 

        <input id="enviar" class="enviar" type="submit" value="Enviar">

</form>
</body>
</html>