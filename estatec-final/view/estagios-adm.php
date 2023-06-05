<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION["rm"])) {
    header("Location: ../view/login.php");
    exit();
}

// Verifica se o RM é igual a "08670"
if ($_SESSION["rm"] !== "08670") {
    header("Location: ../view/acesso-negado.php"); // Página de acesso negado
    exit();
}

include('../src/conexao.php');

// Verifica se foi solicitada a exclusão de um estágio
if (isset($_GET['excluir']) && !empty($_GET['excluir'])) {
    $idExcluir = $_GET['excluir'];

    // Exclui o estágio do banco de dados
    $excluirEstagio = "DELETE FROM estagios WHERE id=?";
    $stmt = mysqli_prepare($conn, $excluirEstagio);
    mysqli_stmt_bind_param($stmt, 'i', $idExcluir);
    mysqli_stmt_execute($stmt);

    // Verifica se a exclusão foi realizada com sucesso
    if (mysqli_affected_rows($conn) > 0) {
        header("Location: estagios-adm.php");
        exit();
    } else {
        echo "Erro ao excluir o estágio.";
    }

    mysqli_stmt_close($stmt);
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
    <link rel="stylesheet" href="assets/css/estagios.css">
    <link rel="shortcut icon" href="assets/images/Logo-03.1.ico" type="image/x-icon">
    <title>Lista de Estágios</title>
</head>
<body>
    <header>
       <a class="header-logo" href="../index-adm.php">ESTATEC</a>
       <div class="header-links">
            <a href="estagios-adm.php">Estágios</a>
            <a href="../index-adm.php">Sobre</a>
            <a href="dicas.php">Dicas</a>
            <button><a href="perfil.php">PERFIL</a></button>
        </div>
    </header>
    <h1>Lista de Estágios</h1>
    <table>
        <thead>
            <tr> 
                <th>Nome</th>
                <th>Assunto</th>
                <th>Data de Validade</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($estagio = mysqli_fetch_assoc($resultado)) { ?>
            <tr class="fundoestagio" data-id="<?php echo $estagio['id']; ?>">
                <td><?php echo $estagio['nome']; ?></td>
                <td><?php echo $estagio['assunto']; ?></td>
                <td><?php echo $estagio['data_validade']; ?></td>
                <td>
                    <a href="editar-estagio.php?id=<?php echo $estagio['id']; ?>">Editar</a>
                    <a href="estagios-adm.php?excluir=<?php echo $estagio['id']; ?>" onclick="return confirm('Tem certeza de que deseja excluir este estágio?')">Excluir</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="cadastrar-estagio.php" class="button">CADASTRAR ESTÁGIO</a>

    <script src="assets/js/estagios.js"></script>

</body>
</html>

<?php
// Encerra a conexão com o banco de dados
mysqli_close($conn);
?>
