<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autenticação</title>
    <link rel="stylesheet" href="./css/login/style.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <h4>Bem vindo de volta!</h4>
        
        <form action="./autenticar.php" method="POST">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha" required>
            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>