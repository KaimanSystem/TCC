<?php
session_start();
require('config.php'); // Inclua o arquivo de conexão

// Função para desconectar um usuário
if (isset($_POST['disconnect_user'])) {
    $id = $_POST['user_id'];
    $table = $_POST['table'];

    // Atualiza o tempo de logout para o usuário
    $stmt = $conexao->prepare("UPDATE $table SET tempo_logout = NOW() WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Remover a sessão do usuário
        unset($_SESSION['user_' . $id]);
        $message = "Usuário desconectado com sucesso!";
    } else {
        $message = "Erro ao desconectar usuário!";
    }

    $stmt->close();
}

// Pesquisa de usuários online
$usersOnline = [];
$tables = ['alunos', 'comunidade'];
foreach ($tables as $table) {
    $stmt = $conexao->prepare("SELECT * FROM $table WHERE tempo_logout IS NULL");
    $stmt->execute();
    $result = $stmt->get_result();
    $usersOnline[$table] = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Usuários Online | Kaiman System</title>
    <link href="https://fonts.cdnfonts.com/css/bebas-neue" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
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
            max-width: 800px;
            margin: 0 auto; 
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ffffff;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #568915;
            color: #ffffff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .button {
            background-color: #568915;
            color: #ffffff;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            cursor: pointer;
        }
        .button:hover {
            background-color: #4a7b0d;
        }
    </style>
</head>
<body>
    <div class="box">
        <h1>Gerenciar Usuários Online</h1>

        <?php if (isset($message)) : ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>

        <?php foreach ($usersOnline as $table => $users) : ?>
            <h2>Usuários Online - <?php echo ucfirst($table); ?></h2>
            <?php if (!empty($users)) : ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Matrícula/CPF</th>
                            <th>Desconectar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user) : ?>
                            <tr>
                                <td><?php echo $user['id']; ?></td>
                                <td><?php echo $user['nome']; ?></td>
                                <td><?php echo isset($user['matricula']) ? $user['matricula'] : $user['cpf']; ?></td>
                                <td>
                                    <form method="POST" action="">
                                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                        <input type="hidden" name="table" value="<?php echo $table; ?>">
                                        <button type="submit" name="disconnect_user" class="button">Desconectar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <p>Nenhum usuário online.</p>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</body>
</html>
