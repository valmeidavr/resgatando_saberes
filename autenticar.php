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

            // Redirecionar para a página de sucesso ou painel
            header("Location: painel.php"); // Substitua pela página de destino após login
            exit;
        } else {
            // Caso as credenciais sejam inválidas
            header("Location: login.php?erro=credenciais");
            exit;
        }
    } catch (PDOException $e) {
        // Se ocorrer erro na conexão, redireciona para o login com um erro
        header("Location: login.php?erro=conexao");
        exit;
    }
}
?>
