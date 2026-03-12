<?php
// pages/ProductDetailsPage/productdetails.php

require_once __DIR__ . '/../ProductListPage/products-data.php';

$productId = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$selectedProduct = null;
foreach ($products as $product) {
    if ($product['id'] === $productId) {
        $selectedProduct = $product;
        break;
    }
}

if (!$selectedProduct) {
    header('Location: /Mindflayers/pages/ProductListPage/products.php');
    exit;
}

function html($text) {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

$iconMap = [
    'specs'    => 'bi-list-check',
    'reviews'  => 'bi-chat-square-text',
    'shipping' => 'bi-truck',
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= html($selectedProduct['name']) ?> · Mindflayer Coffee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"/>
    <style>
        body { background: #F9F7F3; font-family: 'DM Sans', sans-serif; }
        .card-hero { border: 1px solid rgba(0,0,0,.06); border-radius: 0.8rem; background: #fff; }
        .card-hero img { border-top-left-radius: 0.8rem; border-top-right-radius: 0.8rem; }
        .modal-header { border-bottom: 1px solid #e8e5e0; }
        .section-heading { font-weight: 600; margin-top: 1rem; margin-bottom: 0.8rem; }
        .section-heading i { margin-right: 0.45rem; color: #7f5a3f; }
        .spec-row { margin-bottom: 0.55rem; }
        .spec-label { color: #7b5b4a; font-weight: 500; }
        .ship-list li { margin-bottom: 0.45rem; }
        .product-banner { border-left: 4px solid #8C6647; padding-left: 0.85rem; margin-top: 1.2rem; }
        .tag-badge { font-size: 0.75rem; border-radius: 0.35rem; }
        .btn-brown { background: #8b5e3c; color: #fff; border-color: #8b5e3c; }
        .btn-brown:hover { background: #79523a; color: #fff; }
    </style>
</head>
<body>
<header class="py-3 bg-white border-bottom">
    <div class="container d-flex justify-content-between align-items-center">
        <a href="/Mindflayers/pages/ProductListPage/products.php" class="btn btn-link text-decoration-none">
            <i class="bi bi-chevron-left"></i> Back to Menu
        </a>
        <a href="/Mindflayers/pages/ProductListPage/products.php" class="btn btn-outline-dark btn-sm">Menu</a>
    </div>
</header>

<main class="container py-5">
    <div class="card card-hero overflow-hidden shadow-sm">
        <img src="<?= html($selectedProduct['image']) ?>" alt="<?= html($selectedProduct['name']) ?>" class="img-fluid" style="max-height: 420px; object-fit: cover; width: 100%;">
        <div class="card-body p-4">
            <h1 class="h2"><?= html($selectedProduct['name']) ?></h1>
            <p class="text-secondary mb-2"><?= html($selectedProduct['tagline']) ?></p>
            <div class="d-flex align-items-center flex-wrap gap-2 mb-3">
                <span class="badge bg-warning text-dark tag-badge"><?= html($selectedProduct['badge']) ?></span>
                <span class="badge bg-secondary text-white tag-badge"><?= html($selectedProduct['category']) ?></span>
                <span class="badge bg-light text-dark tag-badge"><?= html($selectedProduct['volume']) ?></span>
            </div>

            <div class="row gy-3">
                <div class="col-md-5">
                    <div class="p-3 rounded-3 h-100" style="background:#FBF7F2;">
                        <h5 class="section-heading"><i class="bi bi-bag-heart"></i> Quick Info</h5>
                        <p class="mb-2"><strong>Price:</strong> ₱<?= number_format($selectedProduct['price']) ?></p>
                        <p class="mb-2"><strong>Calories:</strong> <?= html($selectedProduct['calories']) ?></p>
                        <p class="mb-2"><strong>Rating:</strong> <?= number_format($selectedProduct['rating'], 1) ?> <i class="bi bi-star-fill text-warning"></i> (<?= html($selectedProduct['reviews']) ?> reviews)</p>
                        <a href="#productDetailModal" class="btn btn-sm btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#productDetailModal">
                            Open Full Product Modal
                        </a>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="p-3 rounded-3" style="background:#FFF8EF;">
                        <h5 class="section-heading"><i class="bi bi-lightbulb"></i> Why You’ll Love It</h5>
                        <p class="mb-0"><?= html($selectedProduct['desc']) ?></p>
                    </div>
                </div>
            </div>

            <div class="product-banner text-muted mt-4">
                <small><strong>Tip:</strong> Scroll inside the modal for segmented details: specs, reviews, shipping, and preparation callout. This is built for clarity and easy scanning.</small>
            </div>
        </div>
    </div>
</main>

<!-- Modal === -->
<div class="modal fade" id="productDetailModal" tabindex="-1" aria-labelledby="productDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title" id="productDetailModalLabel">
                        <?= html($selectedProduct['name']) ?> <small class="text-muted">· <?= html($selectedProduct['category']) ?></small>
                    </h5>
                    <p class="mb-0 text-secondary" style="font-size: 0.9rem;">"<?= html($selectedProduct['tagline']) ?>"</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row g-3 mb-4">
                    <div class="col-md-5">
                        <img src="<?= html($selectedProduct['image']) ?>" alt="<?= html($selectedProduct['name']) ?>" class="img-fluid rounded" style="height: 260px; object-fit: cover; width: 100%; border:1px solid #e5e0d9;" />
                    </div>
                    <div class="col-md-7">
                        <h4 class="mb-2"><?= html($selectedProduct['name']) ?></h4>
                        <p class="text-muted mb-3"><?= html($selectedProduct['tagline']) ?></p>
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <span class="badge bg-warning text-dark"><?= html($selectedProduct['badge']) ?></span>
                            <span class="badge bg-info text-white"><?= html($selectedProduct['category']) ?></span>
                            <span class="badge bg-light text-dark"><?= html($selectedProduct['volume']) ?></span>
                        </div>
                        <div class="row g-2 mb-3 text-smaller" style="font-size:0.93rem;">
                            <div class="col-6"><strong>Price:</strong> ₱<?= number_format($selectedProduct['price']) ?></div>
                            <div class="col-6"><strong>Calories:</strong> <?= html($selectedProduct['calories']) ?></div>
                            <div class="col-6"><strong>Rating:</strong> <?= number_format($selectedProduct['rating'],1) ?> ⭐</div>
                            <div class="col-6"><strong>Reviews:</strong> <?= html($selectedProduct['reviews']) ?></div>
                        </div>
                        <button class="btn btn-brown text-white" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>

                <section class="mb-4">
                    <h6 class="section-heading"><i class="bi bi-info-circle"></i> About this drink</h6>
                    <p><?= html($selectedProduct['desc']) ?></p>
                </section>

                <section class="mb-4">
                    <h6 class="section-heading"><i class="bi bi-list-check"></i> Key Specifications</h6>
                    <div class="row g-2">
                        <?php foreach ($selectedProduct['specs'] as $spec): ?>
                        <div class="col-12 col-sm-6">
                            <div class="p-2 border rounded bg-white">
                                <strong><?= html($spec['label']) ?>:</strong> <?= html($spec['value']) ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </section>

                <section class="mb-4">
                    <h6 class="section-heading"><i class="bi bi-chat-square-text"></i> Customer Feedback</h6>
                    <p>Based on <strong><?= html($selectedProduct['reviews']) ?></strong> reviews, average rating is <strong><?= number_format($selectedProduct['rating'], 1) ?></strong> / 5.</p>
                    <div class="alert alert-success p-2" role="alert">
                        "Smooth, balanced, and every sip is consistent — I’d order this again." — 4.9 (⭐)
                    </div>
                </section>

                <section>
                    <h6 class="section-heading"><i class="bi bi-truck"></i> Shipping &amp; Pickup</h6>
                    <ul class="ship-list ps-3 mb-0">
                        <li><strong>Local delivery:</strong> 30-45 minutes within Metro area.</li>
                        <li><strong>In-store pickup:</strong> Ready in 5 minutes after order confirmation.</li>
                        <li><strong>Packaging:</strong> recyclable cups with insulated carry sleeve mode.</li>
                    </ul>
                </section>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const productModal = new bootstrap.Modal(document.getElementById('productDetailModal'));
    productModal.show();
</script>

</body>
</html>
