<?php
// pages/ProductDetailsPage/productdetails.php

session_start();

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

function html($text)
{
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= html($selectedProduct['name']) ?> · Mindflayer Coffee</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,700&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />

    <style>
        :root {
            --espresso: #3B2A2A;
            --mocha: #6F4C3E;
            --sand: #C2B280;
            --cream: #E8D8B0;
            --linen: #F5F5F0;
            --white: #FFFFFF;
            --text-dark: #2A1E1E;
            --text-mid: #6F4C3E;
            --text-light: #9C8878;
            --font-display: 'Playfair Display', Georgia, serif;
            --font-body: 'DM Sans', system-ui, sans-serif;
            --transition: 0.35s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: var(--font-body);
            background-color: var(--linen);
            color: var(--text-dark);
            overflow-x: hidden;
        }

        h1,
        h2,
        h3,
        h4,
        h5 {
            font-family: var(--font-display);
        }

        a {
            text-decoration: none;
        }

        /* ── Navbar ── */
        .navbar {
            background-color: var(--espresso);
            padding: 1.1rem 2.5rem;
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(194, 178, 128, 0.2);
        }

        .navbar-brand {
            font-family: var(--font-display);
            font-size: 1.55rem;
            font-weight: 900;
            color: var(--cream) !important;
            letter-spacing: -0.02em;
        }

        .navbar-brand span.dot {
            color: var(--sand);
        }

        .navbar-nav .nav-link {
            color: rgba(232, 216, 176, 0.75) !important;
            font-size: 0.88rem;
            font-weight: 400;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 0.25rem 1rem !important;
            transition: color var(--transition);
        }

        .navbar-nav .nav-link:hover {
            color: var(--cream) !important;
        }

        .btn-nav-cta {
            background-color: var(--sand);
            color: var(--espresso) !important;
            font-size: 0.82rem;
            font-weight: 500;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 0.5rem 1.4rem !important;
            border-radius: 2px;
            transition: background var(--transition), transform var(--transition);
        }

        .btn-nav-cta:hover {
            background-color: var(--cream);
            transform: translateY(-1px);
        }

        @media (max-width: 991.98px) {
            .navbar {
                padding: 0.9rem 1.5rem;
            }
        }

        /* ── Breadcrumb ── */
        .breadcrumb-bar {
            background: var(--white);
            border-bottom: 1px solid rgba(194, 178, 128, 0.2);
            padding: 0.75rem 0;
        }

        .breadcrumb-item a {
            color: var(--text-light);
            font-size: 0.82rem;
            letter-spacing: 0.04em;
            transition: color var(--transition);
        }

        .breadcrumb-item a:hover {
            color: var(--mocha);
        }

        .breadcrumb-item.active {
            color: var(--text-mid);
            font-size: 0.82rem;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            color: var(--text-light);
        }

        /* ── Back Arrow ── */
        .btn-back-arrow {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            border: 1px solid rgba(194, 178, 128, 0.4);
            background: transparent;
            color: var(--text-mid);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.95rem;
            flex-shrink: 0;
            transition: all var(--transition);
        }

        .btn-back-arrow:hover {
            background: var(--espresso);
            border-color: var(--espresso);
            color: var(--cream);
        }

        /* ── Hero Product Section ── */
        .product-hero {
            background-color: var(--white);
            border-bottom: 1px solid rgba(194, 178, 128, 0.2);
        }

        .product-image-wrap {
            position: relative;
            background: linear-gradient(135deg, var(--espresso), var(--mocha));
            border-radius: 12px;
            overflow: hidden;
            aspect-ratio: 4/3;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-image-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .product-image-wrap:hover img {
            transform: scale(1.04);
        }

        .product-image-fallback {
            font-size: 6rem;
            line-height: 1;
        }

        .product-badge-pill {
            display: inline-block;
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 0.3rem 0.8rem;
            border-radius: 999px;
            background: rgba(194, 178, 128, 0.2);
            color: var(--mocha);
            border: 1px solid rgba(194, 178, 128, 0.5);
            margin-bottom: 0.75rem;
        }

        .product-title {
            font-family: var(--font-display);
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 900;
            letter-spacing: -0.03em;
            color: var(--espresso);
            line-height: 1.1;
            margin-bottom: 0.5rem;
        }

        .product-tagline {
            font-size: 1rem;
            color: var(--text-light);
            font-style: italic;
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }

        .rating-row {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .rating-stars {
            color: var(--sand);
            font-size: 0.9rem;
        }

        .rating-num {
            font-weight: 700;
            color: var(--espresso);
            font-size: 0.95rem;
        }

        .rating-count {
            color: var(--text-light);
            font-size: 0.85rem;
        }

        .price-display {
            font-family: var(--font-display);
            font-size: 2.4rem;
            font-weight: 900;
            color: var(--espresso);
            letter-spacing: -0.03em;
            line-height: 1;
            margin-bottom: 0.25rem;
        }

        .price-label {
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--text-light);
            margin-bottom: 1.75rem;
        }

        /* ── Add to Cart Button ── */
        .btn-add-cart {
            background: linear-gradient(135deg, var(--sand), var(--cream));
            color: var(--espresso);
            font-family: var(--font-body);
            font-size: 0.9rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 0.9rem 2rem;
            border: none;
            border-radius: 2px;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all var(--transition);
            cursor: pointer;
            position: relative;
            overflow: hidden;
            min-width: 180px;
            justify-content: center;
        }

        .btn-add-cart:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(194, 178, 128, 0.45);
            color: var(--espresso);
        }

        /* Added state */
        .btn-add-cart.added {
            background: linear-gradient(135deg, #2d7a4f, #3a9e65) !important;
            color: #fff !important;
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(45, 122, 79, 0.4) !important;
            pointer-events: none;
        }

        .btn-add-cart.added:hover {
            color: #fff;
        }

        /* Ripple */
        .btn-add-cart .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.4);
            transform: scale(0);
            animation: ripple-anim 0.6s linear;
            pointer-events: none;
        }

        @keyframes ripple-anim {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        /* Label swap */
        .btn-add-cart .btn-label-default,
        .btn-add-cart .btn-label-added {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: opacity 0.2s ease, transform 0.2s ease;
        }

        .btn-add-cart .btn-label-added {
            position: absolute;
            opacity: 0;
            transform: translateY(10px);
        }

        .btn-add-cart.added .btn-label-default {
            opacity: 0;
            transform: translateY(-10px);
        }

        .btn-add-cart.added .btn-label-added {
            opacity: 1;
            transform: translateY(0);
        }

        .btn-details {
            background: transparent;
            color: var(--mocha);
            font-size: 0.88rem;
            font-weight: 500;
            letter-spacing: 0.06em;
            padding: 0.9rem 1.6rem;
            border: 1px solid rgba(111, 76, 62, 0.35);
            border-radius: 2px;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all var(--transition);
            cursor: pointer;
        }

        .btn-details:hover {
            border-color: var(--mocha);
            background: rgba(111, 76, 62, 0.05);
            color: var(--espresso);
        }

        /* ── Quick Stats Row ── */
        .quick-stats {
            display: flex;
            gap: 0;
            border: 1px solid rgba(194, 178, 128, 0.3);
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .quick-stat {
            flex: 1;
            padding: 0.85rem 1rem;
            text-align: center;
            border-right: 1px solid rgba(194, 178, 128, 0.3);
        }

        .quick-stat:last-child {
            border-right: none;
        }

        .quick-stat-val {
            font-family: var(--font-display);
            font-weight: 700;
            font-size: 1rem;
            color: var(--espresso);
            display: block;
        }

        .quick-stat-lbl {
            font-size: 0.68rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--text-light);
        }

        /* ── Tabs / Detail Sections ── */
        .detail-tabs {
            background: var(--white);
            border-top: 1px solid rgba(194, 178, 128, 0.2);
            padding-top: 0;
        }

        .nav-tabs-mf {
            border-bottom: 1px solid rgba(194, 178, 128, 0.25);
            gap: 0;
            padding: 0;
        }

        .nav-tabs-mf .nav-link {
            font-family: var(--font-body);
            font-size: 0.82rem;
            font-weight: 500;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--text-light);
            border: none;
            border-bottom: 2px solid transparent;
            border-radius: 0;
            padding: 1rem 1.25rem;
            margin-bottom: -1px;
            transition: all var(--transition);
        }

        .nav-tabs-mf .nav-link:hover {
            color: var(--mocha);
        }

        .nav-tabs-mf .nav-link.active {
            color: var(--espresso);
            border-bottom-color: var(--sand);
            background: transparent;
        }

        .tab-panel {
            padding: 2.5rem 0;
            max-width: 100%;
        }

        .detail-tabs .container-fluid,
        .tab-panel {
            padding-left: 0;
            padding-right: 0;
        }

        /* ── Spec cards ── */
        .spec-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 1rem;
        }

        .spec-card-mf {
            background: var(--linen);
            border: 1px solid rgba(194, 178, 128, 0.3);
            border-radius: 8px;
            padding: 1.1rem;
            transition: all var(--transition);
        }

        .spec-card-mf:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(59, 42, 42, 0.08);
            border-color: rgba(194, 178, 128, 0.6);
        }

        .spec-card-icon {
            font-size: 1.2rem;
            color: var(--sand);
            margin-bottom: 0.5rem;
        }

        .spec-card-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--text-light);
            margin-bottom: 0.2rem;
        }

        .spec-card-value {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--espresso);
        }

        /* ── Taste pills ── */
        .taste-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.4rem 0.9rem;
            background: var(--linen);
            border: 1px solid rgba(194, 178, 128, 0.4);
            border-radius: 999px;
            font-size: 0.82rem;
            color: var(--text-mid);
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-up {
            animation: fadeUp 0.6s ease both;
        }

        .fade-up-delay {
            animation: fadeUp 0.6s 0.15s ease both;
        }
    </style>
