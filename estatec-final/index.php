<?php

// inclui o arquivo de conexão com o banco de dados
include ('src/conexao.php');

// inicia a sessão
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION["rm"])) {
    header("Location: view/login.php");
    exit();
}

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
    <link rel="stylesheet" href="view/assets/css/index.css">
    <script src="assets/js/index.js"></script>
    <link rel="shortcut icon" href="view/assets/images/Logo-03.1.ico" type="image/x-icon">
    <title>ESTATEC</title>
</head>
<body>
    <header>
       <a class="header-logo" href="index.php">ESTATEC</a>
       <div class="header-links">
           <a href="view/estagios.php">Estágios</a>
           <a href="#sobre">Sobre</a>
           <a href="view/dicas.php">Dicas</a>
           <button><a href="view/perfil.php">PERFIL</a></button>
       </div>
    </header>
    <main>
        <div class="text-main">
            <h1>
                OLÁ <span><?php echo $nome; ?> </span>,
                SEJA BEM VINDO!
            </h1>
            <p>
                ESTATEC é um site gerenciador de estágios, criado por 
                alunos da ETEC Fernandópolis, com o intuito de melhor 
                organização de oportunidades de trabalho de estágios 
                oferecidos pela instituição. 
                Para ver os estágios disponíveis entre na área de 
                estágios. 
                Caso tenha dúvidas sobre como estagiar e o que é 
                necessário para estagiar, vá para área de dicas. 
                Acesse a aba sobre se tiver a procura de informações 
                sobre o contato dos desenvolvedores.
            </p>
        </div>
        <img src="view/assets/images/index/img-index.svg" alt="Imagem da Página Inicial">
    </main>
    <section id="sobre">
        <h1>SOBRE O ESTATEC</h1>
        <p>
            ESTATEC é um site gerenciador de estágios, criado por
            alunos da ETEC Fernandópolis, com o intuito de melhor 
            organização de oportunidades de trabalho de estágios 
            oferecidos pela instituição
        </p>
    </section>
    <footer>
        <div class="contacts-footer">
            <p class="contacts-title">CONTATO</p>
            <div class="local-footer">
                <img src="view/assets/images/index/local-footer.png" alt="Endereço da ETEC">
                <p>
                    Av. Geraldo Roquete, 135 - <br>
                    Jardim Paulista, <br>
                    Fernandópolis - SP, 15606-020
                </p>
            </div>
        </div>
        <div class="numbers-footer">
            <p> <img src="view/assets/images/index/phone-footer.png" alt="Icon de telefone"> (17)3462-3030</p>
            <p><img src="view/assets/images/index/phone-footer.png" alt="Icon de telefone"> (17)3462-3311</p>
            <p>
                <img src="view/assets/images/index/app-footer.png" alt="Icon do Whatsapp"> (17)99612-7627 <br>
                WhatsApp (Somente mensagens)
            </p>
        </div>
    </footer>
</body>
</html>