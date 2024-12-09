<?php
if (isset($_POST['submit'])) {
    include_once('config.php');

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $matricula = $_POST['matricula'];
    $telefone = $_POST['telefone'];
    $curso = $_POST['curso'];
    $safe_key = $_POST['safe_key'];

    // Validação do prontuário
    if (!preg_match('/^JC[0-9]+$/', $matricula)) {
        echo "O prontuário deve começar com 'JC' seguido de números.";
        exit;
    }

    // Validação do formato do email
    if (!preg_match('/^[a-zA-Z0-9._%+-]+@aluno\.ifsp\.edu\.br$/', $email)) {
        echo "O email deve seguir o formato 'exemplo@aluno.ifsp.edu.br'.";
        exit;
    }

    // Validação do número de telefone (somente 9 dígitos)
    if (!preg_match('/^[0-9]{9}$/', $telefone)) {
        echo "O telefone deve ter exatamente 9 dígitos.";
        exit;
    }

    // Verifica se o prontuário já existe no banco
    $checkQuery = "SELECT * FROM alunos WHERE matricula='$matricula'";
    $checkResult = mysqli_query($conexao, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        echo "Prontuário já existe.";
        exit;
    }
    // Verifica se o email já existe no banco
    $checkQuery = "SELECT * FROM alunos WHERE email='$email'";
    $checkResult = mysqli_query($conexao, $checkQuery);
    
    if (mysqli_num_rows($checkResult) > 0) {
        echo "email já existe.";
        exit;
    }

    // Inserir os dados na tabela
    $result = mysqli_query($conexao, "INSERT INTO alunos(nome, email, senha, matricula, telefone, safe_key, curso) 
    VALUES('$nome', '$email', '$senha', '$matricula', '$telefone', '$safe_key', '$curso')");

    if ($result) {
        header('Location: alunos_popup_sucesso.php');
        exit;
    } else {
        echo "Erro ao registrar: " . mysqli_error($conexao);
    }

    mysqli_close($conexao);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro | Aluno</title>
    <link href="https://fonts.cdnfonts.com/css/bebas-neue" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>

body {
    font-family: sans-serif;
    background-image: linear-gradient(to top, #92e06e, #3a6925);
    margin: 0;
    padding: 0;
    height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.container {
    width: 80%;
    max-width: 600px;
    background-color: rgba(0, 0, 0, 0.7);
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    position: relative;
}

.back-btn {
    background-color: rgba(0, 0, 0, 0.7);
    color: #ffffff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    font-size: 16px;
    cursor: pointer;
    position: absolute;
    top: 20px;
    left: 20px;
}

.back-btn i {
    margin-right: 5px;
}

.form-container {
    margin-top: 30px;
    color: #ffffff;
}

.inputBox {
    position: relative;
    margin-bottom: 20px;
}

.inputUser {
    background: none;
    border: none;
    border-bottom: 1px solid #ffffff;
    outline: none;
    color: #ffffff;
    font-size: 15px;
    width: 100%;
    letter-spacing: 2px;
}

.LabelInput {
    position: absolute;
    top: 0px;
    left: 0px;
    pointer-events: none;
    transition: .5s;
    color: #ffffff; /* Cor padrão do label */
}

.inputUser:focus ~ .LabelInput,
.inputUser:valid ~ .LabelInput {
    top: -20px;
    font-size: 12px;
    color: greenyellow; /* Cor do label quando em foco */
}

fieldset {
    border: 3px solid #568915;
    border-radius: 10px;
    padding: 20px;
    text-align: center;
}

legend {
    border: 1px solid #568915;
    text-align: center;
    background-color: #568915;
    border-radius: 5px;
    color: white;
    padding: 5px 10px;
    margin-bottom: 10px;
    width: auto;
}

#submit {
    background-color: #568915; /* Cor do fundo do botão */
    width: 100%;
    border: none;
    padding: 15px;
    color: #ffffff;
    font-size: 15px;
    cursor: pointer;
    border-radius: 10px;
    margin-top: 20px;
}

.curso-options {
    text-align: left;
}

.curso-options input {
    margin-right: 10px;
}

.footer {
    margin-top: 20px;
    font-size: 14px;
    color: red;
}

.footer b {
    font-weight: bold;
}
</style>
</head>
<body>
    <a href="home.php" class="back-btn"><i class="fas fa-arrow-left"></i>VOLTAR</a>
    <div class="container">
        <div class="form-container">
            <form action="formulario_aluno.php" method="POST">
                <fieldset>
                    <legend><b>Cadastro de Alunos</b></legend>
                    <div class="inputBox">
                        <input type="text" name="nome" id="nome" class="inputUser" required>
                        <label for="nome" class="LabelInput">Nome completo</label>
                    </div>
                    <div class="inputBox">
                        <input type="password" name="senha" id="senha" class="inputUser" required>
                        <label for="senha" class="LabelInput">Senha</label>
                    </div>
                    <div class="inputBox">
                        <input type="text" name="matricula" id="matricula" class="inputUser" pattern="^JC[0-9]+$" title="O prontuário deve começar com 'JC' seguido de números" required>
                        <label for="matricula" class="LabelInput">Matrícula</label>
                    </div>
                    <div class="inputBox">
                        <input type="email" name="email" id="email" class="inputUser" pattern="[a-zA-Z0-9._%+-]+@aluno\.ifsp\.edu\.br$" title="O email deve seguir o formato 'exemplo@aluno.ifsp.edu.br'" required>
                        <label for="email" class="LabelInput">Email</label> 
                    </div>
                    <div class="inputBox">
                        <input type="tel" name="telefone" id="telefone" class="inputUser" pattern="[0-9]{9}" title="O telefone deve ter exatamente 9 dígitos" required>
                        <label for="telefone" class="LabelInput">Telefone</label>
                    </div>
                    <div class="inputBox">
                        <input type="text" name="safe_key" id="safe_key" class="inputUser" required>
                        <label for="safe_key" class="LabelInput">Chave de Segurança</label>
                    </div>
                    <div class="inputBox curso-options">
                        <label><b>Curso:</b></label><br>
                        <input type="radio" name="curso" value="ADS" id="ADS">
                        <label for="ADS">ADS</label><br>
                        <input type="radio" name="curso" value="TÉC INFO" id="TÉC INFO">
                        <label for="TÉC INFO">TÉC INFO</label><br>
                        <input type="radio" name="curso" value="TÉC ADM" id="TÉC ADM">
                        <label for="TÉC ADM">TÉC ADM</label><br>
                        <input type="radio" name="curso" value="outro" id="outro">
                        <label for="outro">OUTRO</label>
                    </div>
                    <input type="submit" name="submit" id="submit" value="Cadastrar">
                </fieldset>
            </form>
        </div>
        <div class="footer">
        <p><b>A chave de segurança não pode ser compartilhada com ninguém.</b> Ela será utilizada para a troca de senhas.</p>
    </div>
    </div>
</body>
</html>
