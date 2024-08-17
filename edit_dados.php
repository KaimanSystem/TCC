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
            background-image: linear-gradient(to bottom, #dfe2e6, #829d5e);
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
    </style>
</head>
<body>
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
        <!-- Aqui você pode adicionar tabelas ou gráficos com os dados dos alunos -->
    </div>
</body>
</html>

