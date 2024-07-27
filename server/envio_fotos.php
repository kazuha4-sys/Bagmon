<?php
include 'db/db.php';
$target_dir = "usuarios_fotos/";  // Diretório onde as skins serão salvas
$target_file = $target_dir . basename($_FILES["skin"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Verifica se o arquivo é uma imagem
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["skin"]["tmp_name"]);
    if ($check !== false) {
        echo "O arquivo é uma imagem - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "O arquivo não é uma imagem.";
        $uploadOk = 0;
    }
}

// Verifica se o arquivo já existe
if (file_exists($target_file)) {
    echo "Desculpe, o arquivo já existe.";
    $uploadOk = 0;
}

// Verifica o tamanho do arquivo
if ($_FILES["skin"]["size"] > 500000) { // 500KB por exemplo
    echo "Desculpe, o arquivo é muito grande.";
    $uploadOk = 0;
}

// Permitir certos formatos de arquivo
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    echo "Desculpe, apenas arquivos JPG, JPEG, PNG & GIF são permitidos.";
    $uploadOk = 0;
}

// Verifica se o upload foi bem-sucedido
if ($uploadOk == 0) {
    echo "Desculpe, seu arquivo não foi enviado.";
} else {
    if (move_uploaded_file($_FILES["skin"]["tmp_name"], $target_file)) {
        echo "O arquivo ". htmlspecialchars(basename($_FILES["skin"]["name"])). " foi enviado.";
        // Aqui você pode salvar o caminho da skin no banco de dados
    } else {
        echo "Desculpe, ocorreu um erro ao enviar seu arquivo.";
    }
}
?>
