<?php
// Conectar ao banco de dados
require './server/db/db.php'; // Altere para o seu arquivo de conexão

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Gera um nome de usuário único para o guest
    $username = 'Guest_' . uniqid();

    // Define o papel como 'Guest'
    $role = 'Guest';

    // Preparar e executar a inserção
    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, role) VALUES (:username, :role)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':role', $role);
        $stmt->execute();

        // Obtém o ID do usuário cadastrado
        $userId = $pdo->lastInsertId();

        // Retorna uma resposta ao frontend
        echo json_encode(['success' => true, 'userId' => $userId, 'username' => $username]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}
?>
