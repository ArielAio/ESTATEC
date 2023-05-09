<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Estágio</title>
</head>
<body>
    <form action="cadastro-estagio.php" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" placeholder="ex: consultório odontológico">
        
        <label for="assunto">Assunto:</label>
        <input id="assunto" type="text" placeholder="ex: Estágio em consultório">

        <label for="requisitos">Requisitos:</label>
        <textarea name="requisitos" id="requisitos" cols="30" rows="3" placeholder="ex: onde deve estudar, noções básicas, competências..."></textarea>
        
        <label for="carga-horaria">Carga horária:</label>
        <input type="text" id="carga-horaria" placeholder="ex: segunda a sexta-feira 6 horas por dia">

        <label for="atividades">Principais atividades:</label>
        <input type="text" name="atividades" id="atividades" placeholder="ex: atividades administrativas, atendimento ao público...">

        <label for="salario">Salário:</label>
        <input type="text" name="salario" id="salario" placeholder="ex: bolsas + valor + seguros">

        <label for="data">Data de validade:</label>
        <input id="data" type="date"> 

        <input id="enviar" class="enviar" type="submit" value="Enviar">

</form>
</body>
</html>