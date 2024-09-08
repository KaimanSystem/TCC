<?php
include_once('config.php');

$token = $_GET['token'] ?? '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nova_senha = $_POST['nova_senha'];

    //  Validar o token e obter o email associado
    $sql = "SELECT email FROM alunos WHERE token_recuperacao = ? AND TIMESTAMPDIFF(HOUR, data_token, NOW()) < 24";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param('s', $token);
    $stmt->execute();
    $stmt->bind_result($email);
    $stmt->fetch();
    $stmt->close();

    if ($email) {
        // Atualizar a senha no banco de dados (sem hashing)
        $sql = "UPDATE alunos SET senha = ?, token_recuperacao = NULL, data_token = NULL WHERE email = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param('ss', $nova_senha, $email);
        $stmt->execute();
        $stmt->close();

        echo "Senha redefinida com sucesso!";
        header('Location:popup_geral.php');
    } else {
        echo "Token inválido ou expirado.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
    <link href="https://fonts.cdnfonts.com/css/bebas-neue" rel="stylesheet">
    <style>
        @import url('https://fonts.cdnfonts.com/css/bebas-neue');

        body {
            font-family: 'Bebas Neue', sans-serif;
            background-image: linear-gradient(to top, #92e06e, #3a6925);
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            width: 90%;
            max-width: 400px;
            background-color: rgba(0, 0, 0, 0.8);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            text-align: center;
        }
        h1 {
            margin-bottom: 20px;
            color: #ffffff;
        }
        label {
            color: #ffffff;
            display: block;
            margin-bottom: 10px;
            text-align: left;
        }
        input[type="password"] {
            width: calc(100% - 22px); /* Ajustado para o padding e border */
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ffffff;
            border-radius: 5px;
            outline: none;
            color: #ffffff;
            background-color: transparent;
        }
        input[type="submit"] {
            background-image: linear-gradient(to right, #568915, #3c6e3e);
            width: 100%;
            border: none;
            padding: 15px;
            color: #ffffff;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
            margin-top: 20px;
        }
        input[type="submit"]:hover {
            background-image: linear-gradient(to right, #3c6e3e, #568915);
        }
    </style>
</head>
<body>  
    <div class="container">
        <h1>Redefinir Senha</h1>
        <form action="" method="POST">
            <label for="nova_senha">Digite sua nova senha:</label>
            <input type="password" id="nova_senha" name="nova_senha" required>
            <input type="submit" value="Redefinir Senha">
        </form>
    </div>
</body>
</html>
