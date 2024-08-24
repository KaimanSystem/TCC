
<?php
    if(isset($_POST['submit'])){    
        include_once('config.php');

        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $matricula = $_POST['matricula'];
        $telefone = $_POST['telefone'];
        
         // Executar a query para inserir os dados na tabela
        $result = mysqli_query($conexao, "INSERT INTO servidores(nome,email,senha,matricula,telefone)  VALUES('$nome', '$email', '$senha', '$matricula', '$telefone')");

        // Verificar se a inserção foi bem-sucedida
        if ($result) {
            // Redirecionar para a página de sucesso com o pop-up
            header('Location: servidores_popup_sucesso.php');
            exit;
        } else {
            // Em caso de falha na inserção
            echo "Erro ao registrar: " . mysqli_error($conexao);
        }
    
        // Fecha a conexão com o banco de dados
        mysqli_close($conexao);
    }
    ?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro | Servidores </title>
    <link href="https://fonts.cdnfonts.com/css/bebas-neue" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
            width: 80%;
            max-width: 600px;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            position: relative; /* Para permitir posicionamento absoluto dentro */
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
            margin-top: 10px; /* Apenas um pouco abaixo */
        }
        .back-btn:hover {
            background-color: #568915;
        }
        .back-btn i {
            margin-right: 5px;
        }
        .form-container {
            margin-top: 30px; /* Ajusta o espaço entre o botão e o formulário */
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
        }
        .inputUser:focus ~ .LabelInput,
        .inputUser:valid ~ .LabelInput {
            top: -20px;
            font-size: 12px;
            color: greenyellow;
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
            background-image: linear-gradient(to right, #568915, green);
            width: 100%;
            border: none;
            padding: 15px;
            color: #ffffff;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
            margin-top: 20px;
        }
        #submit:hover {
            background-image: linear-gradient(to right, #568915, green);
        }
        .curso-options {
            text-align: left;
        }
        .curso-options input {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <a href="home.php" class="back-btn"><i class="fas fa-arrow-left"></i>VOLTAR</a>
    <div class="container">
        <div class="form-container">
            <form action="formulario_servidores.php" method="POST">
                <fieldset>
                    <legend><b>Cadastro de Servidores</b></legend>
                    <div class="inputBox">
                        <input type="text" name="nome" id="nome" class="inputUser" required>
                        <label for="nome" class="LabelInput">Nome completo</label>
                    </div>
                    <div class="inputBox">
                        <input type="text" name="email" id="email" class="inputUser" required>
                        <label for="email" class="LabelInput">Email</label>
                    </div>
                    <div class="inputBox">
                        <input type="password" name="senha" id="senha" class="inputUser" required>
                        <label for="senha" class="LabelInput">Senha</label>
                    </div>
                    <div class="inputBox">
                        <input type="text" name="matricula" id="matricula" class="inputUser" required>
                        <label for="matricula" class="LabelInput">Matrícula</label>
                    </div>
                    <div class="inputBox">
                        <input type="tel" name="telefone" id="telefone" class="inputUser" required>
                        <label for="telefone" class="LabelInput">Telefone</label>
                    </div>                   
                    <input type="submit" name="submit" id="submit" value="Cadastrar">
                </fieldset>
            </form>
            <p>Já tem uma conta? <a href="login_servidores.php" style="color: #568915;">Faça login aqui</a>.</p>
        </div>
    </div>
</body>
</html>
