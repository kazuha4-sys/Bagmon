<!--// no inicio eu tava usando para fazer uma gambiarra para ter ususarios no banco de dados\\ -->
<?php
// Inclua o arquivo de configuração do banco de dados
require 'server/db/db.php';

// Lógica para criar um usuário Guest
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_guest'])) {
    try {
        $stmt = $pdo->query("SELECT COUNT(*) AS count FROM users");
        $row = $stmt->fetch();
        $userCount = $row['count'] + 1;
        $username = "Guest$userCount";

        $stmt = $pdo->prepare("INSERT INTO users (username) VALUES (:username)");
        $stmt->execute(['username' => $username]);
        $userId = $pdo->lastInsertId();

        echo "<script>var userId = $userId;</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Erro ao criar usuário: " . $e->getMessage() . "');</script>";
    }
}

// Lógica para selecionar o personagem
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['character_name']) && isset($_POST['character_skin']) && isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];
    $characterName = $_POST['character_name'];
    $characterSkin = $_POST['character_skin'];

    try {
        $stmt = $pdo->prepare("UPDATE users SET character_choice = :character_skin, character_name = :character_name WHERE id = :id");
        $stmt->execute([
            'character_skin' => $characterSkin,
            'character_name' => $characterName,
            'id' => $userId
        ]);

        echo "<script>alert('Personagem selecionado com sucesso!');</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Erro ao selecionar personagem: " . $e->getMessage() . "');</script>";
    }
}