<?php
session_start();

// Verificar se a sessão está definida para 'matricula' e não está definida para 'senha'
if (isset($_SESSION['cpf']) && !isset($_SESSION['senha'])) {
    unset($_SESSION['cpf']);
    unset($_SESSION['senha']);
    header('Location: login_comunidade.php');
    exit; 
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Kaiman System | Regras Comunidade</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <style>
    body {
        background: url('IMG/biblioteca.jpg') no-repeat center center fixed;
        background-size: cover;
        color: white;
        text-align: center;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding-top: 60px; 
    }

        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            background-color: #829d5e;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
        }

        .navbar-brand {
            font-family: 'Bebas Neue', cursive;
            font-size: 19px;
            color: white;
            display: flex;
            align-items: center;
        }

        .navbar-brand img {
            border-radius: 50%;
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }

        .btn-danger {
            font-family: 'Bebas Neue', cursive;
        }

        .rules {
            background: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            padding: 20px;
            margin: 20px;
            max-width: 600px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
        }

        .rules h2 {
            color: #829d5e; 
            font-family: 'Bebas Neue', cursive;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            margin-bottom: 20px;
            font-size: 36px;
        }

        .rules ul {
            text-align: left;
            list-style-type: none;
            padding: 0;
        }

        .rules ul li {
            background: rgba(0, 0, 0, 0.2);
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            transition: background 0.3s;
            color: white;
        }

        .rules ul li:hover {
            background: rgba(255, 255, 255, 0.4);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="perfil_comunidade.php">
            <img src="IMG/perfil.png" alt="Perfil">
            Meu Perfil
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="d-flex">
            <a href="sair.php" class="btn btn-danger me-3">Sair</a>
        </div>
    </nav> 
    <div class="rules">
        <h2>Regras da Biblioteca</h2>
        <ul>
            <li>Mantenha o silêncio para não atrapalhar os demais usuários.</li>
            <li>Não utilizar os computadores para jogar.</li>
            <li>Cuide dos livros e do espaço, mantenha tudo organizado.</li>
            <li>Respeite os prazos de devolução dos livros.</li>
            <li>Não coma ou beba dentro da biblioteca.</li>
            <li>Utilize os computadores apenas para atividades acadêmicas.</li>
        </ul>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNOM9JpP8djnkYCy2A4GTLwIF3p0gJ/rf6V1L2Z4p4p3moV9EAO/JZyw6nL2N1N" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVki6k2guE+6Q8XufuhLXciIpluYN4YF7Q1pFf02mC0p4TmK2thH6ke77c/wkckk" crossorigin="anonymous"></script>

</body>
</html>
</body>
</html>



