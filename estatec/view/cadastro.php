<?php

include 'conexao.php';

if (empty($_POST['nome']) || empty($_POST['rm']) || empty($_POST['senha'])) {
    header('Location: cadastrar.php?error=1'); // redireciona para a página de cadastro com mensagem de erro
    exit();
}

$nome = $_POST['nome'];
$rm = $_POST['rm'];
$senha = $_POST['senha'];

// Validando RM com 5 dígitos
if (!preg_match('/^\d{5}$/', $rm)) {
    header('Location: cadastrar.php?error=2'); // redireciona para a página de cadastro com mensagem de erro
    echo('O RM deve conter 5 dígitos numéricos');
    exit();
}


// Expressão regular para verificar se a senha possui pelo menos uma letra maiúscula, um dígito numérico e um caractere especial
if (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[^\w\d\s])(?!.*\s).{8,}$/', $senha)) {
  header('Location: cadastrar.php?error=3'); // redireciona para a página de cadastro com mensagem de erro
  echo('A senha deve conter, ao menos, um caractere, uma letra maiúscula e um dígito numérico');
  exit();
}
  
$recebendo_cadastros = "INSERT INTO usuarios (nome, rm, senha) VALUES ('$nome', '$rm', '$senha')";

if (mysqli_query($connx, $sql)) {
    echo "Registro inserido com sucesso!";
} else {
    echo "Erro ao inserir registro: " . mysqli_error($connx);
}

$query_cadastros = mysqli_query($connx, $recebendo_cadastros);

header('location: index.php');

?>