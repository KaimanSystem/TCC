<?php
session_start();
require('config.php'); // Inclua o arquivo de conexão

// Função para remover um usuário
if (isset($_POST['remove_user'])) {
    $id = $_POST['user_id'];
    $table = $_POST['table'];

    $stmt = $conexao->prepare("DELETE FROM $table WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $message = "Usuário removido com sucesso!";
    } else {
        $message = "Erro ao remover usuário!";
    }

    $stmt->close();
}

// Pesquisa de usuário
$users = [];
if (isset($_POST['search_user'])) {
    $searchTerm = $_POST['search_term'];
    $searchBy = $_POST['search_by'];

    if ($searchBy === 'matricula') {
        $stmt = $conexao->prepare("SELECT * FROM alunos WHERE matricula = ?");
        $table = 'alunos';
    } elseif ($searchBy === 'cpf') {
        $stmt = $conexao->prepare("SELECT * FROM comunidade WHERE cpf = ?");
        $table = 'comunidade';
    }

    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
    $users = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remover Usuário | Kaiman System</title>
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
            max-width: 800px;
            margin: 0 auto; /* Center horizontally */
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
        <h1>Remover Usuário</h1>
        <form method="POST" action="">
            <input type="text" name="search_term" placeholder="Digite matrícula ou CPF" required>
            <select name="search_by" required>
                <option value="matricula">Matrícula</option>
                <option value="cpf">CPF</option>
            </select>
            <button type="submit" name="search_user" class="button">Buscar</button>
        </form>

        <?php if (isset($message)) : ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>

        <?php if (!empty($users)) : ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Matrícula</th>
                        <th>CPF</th>
                        <th>Remover</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo $user['nome']; ?></td>
                            <td><?php echo isset($user['matricula']) ? $user['matricula'] : ''; ?></td>
                            <td><?php echo isset($user['cpf']) ? $user['cpf'] : ''; ?></td>
                            <td>
                                <form method="POST" action="">
                                    <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                    <input type="hidden" name="table" value="<?php echo $table; ?>">
                                    <button type="submit" name="remove_user" class="button">Remover</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
