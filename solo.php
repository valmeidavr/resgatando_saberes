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
            <h4>Solo e Drenagem</h4>
            <!-- Botão para o controle de áudio e alternância de play/stop -->
            <div class="audio-control">
                <audio id="audio">
                    <source src="path_to_your_audio.mp3" type="audio/mp3"> <!-- MP3 -->
                    <source src="path_to_your_audio.ogg" type="audio/ogg"> <!-- OGG -->
                    <source src="path_to_your_audio.wav" type="audio/wav"> <!-- WAV -->
                    Seu navegador não suporta o elemento de áudio.
                </audio>
                <i class="fas fa-play" id="play-icon"></i> <!-- Ícone de Play -->
            </div>
        </div>
        <p class="paragrafo-container">&nbsp; O solo é vital para o crescimento das
            plantas e o armazenamento de nutrientes. A drenagem adequada evita o encharcamento, melhora a produtividade agrícola e previne erosões.
            Então utilize um solo de boa qualidade e bem drenado. Adicione materiais como perlita ou vermículita para melhorar a drenagem e aeração.</p>

        <img src="./img/solo.png" alt="Solo" class="img-container">



        <!-- Botão para voltar ao Dashboard -->
        <div class="form-group" style="margin-top: 20px">
            <a href="dashboard.php">Voltar para o dashboard</a>
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