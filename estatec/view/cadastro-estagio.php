<?php

include 'conexao.php';

// Verifica se a conexão foi estabelecida com sucesso
if (!$conn) {
    die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
}

if (!isset($_SESSION['rm'])) {
        exit;
}

// Obtém o RM do usuário armazenado na sessão
session_start();
$rm = mysqli_real_escape_string($conn, $_SESSION['rm']);



// Estabelece a conexão com o banco de dados
$conn = mysqli_connect("localhost", "usuario", "senha", "nome_do_banco_de_dados");

// Verifica se houve algum erro na conexão
if (!$conn) {
    die("Não foi possível conectar ao banco de dados: " . mysqli_connect_error());
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    

// Coleta os valores inseridos no formulário
$nome = $_POST["nome"];
$assunto = $_POST["assunto"];
$requisitos = $_POST["requisitos"];
$carga_horaria = $_POST["carga-horaria"];
$atividades = $_POST["atividades"];
$salario = $_POST["salario"];
$data_validade = $_POST["data"];


// Insere os valores no banco de dados
$sql = "INSERT INTO estagios (nome, assunto, requisitos, carga_horaria, principais_atividades, salario, data_validade) 
        VALUES ('$nome', '$assunto', '$requisitos', '$carga_horaria', '$atividades', '$salario', '$data_validade')";

if (mysqli_query($conn, $sql)) {
    echo "Os dados foram inseridos com sucesso!";
} else {
    echo "Erro ao inserir os dados: " . mysqli_error($conn);
}
}

// Fecha a conexão com o banco de dados
mysqli_close($conn);

header('location: cadastrar-estagio.php');

?>