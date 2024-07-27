<?php 
session_start();
include('db.php');
if(isset($_SESSION['Guest'])) {
    $stmt = $pdo->prpepare("DELETE FROM users");
    $stmt-execute([$_SESSION['user']]);
    session_destroy();
}
header("Location: index.php");
exit();

?>