</head>

<body>

    <!-- ═══ NAVBAR ═══════════════════════════════════════════════ -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="/Mindflayers/index.php">
                ☕ Mindflayer<span class="dot">.</span>
            </a>
            <button class="border-0 navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
                <i class="text-warning bi bi-list fs-4"></i>
            </button>
            <div class="collapse navbar-collapse" id="navMain">
                <ul class="gap-1 mx-auto navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="/Mindflayers/pages/ProductListPage/products.php">Menu</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Mindflayers/pages/AboutPage/about.php">Our Story</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Mindflayers/index.php#experience">Experience</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Mindflayers/index.php#contact">Locations</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Mindflayers/pages/ProfilePage/profile.php">Profile</a></li>
                </ul>
                <div class="d-flex align-items-center gap-2">
                    <a href="/Mindflayers/pages/SignupPage/login.php" class="nav-link" style="font-size:0.85rem;">Login</a>
                    <a href="/Mindflayers/pages/ShoppingCartPage/shoppingcart.php" class="btn-nav-cta nav-link">
                        <i class="me-1 bi bi-bag"></i> Shopping Cart
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- ═══ BREADCRUMB ════════════════════════════════════════════ -->
    <div class="breadcrumb-bar">
        <div class="d-flex align-items-center justify-content-between container">
            <div class="d-flex align-items-center gap-3">
                <a href="/Mindflayers/pages/ProductListPage/products.php" class="btn-back-arrow" aria-label="Back to Menu">
                    <i class="bi-arrow-left bi"></i>
                </a>
                <nav aria-label="breadcrumb">
                    <ol class="mb-0 breadcrumb">
                        <li class="breadcrumb-item"><a href="/Mindflayers/index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="/Mindflayers/pages/ProductListPage/products.php">Menu</a></li>
                        <li class="breadcrumb-item active"><?= html($selectedProduct['name']) ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- ═══ PRODUCT HERO ══════════════════════════════════════════ -->
    <section class="py-5 product-hero">
        <div class="py-2 container">
            <div class="align-items-center row g-5">

                <!-- Left: Image -->
                <div class="col-lg-5 fade-up">
                    <div class="product-image-wrap">
                        <?php if (!empty($selectedProduct['image'])): ?>
                            <img src="/Mindflayers/pages/ProductListPage/<?= html($selectedProduct['image']) ?>" alt="<?= html($selectedProduct['name']) ?>">
                        <?php else: ?>
                            <div class="product-image-fallback">☕</div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Right: Info -->
                <div class="col-lg-7 fade-up-delay">
                    <div class="product-badge-pill"><?= html($selectedProduct['badge']) ?></div>
                    <h1 class="product-title"><?= html($selectedProduct['name']) ?></h1>
                    <p class="product-tagline"><?= html($selectedProduct['tagline']) ?></p>

                    <!-- Rating -->
                    <div class="rating-row">
                        <span class="rating-stars">
                            <?php for ($i = 0; $i < 5; $i++): ?>
                                <i class="bi bi-star<?= $i < floor($selectedProduct['rating']) ? '-fill' : ($i < $selectedProduct['rating'] ? '-half' : '') ?>"></i>
                            <?php endfor; ?>
                        </span>
                        <span class="rating-num"><?= number_format($selectedProduct['rating'], 1) ?></span>
                        <span class="rating-count">(<?= html($selectedProduct['reviews']) ?> reviews)</span>
                    </div>

                    <!-- Quick stats -->
                    <div class="quick-stats">
                        <div class="quick-stat">
                            <span class="quick-stat-val"><?= html($selectedProduct['volume']) ?></span>
                            <span class="quick-stat-lbl">Volume</span>
                        </div>
                        <div class="quick-stat">
                            <span class="quick-stat-val"><?= html($selectedProduct['calories']) ?></span>
                            <span class="quick-stat-lbl">Calories</span>
                        </div>
                        <div class="quick-stat">
                            <span class="quick-stat-val"><?= html($selectedProduct['category']) ?></span>
                            <span class="quick-stat-lbl">Category</span>
                        </div>
                    </div>

                    <!-- Price + CTA -->
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div>
                            <div class="price-display">₱<?= number_format($selectedProduct['price']) ?></div>
                            <div class="price-label">Philippine Peso · Inclusive of taxes</div>
                        </div>
                        <form method="post" action="/Mindflayers/pages/ShoppingCartPage/shoppingcart.php" class="m-0" id="cart-form">
                            <input type="hidden" name="product_id" value="<?= (int)$selectedProduct['id'] ?>">
                            <button type="submit" class="btn-add-cart" id="btn-add-cart">
                                <span class="btn-label-default">
                                    <i class="bi bi-cart-fill"></i> Add to Cart
                                </span>
                                <span class="btn-label-added">
                                    <i class="bi bi-check-circle-fill"></i> Added
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══ DETAIL TABS ═══════════════════════════════════════════ -->
    <section class="detail-tabs">
        <div class="px-0 container">
            <ul class="nav nav-tabs-mf" id="detailTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-about" type="button">About</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-specs" type="button">Specifications</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-taste" type="button">Taste Profile</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-shipping" type="button">Delivery</button>
                </li>
            </ul>

            <div class="tab-content">

                <!-- About Tab -->
                <div class="tab-pane fade show active" id="tab-about">
                    <div class="tab-panel">
                        <div class="row g-5">
                            <div class="col-lg-7">
                                <p class="mb-0" style="font-size:1rem;line-height:1.85;color:var(--text-mid);">
                                    <?= html($selectedProduct['desc']) ?>
                                </p>
                                <div class="d-flex flex-wrap gap-2 mt-4">
                                    <span class="taste-pill"><i class="bi bi-heart-fill" style="color:var(--sand);font-size:0.75rem;"></i> Cozy Flavor</span>
                                    <span class="taste-pill"><i class="bi bi-lightning-fill" style="color:var(--sand);font-size:0.75rem;"></i> Energy Boost</span>
                                    <span class="taste-pill"><i class="bi bi-emoji-smile-fill" style="color:var(--sand);font-size:0.75rem;"></i> Feel Good</span>
                                    <span class="taste-pill"><i class="bi bi-award-fill" style="color:var(--sand);font-size:0.75rem;"></i> <?= html($selectedProduct['badge']) ?></span>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div style="background:var(--espresso);border-radius:10px;padding:1.75rem;">
                                    <p style="font-family:var(--font-display);font-size:0.7rem;letter-spacing:0.2em;text-transform:uppercase;color:var(--sand);margin-bottom:1rem;">At a glance</p>
                                    <?php
                                    $glanceItems = [
                                        ['bi-geo-alt', 'Origin', 'Ethically sourced beans'],
                                        ['bi-clock', 'Prep Time', 'Made fresh to order'],
                                        ['bi-recycle', 'Packaging', 'Eco-friendly, compostable'],
                                        ['bi-wifi', 'Dine In', 'Free WiFi available'],
                                    ];
                                    foreach ($glanceItems as $item): ?>
                                        <div class="d-flex align-items-center gap-3 mb-3">
                                            <div style="width:32px;height:32px;border-radius:50%;background:rgba(194,178,128,0.12);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                                <i class="bi <?= $item[0] ?>" style="color:var(--sand);font-size:0.85rem;"></i>
                                            </div>
                                            <div>
                                                <div style="font-size:0.68rem;text-transform:uppercase;letter-spacing:0.1em;color:rgba(232,216,176,0.5);"><?= $item[1] ?></div>
                                                <div style="font-size:0.88rem;color:var(--cream);"><?= $item[2] ?></div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Specs Tab -->
                <div class="tab-pane fade" id="tab-specs">
                    <div class="tab-panel">
                        <div class="spec-grid">
                            <?php foreach ($selectedProduct['specs'] as $spec):
                                $specIcon = match (strtolower($spec['label'])) {
                                    'temperature' => 'bi-thermometer-half',
                                    'base'        => 'bi-cup-straw',
                                    'milk'        => 'bi-droplet-half',
                                    'caffeine'    => 'bi-lightning-charge',
                                    'sugar'       => 'bi-pentagon',
                                    'size'        => 'bi-rulers',
                                    'origin'      => 'bi-geo-alt',
                                    default       => $spec['icon'] ?? 'bi-dot',
                                };
                            ?>
                                <div class="spec-card-mf">
                                    <div class="spec-card-icon"><i class="bi <?= html($specIcon) ?>"></i></div>
                                    <div class="spec-card-label"><?= html($spec['label']) ?></div>
                                    <div class="spec-card-value"><?= html($spec['value']) ?></div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- Taste Profile Tab -->
                <div class="tab-pane fade" id="tab-taste">
                    <div class="tab-panel">
                        <div class="align-items-center row g-4">
                            <div class="col-lg-6">
                                <?php
                                $tastePairs = [
                                    ['Sweetness',  85, 'var(--sand)'],
                                    ['Bitterness', 30, '#8C6647'],
                                    ['Creaminess', 90, '#C2B280'],
                                    ['Intensity',  60, '#6F4C3E'],
                                ];
                                foreach ($tastePairs as $taste): ?>
                                    <div class="mb-4">
                                        <div class="d-flex justify-content-between mb-1">
                                            <span style="font-size:0.82rem;font-weight:600;color:var(--text-mid);text-transform:uppercase;letter-spacing:0.08em;"><?= $taste[0] ?></span>
                                            <span style="font-size:0.82rem;color:var(--text-light);"><?= $taste[1] ?>%</span>
                                        </div>
                                        <div style="height:6px;background:rgba(194,178,128,0.2);border-radius:999px;overflow:hidden;">
                                            <div style="height:100%;width:<?= $taste[1] ?>%;background:<?= $taste[2] ?>;border-radius:999px;transition:width 1s ease;"></div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="col-lg-6">
                                <div style="background:var(--linen);border:1px solid rgba(194,178,128,0.3);border-radius:10px;padding:1.5rem;">
                                    <p style="font-size:0.72rem;text-transform:uppercase;letter-spacing:0.14em;color:var(--text-light);margin-bottom:1rem;">Tasting Notes</p>
                                    <div class="d-flex flex-wrap gap-2">
                                        <?php
                                        $notes = ['Creamy', 'Smooth', 'Sweet', 'Floral', 'Warm', 'Rich'];
                                        foreach ($notes as $note): ?>
                                            <span class="taste-pill"><?= $note ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                    <hr style="border-color:rgba(194,178,128,0.25);margin:1.25rem 0;">
                                    <p style="font-size:0.88rem;color:var(--text-light);line-height:1.7;margin:0;">
                                        Best enjoyed mid-morning or as an afternoon pick-me-up. Pairs well with our pastry selection.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Delivery Tab -->
                <div class="tab-pane fade" id="tab-shipping">
                    <div class="tab-panel">
                        <div class="row g-4">
                            <?php
                            $deliveryInfo = [
                                ['bi-clock-history', 'Preparation Time', '5–10 minutes after order is placed. All drinks are made fresh to order — no pre-made batches.'],
                                ['bi-scooter', 'Delivery Estimate', '30–45 minutes for Metro Manila. Salcedo, BGC, and Poblacion branches offer 20-minute delivery windows.'],
                                ['bi-box-seam', 'Packaging', 'All orders use eco-friendly, compostable cups and paper straws. No single-use plastics.'],
                                ['bi-arrow-repeat', 'Order Changes', 'Modifications accepted within 2 minutes of placing your order via the app or by calling the branch directly.'],
                            ];
                            foreach ($deliveryInfo as $info): ?>
                                <div class="col-md-6">
                                    <div style="background:var(--linen);border:1px solid rgba(194,178,128,0.3);border-radius:10px;padding:1.5rem;height:100%;">
                                        <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:0.75rem;">
                                            <div style="width:38px;height:38px;border-radius:50%;background:rgba(194,178,128,0.2);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                                <i class="bi <?= $info[0] ?>" style="color:var(--mocha);font-size:1rem;"></i>
                                            </div>
                                            <span style="font-size:0.88rem;font-weight:600;color:var(--espresso);"><?= $info[1] ?></span>
                                        </div>
                                        <p style="font-size:0.85rem;color:var(--text-light);line-height:1.7;margin:0;"><?= $info[2] ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

            </div><!-- /tab-content -->
        </div><!-- /container -->
    </section>

    <!-- ═══ FOOTER ════════════════════════════════════════════════ -->
    <footer style="background-color:var(--espresso);border-top:1px solid rgba(194,178,128,0.12);padding:1.5rem 2.5rem;">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 container-fluid">
            <p class="mb-0" style="font-family:var(--font-display);font-size:0.9rem;font-weight:700;color:rgba(245,245,240,0.5);">
                Mindflayer<span style="color:var(--sand);">.</span>
            </p>
            <span style="font-size:0.75rem;color:rgba(245,245,240,0.3);">All prices in Philippine Peso (₱) · Dine In · Takeaway · Delivery</span>
            <div class="d-flex align-items-center gap-3">
                <div style="display:flex;gap:1.5rem;">
                    <a href="#" style="color:rgba(245,245,240,0.4);font-size:0.78rem;text-decoration:none;transition:color 0.3s ease;" onmouseover="this.style.color='var(--sand)'" onmouseout="this.style.color='rgba(245,245,240,0.4)'">Privacy</a>
                    <a href="#" style="color:rgba(245,245,240,0.4);font-size:0.78rem;text-decoration:none;transition:color 0.3s ease;" onmouseover="this.style.color='var(--sand)'" onmouseout="this.style.color='rgba(245,245,240,0.4)'">Terms</a>
                    <a href="#" style="color:rgba(245,245,240,0.4);font-size:0.78rem;text-decoration:none;transition:color 0.3s ease;" onmouseover="this.style.color='var(--sand)'" onmouseout="this.style.color='rgba(245,245,240,0.4)'">Contact</a>
                </div>
                <div style="display:flex;gap:0.5rem;">
                    <a href="#" style="width:36px;height:36px;border-radius:50%;border:1px solid rgba(194,178,128,0.2);display:inline-flex;align-items:center;justify-content:center;color:rgba(245,245,240,0.5);font-size:0.85rem;text-decoration:none;transition:all 0.3s ease;" onmouseover="this.style.borderColor='var(--sand)';this.style.color='var(--sand)'" onmouseout="this.style.borderColor='rgba(194,178,128,0.2)';this.style.color='rgba(245,245,240,0.5)'"><i class="bi bi-instagram"></i></a>
                    <a href="#" style="width:36px;height:36px;border-radius:50%;border:1px solid rgba(194,178,128,0.2);display:inline-flex;align-items:center;justify-content:center;color:rgba(245,245,240,0.5);font-size:0.85rem;text-decoration:none;transition:all 0.3s ease;" onmouseover="this.style.borderColor='var(--sand)';this.style.color='var(--sand)'" onmouseout="this.style.borderColor='rgba(194,178,128,0.2)';this.style.color='rgba(245,245,240,0.5)'"><i class="bi bi-facebook"></i></a>
                    <a href="#" style="width:36px;height:36px;border-radius:50%;border:1px solid rgba(194,178,128,0.2);display:inline-flex;align-items:center;justify-content:center;color:rgba(245,245,240,0.5);font-size:0.85rem;text-decoration:none;transition:all 0.3s ease;" onmouseover="this.style.borderColor='var(--sand)';this.style.color='var(--sand)'" onmouseout="this.style.borderColor='rgba(194,178,128,0.2)';this.style.color='rgba(245,245,240,0.5)'"><i class="bi bi-tiktok"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/auth.js"></script>
    <script>
        /* ── Add to Cart Animation ── */
        const cartForm = document.getElementById('cart-form');
        const btn = document.getElementById('btn-add-cart');

        cartForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Check if user is logged in
            if (!isLoggedIn()) {
                alert('You must be logged in first to add items to cart. Please log in to continue.');
                window.location.href = '../SignupPage/login.php';
                return;
            }

            // Guard against double-clicks
            if (btn.classList.contains('added')) return;

            // Ripple
            const ripple = document.createElement('span');
            ripple.classList.add('ripple');
            const size = Math.max(btn.offsetWidth, btn.offsetHeight);
            ripple.style.cssText = `width:${size}px;height:${size}px;left:${btn.offsetWidth/2 - size/2}px;top:${btn.offsetHeight/2 - size/2}px`;
            btn.appendChild(ripple);
            ripple.addEventListener('animationend', () => ripple.remove());

            // Swap to "Added" state
            btn.classList.add('added');

            // Submit via fetch — stay on the page
            fetch(cartForm.action, {
                method: cartForm.method,
                body: new FormData(cartForm),
                credentials: 'same-origin'
            }).catch(() => {
                /* silent fallback */ });

            // Reset after 2s
            setTimeout(() => {
                btn.classList.remove('added');
            }, 2000);
        });
    </script>
</body>

</html>