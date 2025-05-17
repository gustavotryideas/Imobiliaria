<?php
// Inicia a sessão
session_start();

// Inclui o arquivo de conexão com o banco de dados
require_once 'includes/db.php';

// Consulta os imóveis marcados como "destaque"
$stmt = $pdo->prepare("SELECT * FROM imoveis WHERE destaque = 1 ORDER BY created_at DESC LIMIT 12");
$stmt->execute();
$imoveis = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Imobiliária</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/responsividade/responsividade.css" />
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
        <li class="nav-item"><a class="nav-link active" href="home.php">Home</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Imóveis</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="imoveis.php">Todos os imóveis</a></li>
            <li><hr class="dropdown-divider" /></li>
            <li><a class="dropdown-item" href="venda.php">À venda</a></li>
            <li><a class="dropdown-item" href="aluguel.php">Para alugar</a></li>
          </ul>
        </li>
        <li class="nav-item"><a class="nav-link" href="./sobre.php">Sobre</a></li>
        <li class="nav-item"><a class="nav-link" href="./servicos.php">Serviços</a></li>
        <li class="nav-item"><a class="nav-link" href="./contato.php">Contato</a></li>
      </ul>
    </div>
  </div>
</nav>

<div id="carouselExampleIndicators" class="carousel slide">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="assets/img/cana-de-acucar-800x400.jpg" class="d-block w-100" alt="Banner 1">
    </div>
    <div class="carousel-item">
      <img src="assets/img/passeio3-800x400.png" class="d-block w-100" alt="Banner 2">
    </div>
    <div class="carousel-item">
      <img src="assets/img/cana-de-acucar-800x400.jpg" class="d-block w-100" alt="Banner 3">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon bg-dark rounded-circle p-3"></span>
    <span class="visually-hidden">Anterior</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon bg-dark rounded-circle p-3"></span>
    <span class="visually-hidden">Próximo</span>
  </button>
</div>

<div class="container mt-5">
  <h2 class="text-center mb-4">Imóveis em Destaque</h2>
  <div class="row">
    <?php foreach ($imoveis as $imovel): ?>
      <div class="col-6 col-md-3 mb-4">
        <div class="card h-100">
          <?php if (!empty($imovel['imagem'])): ?>
            <img src="assets/img/imoveis/<?= htmlspecialchars($imovel['imagem']) ?>" class="card-img-top" alt="<?= htmlspecialchars($imovel['titulo']) ?>">
          <?php else: ?>
            <img src="https://via.placeholder.com/350x250?text=Sem+Imagem" class="card-img-top" alt="Sem imagem">
          <?php endif; ?>
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($imovel['titulo']) ?></h5>
            <p class="card-text">
              <strong>R$ <?= number_format($imovel['preco'], 2, ',', '.') ?></strong>
              (<?= ucfirst($imovel['categoria']) ?>)
            </p>
            <p class="card-text">
              <?= ucfirst(htmlspecialchars($imovel['tipo'])) ?>
            </p>
            <a href="detalhes.php?id=<?= $imovel['id'] ?>" class="btn btn-outline-primary w-100">Ver detalhes</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<footer class="bg-light text-center py-3 mt-5">
  <p class="mb-0">&copy; 2025 Imobiliária. Todos os direitos reservados.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
