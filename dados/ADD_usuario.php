<?php
session_start();
require('config.php');

// Função para adicionar um usuário
if (isset($_POST['add_user'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $table = $_POST['table'];

    if ($table === 'alunos') {
        $matricula = $_POST['matricula'];
        $stmt = $conexao->prepare("INSERT INTO alunos (nome, email, senha, matricula) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $nome, $email, $senha, $matricula);
    } elseif ($table === 'comunidade') {
        $cpf = $_POST['cpf'];
        $stmt = $conexao->prepare("INSERT INTO comunidade (nome, email, senha, cpf) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nome, $email, $senha, $cpf);
    }

    if ($stmt->execute()) {
        $message = "Usuário adicionado com sucesso!";
    } else {
        $message = "Erro ao adicionar usuário!";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Usuário | Kaiman System</title>
    
</head>
<body>
    <div class="box">
        <h1>Adicionar Usuário</h1>

        <form method="POST" action="">
            <input type="text" name="nome" placeholder="Nome" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="senha" placeholder="Senha" required><br>

            <select name="table" required>
                <option value="alunos">Aluno</option>
                <option value="comunidade">Comunidade</option>
            </select><br>

            <input type="text" name="matricula" placeholder="Matrícula" id="matriculaField"><br>
            <input type="text" name="cpf" placeholder="CPF" id="cpfField"><br>

            <button type="submit" name="add_user" class="button">Adicionar Usuário</button>
        </form>

        <?php if (isset($message)) : ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
    </div>

    <script>
        const tableSelect = document.querySelector('select[name="table"]');
        const matriculaField = document.getElementById('matriculaField');
        const cpfField = document.getElementById('cpfField');

        tableSelect.addEventListener('change', function() {
            if (this.value === 'alunos') {
                matriculaField.style.display = 'block';
                cpfField.style.display = 'none';
            } else {
                matriculaField.style.display = 'none';
                cpfField.style.display = 'block';
            }
        });

        tableSelect.dispatchEvent(new Event('change'));
    </script>
</body>
</html>
