<?php
require 'db.php';

$totalProducts = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
$totalStock    = $pdo->query("SELECT COALESCE(SUM(Quantity), 0) FROM products")->fetchColumn();
$lowStock      = $pdo->query("SELECT COUNT(*) FROM products WHERE Quantity > 0 AND Quantity < 15")->fetchColumn();
$outOfStock    = $pdo->query("SELECT COUNT(*) FROM products WHERE Quantity = 0")->fetchColumn();
$lowItems      = $pdo->query("SELECT * FROM products WHERE Quantity > 0 AND Quantity < 15 ORDER BY Quantity ASC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard · Inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
    <style>
        :root { --primary:#2c3e50; --accent:#e67e22; --bg:#f8f5f0; --card:#fff; --text:#2d3436; --muted:#636e72; --border:#e0d9d0; }
        body { font-family:'Inter',sans-serif; background:var(--bg); color:var(--text); min-height:100vh; margin:0; }
        .main-nav { background:#fff; border-bottom:1px solid var(--border); padding:0.85rem 0; position:sticky; top:0; z-index:1000; box-shadow:0 2px 12px rgba(44,62,80,0.04); }
        .main-nav .navbar-brand { font-family:'Playfair Display',serif; font-weight:600; font-size:1.35rem; color:var(--primary)!important; }
        .main-nav .nav-link { color:var(--muted)!important; font-weight:500; padding:0.5rem 1.1rem!important; border-radius:8px; margin:0 0.15rem; }
        .main-nav .nav-link:hover, .main-nav .nav-link.active { color:var(--primary)!important; background:#f4f1ec; }
        .main-nav .nav-link.active { font-weight:600; }
        .page-header { background:linear-gradient(135deg,#2c3e50,#34495e); color:#fff; padding:2.2rem 0 2.8rem; margin-bottom:2.2rem; position:relative; }
        .page-header::after { content:''; position:absolute; bottom:-20px; left:0; right:0; height:40px; background:var(--bg); border-radius:50% 50% 0 0 / 100% 100% 0 0; }
        .page-header h1 { font-family:'Playfair Display',serif; font-weight:600; font-size:2.2rem; }
        .stat-card { background:var(--card); border-radius:16px; border:1px solid var(--border); padding:1.6rem 1.5rem; box-shadow:0 8px 28px rgba(44,62,80,0.06); height:100%; }
        .stat-label { font-size:0.85rem; color:var(--muted); text-transform:uppercase; letter-spacing:0.5px; margin-bottom:0.4rem; }
        .stat-value { font-family:'Playfair Display',serif; font-size:2.1rem; font-weight:600; color:var(--primary); }
        .stat-sub { font-size:0.85rem; color:var(--muted); margin-top:0.35rem; }
        .stat-icon { width:42px; height:42px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:1.25rem; margin-bottom:1rem; }
        .icon-blue{background:#e8f0fe} .icon-green{background:#e8f8f0} .icon-orange{background:#fff4e6} .icon-red{background:#fdecea}
        .activity-card { background:var(--card); border-radius:16px; border:1px solid var(--border); box-shadow:0 8px 28px rgba(44,62,80,0.06); overflow:hidden; }
        .activity-card .card-header { background:#f4f1ec; border-bottom:1px solid var(--border); padding:1rem 1.4rem; font-weight:600; color:var(--primary); }
        .activity-item { padding:1rem 1.4rem; border-bottom:1px solid #f0ebe3; display:flex; gap:0.9rem; }
        .activity-item:last-child { border-bottom:none; }
        .activity-dot { width:10px; height:10px; border-radius:50%; margin-top:6px; flex-shrink:0; }
        .dot-orange{background:#e67e22}
        .footer-note { text-align:center; color:var(--muted); font-size:0.85rem; margin-top:2.5rem; padding-bottom:2rem; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg main-nav">
        <div class="container">
            <a class="navbar-brand" href="index.php">Inventory</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Products</a></li>
                    <li class="nav-item"><a class="nav-link active" href="dashboard.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="edit.php">Edit Products</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="page-header">
        <div class="container">
            <h1>Dashboard</h1>
            <p class="mb-0">Quick overview of your inventory health</p>
        </div>
    </header>

    <main class="container pb-5">
        <div class="row g-4 mb-4">
            <div class="col-sm-6 col-lg-3"><div class="stat-card"><div class="stat-icon icon-blue">📦</div><div class="stat-label">Total Products</div><div class="stat-value"><?= $totalProducts ?></div><div class="stat-sub">In database</div></div></div>
            <div class="col-sm-6 col-lg-3"><div class="stat-card"><div class="stat-icon icon-green">✅</div><div class="stat-label">Total Stock</div><div class="stat-value"><?= $totalStock ?></div><div class="stat-sub">Units available</div></div></div>
            <div class="col-sm-6 col-lg-3"><div class="stat-card"><div class="stat-icon icon-orange">⚠️</div><div class="stat-label">Low Stock</div><div class="stat-value"><?= $lowStock ?></div><div class="stat-sub">Needs attention</div></div></div>
            <div class="col-sm-6 col-lg-3"><div class="stat-card"><div class="stat-icon icon-red">🔴</div><div class="stat-label">Out of Stock</div><div class="stat-value"><?= $outOfStock ?></div><div class="stat-sub">Zero quantity</div></div></div>
        </div>

        <div class="row g-4">
            <div class="col-lg-7">
                <div class="activity-card">
                    <div class="card-header">Stock Alerts</div>
                    <?php if (empty($lowItems)): ?>
                        <div class="p-4 text-center text-muted">No low stock items right now</div>
                    <?php else: foreach ($lowItems as $item): ?>
                        <div class="activity-item">
                            <div class="activity-dot dot-orange"></div>
                            <div>
                                <div class="activity-text"><strong><?= htmlspecialchars($item['Name']) ?></strong></div>
                                <div class="activity-time">Only <?= (int)$item['Quantity'] ?> units left</div>
                            </div>
                        </div>
                    <?php endforeach; endif; ?>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="activity-card">
                    <div class="card-header">Quick Info</div>
                    <div class="activity-item"><div class="activity-dot dot-orange"></div><div>Low stock threshold is <strong>&lt; 15</strong> units</div></div>
                    <div class="activity-item"><div class="activity-dot" style="background:#3498db"></div><div>Data is live from the <strong>products</strong> table</div></div>
                </div>
            </div>
        </div>
        <p class="footer-note">Connected to database · Built with Bootstrap 5</p>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>