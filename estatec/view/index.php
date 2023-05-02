<?php

include('conexao.php');

session_start();

// if(isset($_POST['login'])) {
//     $rm = $_POST['rm'];
//     $senha = $_POST['senha'];

//     $query_login = "SELECT * FROM usuarios WHERE rm='$rm' AND senha='$senha'";
//     $result_login = mysqli_query($connx, $query_login);

//     if(mysqli_num_rows($result_login) == 1) {
//         $_SESSION['rm'] = $rm;
//         header('location: cadastro.php');
//     } else {
//         echo "<script>alert('RM ou senha incorretos. Tente novamente.');</script>";
//     }
// }

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Verifica se a conexão foi estabelecida com sucesso
    if (!$connx) {
        die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
    }

    // Recebe os dados do formulário
    $rm = mysqli_real_escape_string($connx, $_POST["rm"]);
    $senha = mysqli_real_escape_string($connx, $_POST["senha"]);

    // Realiza a consulta no banco de dados
    $query = "SELECT * FROM usuarios WHERE rm='$rm' AND senha='$senha'";
    $result = mysqli_query($connx, $query);

    // Verifica se o usuário foi encontrado
    if (mysqli_num_rows($result) == 1) {
        // Inicia a sessão e redireciona para a página de cadastro
        session_start();
        $_SESSION["rm"] = $rm;
        header("Location: listagem.php");
        exit();
    } else {
        // Exibe uma mensagem de erro caso o usuário não tenha sido encontrado
        echo "<script>alert('rm ou senha incorretos. Tente novamente.');</script>";
    }

    // Encerra a conexão com o banco de dados
    mysqli_close($connx);
}
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
    <main>
        <div class="big-wrapper">
            <header>
                <div class="container">
                    <div class="logo">
                        <img src="../view/assets/images/index/logo.png" alt="Logo Estatec">
                        <h3>ESTATEC</h3>
                    </div>

                    <div class="links">
                        <ul>
                            <li><a href="#">Estágios</a></li>
                            <li><a href="#"></a>Trabalhos</li>
                            <li><a href="#"></a>Contatos</li>
                            <li><a href="#" class="btn">Perfil</a></li>
                        </ul>
                    </div>
                </div>
            </header>

            <div class="showcase-area">
                <div class="container">
                    <div class="left">
                        <div class="big-title">
                            <h1>ESTATEC</h1>
                            <h1>ALALALAL</h1>
                        </div>
                        <p class="text">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Officia consequatur ipsum, soluta cupiditate nostrum quidem incidunt repudiandae eos veritatis ipsam culpa deleniti omnis doloribus quaerat.
                            Labore cupiditate quod unde reiciendis.
                        </p>
                    
                        <div class="cta">
                            <a href="#" class="btn">Get Started</a>
                        </div>
                    </div>
                    <div class="right">
                        <img src="../view/assets/images/index/person.png" alt="Pessoa">
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>