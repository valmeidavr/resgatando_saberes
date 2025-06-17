<?php
// Iniciar a sessão
session_start();

// Verificar se o usuário está autenticado
if (!isset($_SESSION['user_id'])) {
    // Caso não esteja autenticado, redirecionar para a página de login
    header("Location: login.php");
    exit;
}

// Obter o nome do usuário logado
$nome_usuario = $_SESSION['user_nome'];
$iniciais = strtoupper(substr($nome_usuario, 0, 1)); // Pega a inicial do nome
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./css/dashboard/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <div class="header">
        <h4>Bem-vindo, <?php echo $nome_usuario; ?>! </h4>

        <!-- Avatar e Menu Suspenso -->
        <div class="dropdown">
            <div class="avatar">
                <?php echo $iniciais; ?> <!-- Exibe a inicial do nome -->
            </div>
            <div class="dropdown-content">
                <a href="editar_perfil.php">Editar Perfil</a>
                <a href="logout.php">Sair</a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="titulo-container">
            <h4>Irrigação/Exposição</h4>
            <!-- Botão para o controle de áudio e alternância de play/stop -->
            <div class="audio-control">
                <audio id="audio">
                    <source src="./mp3/irrigacao.mp3" type="audio/mp3"> <!-- MP3 -->
                    Seu navegador não suporta o elemento de áudio.
                </audio>
                <i class="fas fa-play" id="play-icon"></i> <!-- Ícone de Play -->
            </div>
        </div>
        <p class="paragrafo-container">&nbsp; A rega regular é crucial, pois os recipientes suspensos podem secar mais rapidamente. Considere um sistema de irrigação por gotejamento ou verifique a umidade do solo diariamente. A exposição das plantas refere-se à quantidade de luz solar. A luz solar é fundamental para o desenvolvimento das plantas através da fotossíntese, a exposição necessária varia de planta para planta.</p>

        <img  style="border-radius: 30px;" src="./img/irrigacao.png" alt="Solo" class="img-container">



        <!-- Botão para voltar ao Dashboard -->
        <div class="form-group" style="margin-top: 20px">
           <a href="agricultura.php">Voltar menu anterior</a>
        </div>
    </div>

    <div class="footer"></div>

    <script>
        // Lógica para alternar play/stop
        const playIcon = document.getElementById('play-icon');
        const audio = document.getElementById('audio');

        playIcon.addEventListener('click', function() {
            if (audio.paused) {
                audio.play(); // Iniciar áudio
                playIcon.classList.remove('fa-play');
                playIcon.classList.add('fa-stop'); // Mudar ícone para "stop"
            } else {
                audio.currentTime = 0; // Reinicia o áudio
                audio.play(); // Recomeça o áudio
                playIcon.classList.remove('fa-play');
                playIcon.classList.add('fa-stop'); // Mudar ícone para "stop"
            }
        });
    </script>
</body>
 <?php 
      include('vlibras.php');
    ?>

</html>