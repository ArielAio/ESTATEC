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

// Verifica se foi fornecido um ID válido para o estágio a ser editado
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $idEstagio = $_GET['id'];

    // Verifica se o estágio existe no banco de dados
    $sql = "SELECT * FROM estagios WHERE id = $idEstagio";
    $resultado = mysqli_query($conn, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        // Obtém os dados do estágio
        $estagio = mysqli_fetch_assoc($resultado);
    } else {
        // Redireciona para a lista de estágios caso o estágio não seja encontrado
        header("Location: estagios.php");
        exit();
    }
} else {
    // Redireciona para a lista de estágios caso o ID não seja fornecido
    header("Location: estagios.php");
    exit();
}

// Verifica se o formulário foi submetido para atualizar o estágio
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['atualizar'])) {
    // Obtém os dados do formulário
    $nome = $_POST['nome'];
    $assunto = $_POST['assunto'];
    $dataValidade = $_POST['data_validade'];

    // Atualiza o estágio no banco de dados
    $sql = "UPDATE estagios SET nome = '$nome', assunto = '$assunto', data_validade = '$dataValidade' WHERE id = $idEstagio";

    if (mysqli_query($conn, $sql)) {
        // Redireciona para a página correta após a atualização
        if ($_SESSION["rm"] == "08670") {
            header("Location: estagios-adm.php");
        } else {
            header("Location: estagios.php");
        }
        exit();
    } else {
        // Exibe uma mensagem de erro em caso de falha na atualização
        $mensagemErro = "Erro ao atualizar o estágio: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/estagio.css">
    <link rel="shortcut icon" href="assets/images/Logo-03.1.ico" type="image/x-icon">
    <title>Editar Estágio</title>
</head>
<body>
    <h1>Editar Estágio</h1>

    <?php if (isset($mensagemErro)) { ?>
        <p><?php echo $mensagemErro; ?></p>
    <?php } ?>

    <form method="POST" action="">
        <div class="estagio-details">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo $estagio['nome']; ?>" required>

            <label for="assunto">Assunto:</label>
            <input type="text" id="assunto" name="assunto" value="<?php echo $estagio['assunto']; ?>" required>

            <label for="data_validade">Data de Validade:</label>
            <input type="date" id="data_validade" name="data_validade" value="<?php echo $estagio['data_validade']; ?>" required>   

            <input type="submit" name="atualizar" value="Atualizar">
        </div>
    </form>

    <?php if ($_SESSION["rm"] == "08670") { ?>
        <a href="estagios-adm.php" class="button">Voltar para a Lista de Estágios</a>
    <?php } else { ?>
        <a href="estagios.php" class="button">Voltar para a Lista de Estágios</a>
    <?php } ?>

</body>
</html>

<?php
// Encerra a conexão com o banco de dados
mysqli_close($conn);
?>
