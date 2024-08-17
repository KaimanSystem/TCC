<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Comunidade </title>
    <link href="https://fonts.cdnfonts.com/css/bebas-neue" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        @import url('https://fonts.cdnfonts.com/css/bebas-neue');

        body {
            font-family: 'Bebas Neue', sans-serif;
            background-image: linear-gradient(to bottom, #dfe2e6, #829d5e);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .box {
            color: white;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 30px;
            border-radius: 15px;
            width: 80%;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .inputSubmit {
            background-color: #829d5e; /* Same green color as home page */
            width: 100%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
            font-family: 'Bebas Neue', sans-serif;
            text-transform: uppercase;
        }
        .inputUser {
            background: none;
            border: none;
            border-bottom: 1px solid white;
            outline: none;
            color: white;
            font-size: 15px;
            width: 100%;
            letter-spacing: 2px;
            margin-bottom: 10px;
            padding: 10px 0;
            font-family: Arial, Helvetica, sans-serif;
        }
        .back-btn {
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            position: absolute;
            top: 20px;
            left: 20px;
            margin-top: 10px;
        }
        .back-btn:hover {
            background-color: #568915;
        }
        .back-btn i {
            margin-right: 5px;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            .box {
                width: 90%;
            }
        }
    </style>  
</head>
<body>
    <a href="home.php" class="back-btn"><i class="fas fa-arrow-left"></i>Voltar</a>
    <div class="box">
        <h2>Login - Comunidade</h2>
        <form action="sy_login_comunidade.php" method="POST">
            <div class="inputBox">
                <input type="text" name="cpf" id="cpf" class="inputUser" placeholder="cpf" required>
            </div>
            <br><br>
            <div class="inputBox">
                <input type="password" name="senha" id="senha" class="inputUser" placeholder="Senha" required>
            </div>
            <br><br>
            <input class="inputSubmit" type="submit" name="submit" value="Enviar">
        </form>
        <p>Esqueceu a senha? <a href="solicitar_recuperacao.php" style="color: #829d5e;">Recupere aqui</a>.</p>
    </div>
</body>
</html>