<?php
include 'includes/header.php';
include 'includes/db.php';

$stmt = $pdo->query("SELECT * FROM imoveis ORDER BY created_at DESC");
$imoveis = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-5">
    <h1>Todos os Imóveis</h1>
    <div class="row">
        <?php foreach ($imoveis as $imovel): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <?php if ($imovel['imagem']): ?>
                        <img src="assets/img/imoveis/<?= htmlspecialchars($imovel['imagem']) ?>" class="card-img-top" alt="<?= htmlspecialchars($imovel['titulo']) ?>">
                    <?php else: ?>
                        <img src="https://via.placeholder.com/350x250?text=Sem+Imagem" class="card-img-top" alt="Sem Imagem">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($imovel['titulo']) ?></h5>
                        <p class="card-text"><?= substr(htmlspecialchars($imovel['descricao']), 0, 100) ?>...</p>
                        <p class="card-text"><small class="text-muted">Tipo: <?= ucfirst($imovel['tipo']) ?></small></p>
                        <p class="card-text"><strong>R$ <?= number_format($imovel['preco'], 2, ',', '.') ?></strong></p>
                        <p class="card-text"><small class="text-muted">Categoria: <?= ucfirst($imovel['categoria']) ?></small></p>
                        <a href="detalhes.php?id=<?= $imovel['id'] ?>" class="btn btn-primary">Ver Detalhes</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
