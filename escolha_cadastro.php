<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escolha de Cadastro | Kaiman System</title>
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
        <h1>Escolha o Tipo de Cadastro</h1>
        <br>
        <a href="formulario_aluno.php">Alunos</a>
        <a href="formulario_servidores.php">Servidores</a>
        <a href="formulario_comunidade.php">Comunidade</a>
    </div>
</body>
</html>
