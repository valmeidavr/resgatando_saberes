<?php
// Defina as variáveis da sua string de conexão
$host = 'ep-wild-voice-ac1mr0l1-pooler.sa-east-1.aws.neon.tech';  // Host fornecido pelo Neon
$user = 'neondb_owner';  // Usuário fornecido pelo Neon
$password = 'npg_CaMd8DZxilj5';  // Senha fornecido pelo Neon
$dbname = 'neondb';  // Nome do banco de dados fornecido pelo Neon
$endpoint_id = 'ep-wild-voice-ac1mr0l1-pooler'; // O ID do endpoint, geralmente a primeira parte do seu host


// Montando a string de conexão para o PDO com o parâmetro de SNI
$dsn = "pgsql:host=$host;dbname=$dbname;user=$user;password=$password;sslmode=require;options='endpoint=$endpoint_id'";


try {
    // Estabelecendo a conexão com PostgreSQL
    $pdo = new PDO($dsn);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // Para tratar erros
    // echo "Conectado ao PostgreSQL com sucesso!"; // Você pode remover esta linha após confirmar a conexão
} catch (PDOException $e) {
    // Em caso de erro na conexão, pare a execução e exiba uma mensagem de erro
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
?>
