<?php
session_start();
include_once('config.php');

// Verificar se a sessão está definida para 'matricula'
if (!isset($_SESSION['matricula'])) {
    header('Location: home.php');
    exit;
}

$matricula = $_SESSION['matricula'];

 // Consulta SQL atualizada para incluir safe_key
$sql = "SELECT nome, email, telefone, safe_key FROM alunos WHERE matricula = ?";
if ($stmt = $conexao->prepare($sql)) {
    $stmt->bind_param('s', $matricula);
    $stmt->execute();
    // Bind the result including safe_key
    $stmt->bind_result($nome, $email, $telefone, $safe_key);
    $stmt->fetch();
    $stmt->close();
} else {
    echo "Erro na consulta: " . $conexao->error;
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kaiman System | Verificar Dados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <style>
        body {
            background-image: linear-gradient(to top, #92e06e, #3a6925);
            color: white;
            text-align: center;
            font-family: Arial, sans-serif;
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
            background-color: #829d5e;
            display: flex;
            justify-content: space-between;
            padding: 0 10px; 
            z-index: 1000;
            height: 50px; 
            align-items: center; 
        }

        .navbar-brand {
            font-family: 'Bebas Neue', cursive;
            font-size: 16px; 
            color: white;
        }

        .navbar-brand img {
            border-radius: 50%;
            width: 30px;
            height: 30px;
            margin-right: 10px;
        }

        .btn-danger {
            font-family: 'Bebas Neue', cursive;
            font-size: 14px; 
        }

        .data-container {
            background: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            padding: 20px;
            margin: 20px;
            max-width: 600px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            text-align: left;
        }

        .data-container h2 {
            color: #829d5e;
            font-family: 'Bebas Neue', cursive;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            margin-bottom: 20px;
            font-size: 36px;
        }

        .data-container p {
            font-size: 18px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="perfil_alunos.php">
            <img src="IMG/perfil.png" alt="Perfil">
            Meu Perfil
        </a>
        <div class="d-flex">
            <a href="sair.php" class="btn btn-danger me-3">Sair</a>
        </div>
    </nav> 

    <div class="data-container">
        <h2>Dados do Usuário</h2>
        <p><strong>Nome:</strong> <?php echo htmlspecialchars($nome); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
        <p><strong>Telefone:</strong> <?php echo htmlspecialchars($telefone); ?></p>
        <p><strong>Chave de segurança:</strong> <?php echo htmlspecialchars($safe_key); ?></p>
    </div>

</body>
</html>
