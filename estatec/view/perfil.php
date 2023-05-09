<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

include 'conexao.php';

// Verifica se a conexão foi estabelecida com sucesso
if (!$conn) {
    die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
}

// Obtém o RM do usuário armazenado na sessão
session_start();
$rm = mysqli_real_escape_string($conn, $_SESSION['rm']);

// Monta a consulta SQL para recuperar o nome do usuário a partir do rm
$sql = "SELECT * FROM usuarios WHERE rm = $rm";

// Executa a consulta SQL
$resultado = mysqli_query($conn, $sql);

// Verifica se a consulta retornou resultados
if (mysqli_num_rows($resultado) > 0) {
    // Obtém o array associativo com os resultados da consulta
    $linha = mysqli_fetch_assoc($resultado);
    
    // Armazena o nome do usuário em uma variável
    $nome = $linha['nome'];
} else {
    // Se a consulta não retornou resultados, exibe uma mensagem de erro
    echo "Erro: usuário não encontrado.";
}

// Encerra a conexão com o banco de dados
mysqli_close($conn);

?>

<!-- Exibe o nome do usuário na tela -->
<h1>Olá, <?php echo $nome; ?>. Seja bem-vindo ao ESTATEC!</h1>

</h1>
    
</body>
</html>