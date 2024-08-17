<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Bem-sucedido</title>
    <style>
        body {
            font-family: 'Bebas Neue', sans-serif;
            background-color: #dfe2e6;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            overflow: hidden;
        }
        .popup {
            background-color: rgba(0, 0, 0, 0.7);
            color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        .popup img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
        }
    </style>
    <script>
         // Função para redirecionar após 2 segundos
        function redirectAfterDelay() {
            setTimeout(function() {
                window.location.href = 'login_aluno.php';
            }, 2000); // 2000 milissegundos = 2 segundos
        }
        
        // Chama a função quando a página é carregada
        window.onload = redirectAfterDelay;
    </script>
</head>
<body>
    <div class="popup">
        <img src="IMG/sucesso2.jpeg" alt="Cadastro Sucesso">
        <p>Cadastro realizado com sucesso!</p>
    </div>
</body>
</html>
