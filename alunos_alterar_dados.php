<?php
session_start();
include_once('config.php');

 // Verificar se a sessão está definida para 'matricula'
if (!isset($_SESSION['matricula'])) {
    header('Location: home.php');
    exit;
}

$matricula = $_SESSION['matricula'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    $sql = "UPDATE alunos SET nome = ?, email = ?, telefone = ? WHERE matricula = ?";
    if ($stmt = $conexao->prepare($sql)) {
        $stmt->bind_param('ssss', $nome, $email, $telefone, $matricula);
        $stmt->execute();
        $stmt->close();
        $message = "Dados atualizados com sucesso!";
    } else {
        $message = "Erro na atualização: " . $conexao->error;
    }
}

$sql = "SELECT nome, email, telefone FROM alunos WHERE matricula = ?";
if ($stmt = $conexao->prepare($sql)) {
    $stmt->bind_param('s', $matricula);
    $stmt->execute();
    $stmt->bind_result($nome, $email, $telefone);
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
    <title>Kaiman System | Alterar Dados</title>
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

        .form-container {
            background: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            padding: 20px;
            margin: 20px;
            max-width: 600px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        }

        .form-container h2 {
            color: #829d5e;
            font-family: 'Bebas Neue', cursive;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            margin-bottom: 20px;
            font-size: 36px;
        }

        .form-container label {
            text-align: left;
            display: block;
            margin: 10px 0 5px;
        }

        .form-container input {
            margin-bottom: 10px;
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

    <div class="form-container">
        <h2>Alterar Dados</h2>
        <?php if (isset($message)) { echo "<p>$message</p>"; } ?>
        <form action="" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($nome); ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>

            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="telefone" value="<?php echo htmlspecialchars($telefone); ?>" required>

            <button type="submit" class="btn btn-success">Salvar Alterações</button>
        </form>
    </div>

</body>
</html>
