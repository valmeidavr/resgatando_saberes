<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autenticação</title>
    <link rel="stylesheet" href="./css/login/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <div class="container">
        <!--  <img class="logotipo" src="./img/logotipo.png"/> -->
        <h1>Login</h1>
        <h4>Bem vindo de volta! 🚀</h4>

        <form action="./autenticar.php" method="POST">
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
                <button type="submit">Entrar</button>
                <a href="./cadastro.php">Não tem uma conta? Cadastre-se</a>
            </div>
           
        </form>

    </div>
</body>

</html>