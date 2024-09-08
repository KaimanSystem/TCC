<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auditoria | Sistema | Kaiman System</title>
    <link href="https://fonts.cdnfonts.com/css/bebas-neue" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        @import url('https://fonts.cdnfonts.com/css/bebas-neue');

        body {
            font-family: 'Bebas Neue', sans-serif;
            background-image: linear-gradient(to top, #92e06e, #3a6925);
            text-align: center;
            color: #ffffff;
            margin: 0;
            height: 100vh; 
            display: flex;
            flex-direction: column;
            justify-content: center;
        } 
        .box {
            position: relative;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 30px;
            border-radius: 20px;
            display: inline-block;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 80%;
            max-width: 500px;

            margin: 0 auto; /* Center horizontally */
        }
        a {
            text-decoration: none;
            color: white;
            border: 3px solid #568915;
            border-radius: 15px;
            padding: 10px;
            margin: 0 10px;
            display: block;
            margin-bottom: 10px;
        }
        a:hover {
            background-color: #568915;
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
        .back-btn:hover {
            background-color: #568915;
        }
        .back-btn i {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <a href="funcao_servidores.php" class="back-btn"><i class="fas fa-arrow-left"></i>VOLTAR</a>
    <div class="box">
        <h1>Auditoria do Sistema</h1>
        <p>Conteúdo específico para auditoria do sistema.</p>
        <div class="box">
        <h1>Escolha o Tipo de Função</h1>
        <br>
        <a href="dados/RM_usuario.php"> Remover Usuário do Sistema</a>
        <a href="dados/RM_PC.php">Remover usuário de algum PC</a>
        <a href="dados/ADD(ADM)_usuario.php"> Adicionar usuário admin</a>
        <a href="dados/ADD_usuario.php"> Adicionar usuário da comunidade</a>
        
    </div>
         <!-- Em breve -->
    </div>
</body>
</html>

