<?php
// inclui o arquivo de conexão com o banco de dados
include ('../src/conexao.php');

// inicia a sessão
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION["rm"])) {
    header("Location: ../view/login.php");
    exit();
}

// obtém o RM do usuário armazenado na sessão e o sanitiza
$rm = filter_var($_SESSION['rm'], FILTER_SANITIZE_NUMBER_INT);

// verifica se o RM é válido
if (!is_numeric($rm)) {
    die("Erro: RM inválido.");
}

// Consulta para recuperar todos os estágios cadastrados no banco de dados
$sql = "SELECT * FROM estagios";
$resultado = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/Logo-03.1.ico" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/estagios.css">
    <title>Lista de Estágios</title>
</head>
<body>
    <header>
            <a class="header-logo" href="../index.php">ESTATEC</a>
            <div class="header-links">
                <a href="estagios.php">Estágios</a>
                <a href="../index.php">Sobre</a>
                <a href="dicas.php">Dicas</a>
                <button><a href="view/perfil.php">PERFIL</a></button>
            </div>
    </header>
    <main>
            <h1>Lista de Estágios</h1>
            <table>
                <thead>
                    <tr> 
                        <th>Nome</th>
                        <th>Assunto</th>
                        <th>Data de Validade</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($estagio = mysqli_fetch_assoc($resultado)) { ?>
                    <tr class=fundoestagio data-id="<?php echo $estagio['id']; ?>">
                        <td ><?php echo $estagio['nome']; ?></td>
                        <td><?php echo $estagio['assunto']; ?></td>
                        <td><?php echo $estagio['data_validade']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
                
            </table>
        </main>

        <script src="assets/js/estagios.js"></script>

</body>

</html>

<?php
// Encerra a conexão com o banco de dados
mysqli_close($conn);
?>
