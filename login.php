<?php
// Conectar ao banco de dados
include('conf/config.php');

// Iniciar a sessão
session_start();

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Receber os dados do formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    try {
        // Preparar a consulta para verificar o usuário no banco
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Verificar se o usuário foi encontrado
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            // Se a senha for válida, criar uma sessão para o usuário
            $_SESSION['user_id'] = $usuario['id'];
            $_SESSION['user_nome'] = $usuario['nome'];
            $_SESSION['user_email'] = $usuario['email'];

            // Redirecionar para o dashboard
            header("Location: dashboard.php");
            exit;
        } else {
            // Se as credenciais estiverem erradas
            $erro = "Credenciais inválidas!";
        }
    } catch (PDOException $e) {
        // Caso haja erro de conexão com o banco de dados
        $erro = "Erro na conexão com o banco de dados!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autenticação</title>
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
    </style>
</head>

<body>
    <div class="container">
        <h1>Login</h1>
        <h4>Bem-vindo de volta! 🚀</h4>

        <!-- Exibir erro amigável -->
        <?php if (isset($erro)): ?>
            <div class="alert error">
                <?php echo $erro; ?>
            </div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Digite seu email" required>
            </div>

            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" name="senha" id="senha" placeholder="Digite sua senha" required>
            </div>

            <div class="form-group">
                <button type="submit">Entrar</button>
                <a href="cadastro.php">Não tem uma conta? Cadastre-se</a>
            </div>
        </form>
    </div>
</body>
 <?php 
      include('vlibras.php');
    ?>

</html>