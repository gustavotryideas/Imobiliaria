<?php
session_start();
require_once 'includes/db.php';
include 'includes/header.php';

// Buscar imóveis em destaque
$stmt = $pdo->prepare("SELECT * FROM imoveis WHERE destaque = 1 ORDER BY created_at DESC LIMIT 12");
$stmt->execute();
$imoveis = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Carousel de banners -->
 <!-- tamanho ideal de banner: 4318 x 2000 PX -->
<div id="carouselExampleIndicators" class="carousel slide">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="assets/img/53021065_9321188.jpg" class="d-block w-100" alt="Banner 1">
    </div>
    <div class="carousel-item">
      <img src="assets/img/20126169_6229666.jpg" class="d-block w-100" alt="Banner 2">
    </div>
    <div class="carousel-item">
      <img src="assets/img/800px.jpg" class="d-block w-100" alt="Banner 3">
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

<!-- Imóveis em destaque -->
<div class="container mt-5">
  <h2 class="text-center mb-4">Imóveis em Destaque</h2>
  <div class="row">
    <?php foreach ($imoveis as $imovel): ?>
      <div class="col-6 col-md-3 mb-4">
        <div class="card h-100">
          <?php if (!empty($imovel['imagem'])): ?>
            <img src="assets/img/<?= htmlspecialchars($imovel['imagem']) ?>" class="card-img-top" alt="<?= htmlspecialchars($imovel['titulo']) ?>">
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

<?php include 'includes/footer.php'; ?>
