<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION["rm"])) {
    header("Location: login.php");
    exit();
}

include 'conexao.php';

// Recupera o ID do estágio do parâmetro da URL
$id = $_GET['id'];

// Consulta para recuperar as informações do estágio pelo ID
$sql = "SELECT * FROM estagios WHERE id = $id";
$resultado = mysqli_query($conn, $sql);
$estagio = mysqli_fetch_assoc($resultado);

// Verifica se o estágio foi encontrado
if (!$estagio) {
    // Redireciona de volta para a página de lista de estágios se o estágio não existir
    header("Location: estagios.php");
    exit();
}

// Verifica se foi enviado um currículo
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['curriculo'])) {
    // Verifica se não houve erro no upload do arquivo
    if ($_FILES['curriculo']['error'] === UPLOAD_ERR_OK) {
        $nomeArquivo = $_FILES['curriculo']['name'];
        $caminhoArquivo = $_FILES['curriculo']['tmp_name'];

        // Endereço de e-mail para onde será enviado o currículo
        $emailDestino = 'ariel.aio@etec.sp.gov.br';

        // Cabeçalhos do e-mail
        $headers = "From: gabriel.baria@etec.sp.gov.br\r\n";
        $headers .= "Reply-To: ariel.aio@etec.sp.gov.br\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: multipart/mixed; boundary=\"boundary\"\r\n";

        // Mensagem do e-mail
        $mensagem = "--boundary\r\n";
        $mensagem .= "Content-Type: text/plain; charset=\"utf-8\"\r\n";
        $mensagem .= "Content-Transfer-Encoding: 7bit\r\n";
        $mensagem .= "\r\n";
        $mensagem .= "Segue em anexo o currículo enviado pelo candidato.\r\n";
        $mensagem .= "\r\n";
        $mensagem .= "--boundary\r\n";
        $mensagem .= "Content-Type: application/pdf; name=\"$nomeArquivo\"\r\n";
        $mensagem .= "Content-Transfer-Encoding: base64\r\n";
        $mensagem .= "Content-Disposition: attachment; filename=\"$nomeArquivo\"\r\n";
        $mensagem .= "\r\n";
        $mensagem .= chunk_split(base64_encode(file_get_contents($caminhoArquivo))) . "\r\n";
        $mensagem .= "\r\n";
        $mensagem .= "--boundary--";

        // Envia o e-mail com o currículo anexado
        if (mail($emailDestino, 'Currículo', $mensagem, $headers)) {
            $mensagemSucesso = "O currículo foi enviado com sucesso.";
        } else {
            $mensagemErro = "Ocorreu um erro ao enviar o currículo.";
        }
    } else {
        $mensagemErro = "Ocorreu um erro no upload do currículo.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="assets/css/estagio.css">
    <title>Enviar Currículo</title>
</head>
<body>
    <h1>Enviar Currículo</h1>

    <div class="estagio-details">
        <h2><?php echo $estagio['nome']; ?></h2>
        <?php if (isset($mensagemSucesso)) { ?>
            <p class="sucesso"><?php echo $mensagemSucesso; ?></p>
        <?php } ?>
        <?php if (isset($mensagemErro)) { ?>
            <p class="erro"><?php echo $mensagemErro; ?></p>
        <?php } ?>
        <?php if ($_SERVER['REQUEST_METHOD'] !== 'POST' || isset($mensagemErro)) { ?>
            <form method="post" enctype="multipart/form-data">
                <label for="curriculo">Selecione o currículo em PDF:</label>
                <input type="file" id="curriculo" name="curriculo" accept="application/pdf" required>
                <button type="submit" class="button">Enviar</button>
            </form>
        <?php } elseif (isset($_FILES['curriculo'])) { 
            // Mova o arquivo enviado para um diretório acessível pelo navegador
            $diretorioDestino = "uploads/";
            $caminhoDestino = $diretorioDestino . $_FILES['curriculo']['name'];
            move_uploaded_file($_FILES['curriculo']['tmp_name'], $caminhoDestino);
        ?>
            <embed src="<?php echo $caminhoDestino; ?>" type="application/pdf" width="100%" height="600px">
        <?php } ?>
    </div>

    <a href="estagios.php" class="button">Voltar para a Lista de Estágios</a>
    
</body>
</html>


<?php
// Encerra a conexão com o banco de dados
mysqli_close($conn);
?>
