<?php
session_start();
require_once '../includes/db.php';

if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
    exit;
}

if (!isset($_GET['id'])) {
    header('Location: imoveis.php');
    exit;
}

$id = $_GET['id'];

// Buscar os dados do imóvel
$stmt = $pdo->prepare("SELECT * FROM imoveis WHERE id = ?");
$stmt->execute([$id]);
$imovel = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$imovel) {
    echo "Imóvel não encontrado.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $tipo = $_POST['tipo'];
    $endereco = $_POST['endereco'];
    $preco = $_POST['preco'];
    $categoria = $_POST['categoria'];
    $imagem = $_POST['imagem'];
    $destaque = isset($_POST['destaque']) ? 1 : 0;

    $stmt = $pdo->prepare("UPDATE imoveis SET titulo = ?, descricao = ?, tipo = ?, endereco = ?, preco = ?, categoria = ?, imagem = ?, destaque = ? WHERE id = ?");
    $stmt->execute([$titulo, $descricao, $tipo, $endereco, $preco, $categoria, $imagem, $destaque, $id]);

    header('Location: imoveis.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Imóvel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Editar Imóvel</h2>
    <form method="post">
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="<?= htmlspecialchars($imovel['titulo']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao" rows="3" required><?= htmlspecialchars($imovel['descricao']) ?></textarea>
        </div>
        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <select class="form-select" id="tipo" name="tipo" required>
                <option value="">Selecione...</option>
                <option value="casa" <?= $imovel['tipo'] == 'casa' ? 'selected' : '' ?>>Casa</option>
                <option value="apartamento" <?= $imovel['tipo'] == 'apartamento' ? 'selected' : '' ?>>Apartamento</option>
                <option value="terreno" <?= $imovel['tipo'] == 'terreno' ? 'selected' : '' ?>>Terreno</option>
                <option value="comercial" <?= $imovel['tipo'] == 'comercial' ? 'selected' : '' ?>>Comercial</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="endereco" class="form-label">Endereço</label>
            <input type="text" class="form-control" id="endereco" name="endereco" value="<?= htmlspecialchars($imovel['endereco']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="preco" class="form-label">Preço</label>
            <input type="number" step="0.01" class="form-control" id="preco" name="preco" value="<?= htmlspecialchars($imovel['preco']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="categoria" class="form-label">Categoria</label>
            <select class="form-select" id="categoria" name="categoria" required>
                <option value="">Selecione...</option>
                <option value="venda" <?= $imovel['categoria'] == 'venda' ? 'selected' : '' ?>>Venda</option>
                <option value="aluguel" <?= $imovel['categoria'] == 'aluguel' ? 'selected' : '' ?>>Aluguel</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="imagem" class="form-label">Imagem</label>
            <input type="text" class="form-control" id="imagem" name="imagem" value="<?= htmlspecialchars($imovel['imagem']) ?>">
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="destaque" name="destaque" value="1" <?= $imovel['destaque'] ? 'checked' : '' ?>>
            <label class="form-check-label" for="destaque">Destaque</label>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="imoveis.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
