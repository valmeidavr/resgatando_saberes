<?php
// Conectar ao banco de dados
include('conf/config.php');

// Iniciar uma variável de erro
$erro = '';

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Receber os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirmar_senha = $_POST['confirmar_senha'];

    // Verificar se as senhas coincidem
    if ($senha !== $confirmar_senha) {
        $erro = "As senhas não coincidem. Por favor, tente novamente.";
    } else {
        // Criptografar a senha
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        // Preparar o SQL para inserir os dados na tabela
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";

        // Preparar a consulta
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha_hash);

        // Executar a consulta e verificar se o cadastro foi bem-sucedido
        if ($stmt->execute()) {
            // Iniciar a sessão e autenticar o usuário
            session_start();
            $_SESSION['user_id'] = $pdo->lastInsertId();
            $_SESSION['user_nome'] = $nome;
            $_SESSION['user_email'] = $email;

            // Redirecionar para o dashboard
            header("Location: dashboard.php");
            exit;
        } else {
            $erro = "Houve um erro ao realizar o cadastro. Por favor, tente novamente mais tarde.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
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

        .alert.warning {
            background-color: #fff3cd;
            color: #856404;
            border-color: #ffeeba;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Crie sua Conta</h1>
        <h4>Cadastre-se e comece agora! 🚀</h4>

        <!-- Exibir erro amigável -->
        <?php if ($erro): ?>
            <div class="alert error"><?php echo $erro; ?></div>
        <?php endif; ?>

        <form action="cadastro.php" method="POST">
            <div class="form-group">
                <label for="nome">Nome</label>
                <div class="input-container">
                    <i class="fas fa-user"></i>
                    <input type="text" name="nome" id="nome" placeholder="Digite seu nome" required>
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <div class="input-container">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" id="email" placeholder="Digite seu email" required>
                </div>
            </div>

            <div class="form-group">
                <label for="senha">Senha</label>
                <div class="input-container">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="senha" id="senha" placeholder="Digite sua senha" required>
                </div>
            </div>

            <div class="form-group">
                <label for="confirmar_senha">Confirmar Senha</label>
                <div class="input-container">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="confirmar_senha" id="confirmar_senha" placeholder="Confirme sua senha" required>
                </div>
            </div>

            <div class="form-group">
                <button type="submit">Cadastrar</button>
                <a href="login.php">Voltar para o login</a>
            </div>
        </form>
    </div>
</body>

</html>