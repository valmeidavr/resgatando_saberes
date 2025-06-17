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
            <h4>Agricultura</h4>
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
        <p class="paragrafo-container">Descubra neste aplicativo tudo sobre
            agricultura e cultivo! Encontre várias
            informações essenciais sobre recipientes adequados, cultivo suspenso, solo e drenagem, irrigação e muito mais.</p>

        <!-- Botões de navegação -->
        <a href="./recipientes.php">
            <button>Recipientes Adequados</button>
        </a>
        <a href="./cultivo.php">
            <button>Cultivo Suspenso</button>
        </a>
        <a href="./solo.php">
            <button>Solo e Drenagem</button>
        </a>
        <a href="./irrigacao.php">
            <button>Irrigação e exposição</button>
        </a>

        <!-- Botão para voltar ao Dashboard -->
        <div class="form-group" style="margin-top: 20px">
            <a href="dashboard.php">Voltar para o dashboard</a>
        </div>
    </div>

    <div class="footer">
        <p>&copy; <?php echo date("Y"); ?> Resgatando Saberes. Todos os direitos reservados.</p>
    </div>

    <?php
    include('vlibras.php');
    ?>
</body>

</html>