<?php

// inclui o arquivo de conexão com o banco de dados
include ('conexao.php');

// inicia a sessão
session_start();

// obtém o RM do usuário armazenado na sessão e o sanitiza
$rm = filter_var($_SESSION['rm'], FILTER_SANITIZE_NUMBER_INT);

// verifica se o RM é válido
if (!is_numeric($rm)) {
    die("Erro: RM inválido.");
}

// monta a consulta SQL para recuperar o nome do usuário a partir do RM
$sql = "SELECT nome FROM usuarios WHERE rm = $rm";

// executa a consulta SQL
$resultado = mysqli_query($conn, $sql);

// verifica se a consulta retornou resultados
if (mysqli_num_rows($resultado) > 0) {
    // obtém o array associativo com os resultados da consulta
    $linha = mysqli_fetch_assoc($resultado);

    // armazena o nome do usuário em uma variável
    $nome = $linha['nome'];
} else {
    // se a consulta não retornou resultados, exibe uma mensagem de erro
    echo "Erro: usuário não encontrado.";
}

// fecha a conexão com o banco de dados
mysqli_close($conn);

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/index.css">
    <script src="assets/js/index.js"></script>
    <title>ESTATEC</title>
</head>
<body>
    <header>
       <p>ESTATEC</p>
       <div class="header-links">
           <a href="estagios.php">Estágios</a>
           <a href="#">Sobre</a>
           <a href="dicas.php">Dicas</a>
           <button><a href="perfil.php">PERFIL</a></button>
       </div>
    </header>
    <main>
        <div class="text-main">
            <h1>
                OLÁ <?php echo $nome; ?>,<br>
                SEJA BEM VINDO!
            </h1>
            <p>
                ESTATEC é um site gerenciador de estágios, criado por <br>
                alunos da ETEC Fernandópolis, com o intuito de melhor <br>
                organização de oportunidades de trabalho de estágios <br>
                oferecidos pela instituição. <br>
                Para ver os estágios disponíveis entre na área de <br>
                estágios. <br>
                Caso tenha dúvidas sobre como estagiar e o que é <br>
                necessário para estagiar, vá para área de dicas. <br>
                Acesse a aba sobre se tiver a procura de informações <br>
                sobre o contato dos desenvolvedores.
            </p>
        </div>
        <img src="assets/images/index/img-index.svg" alt="Imagem da Página Inicial">
    </main>
</body>
</html>