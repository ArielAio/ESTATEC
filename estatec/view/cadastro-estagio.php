<?php
include 'conexao.php';

// Verifica se a conexão foi estabelecida com sucesso
if (!$conn) {
    die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
}

// Obtém o RM do usuário armazenado na sessão
session_start();
$rm = mysqli_real_escape_string($conn, $_SESSION['rm']);

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

// Fecha a conexão com o banco de dados
mysqli_close($conn);

header('location: cadastrar-estagio.php');
?>