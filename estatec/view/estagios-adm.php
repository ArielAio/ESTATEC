<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION["rm"])) {
    header("Location: login.php");
    exit();
}

// Verifica se o RM é igual a "08670"
if ($_SESSION["rm"] !== "08670") {
    header("Location: acesso-negado.php"); // Página de acesso negado
    exit();
}

include 'conexao.php';

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
    <title>Lista de Estágios</title>
</head>
<body>
<header>
       <p>ESTATEC</p>
       <div class="header-links">
           <a href="estagios.php">Estágios</a>
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
                <th>Requisitos</th>
                <th>Carga Horária</th>
                <th>Atividades</th>
                <th>Salário</th>
                <th>Data de Validade</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($estagio = mysqli_fetch_assoc($resultado)) { ?>
            <tr class=fundoestagio data-id="<?php echo $estagio['id']; ?>">
                <td ><?php echo $estagio['nome']; ?></td>
                <td><?php echo $estagio['assunto']; ?></td>
                <td><?php echo $estagio['requisitos']; ?></td>
                <td><?php echo $estagio['carga_horaria']; ?></td>
                <td><?php echo $estagio['atividades']; ?></td>
                <td><?php echo $estagio['salario']; ?></td>
                <td><?php echo $estagio['data_validade']; ?></td>
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
