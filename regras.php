<?php
session_start();
include_once('config.php');

// Verificar se a sessão está definida para 'matricula'
if (!isset($_SESSION['matricula'])) {
    header('Location: home.php');
    exit;
}
 
// Exibir o tempo de login do usuário
$matricula = $_SESSION['matricula'];
$sql = "SELECT tempo_login FROM alunos WHERE matricula = ?";
if ($stmt = $conexao->prepare($sql)) {
    $stmt->bind_param('s', $matricula);
    $stmt->execute();
    $stmt->bind_result($tempo_login);
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
    <title>Kaiman System | Regras Alunos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
            display: flex;
            align-items: center;
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

        .rules {
            background: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            padding: 20px;
            margin: 20px;
            max-width: 600px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
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
            color: white;
            opacity: 0; /* Inicia oculto */
            transform: translateY(20px); /* Inicia deslocado para baixo */
        }

        #cronometro {
            font-size: 24px;
            margin-top: 20px;
            transition: color 0.5s;
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
            <a href="sair.php" class="btn btn-danger me-3" onclick="registrarLogout(event)">Sair</a>
        </div>
    </nav>
    <div class="rules">
        <h2>Regras da Biblioteca</h2>
        <ul id="rules-list">
            <li>Mantenha o silêncio para não atrapalhar os demais usuários.</li>
            <li>Não utilizar os computadores para jogar.</li>
            <li>Cuide dos livros e do espaço, mantenha tudo organizado.</li>
            <li>Respeite os prazos de devolução dos livros.</li>
            <li>Não coma ou beba dentro da biblioteca.</li>
            <li>Utilize os computadores apenas para atividades acadêmicas.</li>
        </ul>
        <div id="cronometro">Tempo online: 00:00:00</div>
    </div>

    <script>
        // Mostrar regras com animação
        const rulesList = document.querySelectorAll('#rules-list li');
        rulesList.forEach((rule, index) => {
            setTimeout(() => {
                rule.style.opacity = '1';
                rule.style.transform = 'translateY(0)';
            }, index * 500);
        });

        // Cronômetro com mudança de cor
        let startTime = new Date("<?php echo $tempo_login; ?>").getTime();
        let interval = setInterval(function () {
            let now = new Date().getTime();
            let elapsedTime = now - startTime;

            let hours = Math.floor((elapsedTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            let minutes = Math.floor((elapsedTime % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((elapsedTime % (1000 * 60)) / 1000);

            hours = hours < 10 ? "0" + hours : hours;
            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            const cronometro = document.getElementById("cronometro");
            cronometro.innerHTML = "Tempo online: " + hours + ":" + minutes + ":" + seconds;

            // Muda a cor do cronômetro depois de 30 minutos
            if (hours > 0 || minutes >= 30) {
                cronometro.style.color = 'red';
            } else if (minutes >= 15) {
                cronometro.style.color = 'orange';
            }
        }, 1000);

        // Confirmação de logout com feedback visual
        function registrarLogout(event) {
            event.preventDefault();
            if (confirm("Você realmente deseja sair?")) {
                const logoutButton = event.target;
                logoutButton.textContent = 'Saindo...';
                logoutButton.classList.add('disabled');
                
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "aluno_registrar_logout.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.send("matricula=<?php echo $matricula; ?>");
                
                setTimeout(() => {
                    window.location.href = "sair.php";
                }, 2000); // Simula um atraso para feedback visual
            }
        }
    </script>
</body>
</html>


