<?php
session_start();
require('config.php');

// Função para adicionar um admin
if (isset($_POST['add_admin'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $is_admin = 1; // Define como admin

    $stmt = $conexao->prepare("INSERT INTO servidores (nome, email, senha, is_admin) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $nome, $email, $senha, $is_admin);

    if ($stmt->execute()) {
        $message = "Admin adicionado com sucesso!";
    } else {
        $message = "Erro ao adicionar admin!";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Admin | Kaiman System</title>
    <!-- Inserir o mesmo estilo do arquivo anterior -->
</head>
<body>
    <div class="box">
        <h1>Adicionar Admin</h1>

        <form method="POST" action="">
            <input type="text" name="nome" placeholder="Nome" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="senha" placeholder="Senha" required><br>
            <button type="submit" name="add_admin" class="button">Adicionar Admin</button>
        </form>

        <?php if (isset($message)) : ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
