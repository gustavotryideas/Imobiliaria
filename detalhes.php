<?php
// Inicia sessão, caso precise usar mais tarde
session_start();

// Inclui conexão com banco
require_once 'includes/db.php';

// Verifica se o ID foi passado via GET e é um número válido
if (!isset($_GET['id']) || !filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    die('ID inválido.');
}

$id = (int) $_GET['id'];

// Busca imóvel no banco
$stmt = $pdo->prepare("SELECT * FROM imoveis WHERE id = :id LIMIT 1");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

$imovel = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$imovel) {
    die('Imóvel não encontrado.');
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= htmlspecialchars($imovel['titulo']) ?> - Detalhes do Imóvel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>

<nav class="navbar navbar-expand-lg bg-light">
  <div class="container">
    <a class="navbar-brand" href="home.php">Imobiliária</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="menuNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="imoveis.php">Todos os imóveis</a></li>
        <li class="nav-item"><a class="nav-link" href="venda.php">À venda</a></li>
        <li class="nav-item"><a class="nav-link" href="aluguel.php">Para alugar</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5">
    <h1><?= htmlspecialchars($imovel['titulo']) ?></h1>
    <div class="row">
        <div class="col-md-6">
            <?php if (!empty($imovel['imagem'])): ?>
                <img src="assets/img/imoveis/<?= htmlspecialchars($imovel['imagem']) ?>" alt="<?= htmlspecialchars($imovel['titulo']) ?>" class="img-fluid rounded">
            <?php else: ?>
                <img src="https://via.placeholder.com/600x400?text=Sem+Imagem" alt="Sem imagem" class="img-fluid rounded">
            <?php endif; ?>
        </div>
        <div class="col-md-6">
            <h4>Descrição</h4>
            <p><?= nl2br(htmlspecialchars($imovel['descricao'])) ?></p>

            <ul class="list-group mb-3">
                <li class="list-group-item"><strong>Tipo:</strong> <?= ucfirst(htmlspecialchars($imovel['tipo'])) ?></li>
                <li class="list-group-item"><strong>Categoria:</strong> <?= ucfirst(htmlspecialchars($imovel['categoria'])) ?></li>
                <li class="list-group-item"><strong>Endereço:</strong> <?= htmlspecialchars($imovel['endereco']) ?></li>
                <li class="list-group-item"><strong>Preço:</strong> R$ <?= number_format($imovel['preco'], 2, ',', '.') ?></li>
                <li class="list-group-item"><strong>Destaque:</strong> <?= $imovel['destaque'] ? 'Sim' : 'Não' ?></li>
                <li class="list-group-item"><strong>Criado em:</strong> <?= date('d/m/Y H:i', strtotime($imovel['created_at'])) ?></li>
            </ul>

            <a href="javascript:history.back()" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
