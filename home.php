<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME | Kaiman System</title>
    <link href="https://fonts.cdnfonts.com/css/bebas-neue" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        @import url('https://fonts.cdnfonts.com/css/bebas-neue');

        body {
            font-family: 'Bebas Neue', sans-serif;
            background-image: linear-gradient(to top, #dfe2e6, #829d5e);
            text-align: center;
            color: #ffffff;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;  /* Centraliza verticalmente */
            position: relative;
        }
        .box {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 80%;
            max-width: 500px;
        }
        .box a {
            text-decoration: none;
            color: white;
            border: 3px solid #568915;
            border-radius: 15px;
            padding: 10px;
            margin: 0 10px;
            display: block;
            margin-bottom: 10px;
            opacity: 0.8;
            transition: opacity 0.3s ease-in-out;
        }
        .box a:hover {
            opacity: 1;
            background-color: #568915;
        }
        .top-right-container {
            position: absolute;
            top: 10px;
            right: 10px;
        }
        .top-right-image {
            width: 100px;
            height: auto;
            border: none; /* Remove border */
        }
        .social-links {
            position: absolute;
            bottom: 10px;
            left: 10px;
        }
        .social-links a {
            display: inline-block;
            margin: 10px;
            padding: 10px;
            border-radius: 50%;
            font-size: 20px;
            color: white;
            border: 3px solid #568915; /* Keep border */
            transition: none; /* Remove hover effect */
        }
        .social-links a:hover {
            background-color: transparent; /* Keep transparent background on hover */
        }
        .date-time {
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 24px;
            color: white;
        }
        .author-info {
            position: absolute;
            bottom: 10px;
            right: 10px;
            color: rgba(255, 255, 255, 0.7);
            font-size: 14px;
        }
        .verified-icon {
            color: #568915;
            margin-left: 5px;
        }
    </style>
</head>
<body>
    <div class="top-right-container">
        <a href="sobre_KS.php">
            <img src="IMG/jacare_logo.png" alt="Logo" class="top-right-image">
        </a>
    </div>
    <div class="box">
        <h1 id="welcome-message">Seja Bem Vindo(a)!!</h1>
        <h3>Escolha o Tipo de Login ou faça o cadastro</h3>
        <br>
        <a href="login_aluno.php">Alunos</a>
        <a href="login_servidores.php">Servidores</a>
        <a href="login_comunidade.php">Comunidade</a>
        <br>
        <a href="escolha_cadastro.php">Cadastre-se</a>
    </div>
    <div class="social-links">
        <a href="https://github.com/LuizzGustavoo/Site_De_Registro" target="_blank"><i class="fab fa-github"></i></a>
    </div>
    <div class="date-time" id="date-time"></div>
    <div class="author-info">
        <i class="fas fa-check-circle verified-icon"></i>
    </div>

    <script>
        // Alternating welcome messages
        const messages = [
            "Seja Bem Vindo(a)!!",
            "Bem-vindo ao Kaiman System!",
            "Estamos felizes em vê-lo(a)!"
        ];
        let messageIndex = 0;
        const welcomeMessageElement = document.getElementById('welcome-message');

        setInterval(() => {
            messageIndex = (messageIndex + 1) % messages.length;
            welcomeMessageElement.textContent = messages[messageIndex];
        }, 3000);

        // Display current date and time
        function updateDateTime() {
            const now = new Date();
            const formattedDate = now.toLocaleDateString('pt-BR', { 
                day: '2-digit', month: 'long', year: 'numeric' 
            });
            const formattedTime = now.toLocaleTimeString('pt-BR');
            document.getElementById('date-time').textContent = `Hoje é ${formattedDate}, ${formattedTime}`;
        }

        setInterval(updateDateTime, 1000);

        // Alert after inactivity
        let inactivityTime = function () {
            let time;
            window.onload = resetTimer;
            document.onmousemove = resetTimer;
            document.onkeypress = resetTimer;

            function alertUser() {
                alert("Você está inativo há algum tempo. Precisa de ajuda?");
            }

            function resetTimer() {
                clearTimeout(time);
                time = setTimeout(alertUser, 60000);  // 1 minute of inactivity
            }
        };

        inactivityTime();
    </script>
</body>
</html>
