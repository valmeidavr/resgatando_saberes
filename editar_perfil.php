<?php
// Iniciar a sessão
session_start();

// Verificar se o usuário está autenticado
if (!isset($_SESSION['user_id'])) {
    // Caso não esteja autenticado, redirecionar para a página de login
    header("Location: login.php");
    exit;
}

// Conectar ao banco de dados
include('conf/config.php');

// Obter o ID do usuário logado
$user_id = $_SESSION['user_id'];

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Receber os dados do formulário
    $novo_nome = $_POST['nome'];
    $novo_email = $_POST['email'];

    // Validar os dados (como exemplo, podemos verificar se o email é válido)
    if (!filter_var($novo_email, FILTER_VALIDATE_EMAIL)) {
        $erro = "O email fornecido não é válido.";
    } else {
        // Verificar se o email já está em uso por outro usuário
        $sql = "SELECT id FROM usuarios WHERE email = :email AND id != :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $novo_email);
        $stmt->bindParam(':id', $user_id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Se o email já estiver em uso
            $erro = "Este email já está em uso por outro usuário. Por favor, escolha outro.";
        } else {
            // Atualizar os dados do usuário no banco de dados
            $sql = "UPDATE usuarios SET nome = :nome, email = :email WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nome', $novo_nome);
            $stmt->bindParam(':email', $novo_email);
            $stmt->bindParam(':id', $user_id);

            // Verificar se a atualização foi bem-sucedida
            if ($stmt->execute()) {
                // Atualizar as variáveis de sessão com os novos dados
                $_SESSION['user_nome'] = $novo_nome;
                $_SESSION['user_email'] = $novo_email;

                // Mensagem de sucesso
                $sucesso = "Perfil atualizado com sucesso!";
            } else {
                $erro = "Erro ao atualizar perfil. Tente novamente.";
            }
        }
    }
}

// Obter as informações atuais do usuário
$sql = "SELECT * FROM usuarios WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $user_id);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

// Definir as variáveis com os dados atuais
$nome_usuario = $usuario['nome'];
$email_usuario = $usuario['email'];
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="./css/login/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* Estilo para alertas de erro */
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            background-color: #f8d7da;
            /* Cor de fundo para erro */
            color: #721c24;
            /* Cor do texto */
            border: 1px solid #f5c6cb;
            /* Cor da borda */
            border-radius: 5px;
            /* Bordas arredondadas */
            font-size: 14px;
            font-weight: bold;
            text-align: center;
        }

        /* Estilo específico para mensagens de erro */
        .alert.error {
            background-color: #f8d7da;
            /* Cor de fundo para erro */
            border-color: #f5c6cb;
            /* Cor da borda */
            color: #721c24;
            /* Cor do texto */
        }

        .alert.success {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Editar Perfil</h1>
        <h4>Atualize suas informações! 🚀</h4>

        <!-- Exibir erro amigável -->
        <?php if (isset($erro)): ?>
            <div class="alert error"><?php echo $erro; ?></div>
        <?php endif; ?>

        <!-- Exibir mensagem de sucesso -->
        <?php if (isset($sucesso)): ?>
            <div class="alert success"><?php echo $sucesso; ?></div>
        <?php endif; ?>

        <!-- Formulário de edição -->
        <form action="editar_perfil.php" method="POST">
            <div class="form-group">
                <label for="nome">Nome</label>
                <div class="input-container">
                    <i class="fas fa-user"></i>
                    <input type="text" name="nome" id="nome" value="<?php echo $nome_usuario; ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <div class="input-container">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" id="email" value="<?php echo $email_usuario; ?>" required>
                </div>
            </div>

            <div class="form-group">
                <button type="submit">Salvar Alterações</button>
                <a href="dashboard.php">Voltar para o dashboard</a>
            </div>
        </form>
    </div>
</body>

</html>
