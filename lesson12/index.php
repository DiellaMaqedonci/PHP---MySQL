<?php
require 'db.php';

$stmt = $pdo->query("SELECT * FROM products ORDER BY ID ASC");
$products = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products · Inventory</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #2c3e50;
            --accent: #e67e22;
            --bg: #f8f5f0;
            --card: #ffffff;
            --text: #2d3436;
            --muted: #636e72;
            --border: #e0d9d0;
        }
        body { font-family: 'Inter', sans-serif; background-color: var(--bg); color: var(--text); min-height: 100vh; margin: 0; }
        .main-nav { background: #fff; border-bottom: 1px solid var(--border); padding: 0.85rem 0; position: sticky; top: 0; z-index: 1000; box-shadow: 0 2px 12px rgba(44,62,80,0.04); }
        .main-nav .navbar-brand { font-family: 'Playfair Display', serif; font-weight: 600; font-size: 1.35rem; color: var(--primary) !important; }
        .main-nav .nav-link { color: var(--muted) !important; font-weight: 500; font-size: 0.95rem; padding: 0.5rem 1.1rem !important; border-radius: 8px; transition: all 0.2s; margin: 0 0.15rem; }
        .main-nav .nav-link:hover { color: var(--primary) !important; background: #f4f1ec; }
        .main-nav .nav-link.active { color: var(--primary) !important; background: #f4f1ec; font-weight: 600; }
        .main-nav .navbar-toggler { border: none; }
        .page-header { background: linear-gradient(135deg, #2c3e50, #34495e); color: white; padding: 2.2rem 0 2.8rem; margin-bottom: 2.2rem; position: relative; overflow: hidden; }
        .page-header::after { content: ''; position: absolute; bottom: -20px; left: 0; right: 0; height: 40px; background: var(--bg); border-radius: 50% 50% 0 0 / 100% 100% 0 0; }
        .page-header h1 { font-family: 'Playfair Display', serif; font-weight: 600; font-size: 2.2rem; margin-bottom: 0.35rem; }
        .page-header p { opacity: 0.85; }
        .table-card { background: var(--card); border-radius: 16px; box-shadow: 0 10px 40px rgba(44,62,80,0.08); border: 1px solid var(--border); overflow: hidden; }
        .table thead th { background: #f4f1ec; color: var(--primary); font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.6px; border-bottom: 2px solid var(--border); padding: 1rem 1.25rem; }
        .table tbody td { padding: 1.1rem 1.25rem; vertical-align: middle; border-color: #f0ebe3; }
        .table tbody tr:hover { background-color: #fdfaf6; }
        .product-id { font-family: monospace; color: var(--muted); }
        .product-name { font-weight: 600; color: var(--primary); }
        .product-desc { color: var(--muted); font-size: 0.9rem; max-width: 320px; }
        .qty-badge { display: inline-block; padding: 0.35rem 0.85rem; border-radius: 50px; font-weight: 600; font-size: 0.85rem; min-width: 52px; text-align: center; }
        .qty-high { background: #e8f8f0; color: #1a7a4c; }
        .qty-medium { background: #fff4e6; color: #c25e00; }
        .qty-low { background: #fdecea; color: #c0392b; }
        .search-box { max-width: 320px; position: relative; }
        .search-box input { border-radius: 50px; border: 1.5px solid var(--border); padding: 0.65rem 1.2rem 0.65rem 2.6rem; }
        .search-box input:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(230,126,34,0.15); outline: none; }
        .search-box .search-icon { position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--muted); }
        .footer-note { text-align: center; color: var(--muted); font-size: 0.85rem; margin-top: 2.5rem; padding-bottom: 2rem; }
        @media (max-width: 768px) {
            .table thead { display: none; }
            .table tbody tr { display: block; margin-bottom: 1rem; border: 1px solid var(--border); border-radius: 12px; padding: 0.75rem; }
            .table tbody td { display: flex; justify-content: space-between; border: none; padding: 0.5rem 0.75rem; }
            .table tbody td::before { content: attr(data-label); font-weight: 600; color: var(--primary); font-size: 0.8rem; text-transform: uppercase; }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg main-nav">
        <div class="container">
            <a class="navbar-brand" href="index.php">Inventory</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="index.php">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="edit.php">Edit Products</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="page-header">
        <div class="container">
            <h1>Product Inventory</h1>
            <p class="mb-0">Current stock overview — updated in real time</p>
        </div>
    </header>

    <main class="container pb-5">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
            <div class="search-box">
                <span class="search-icon">🔍</span>
                <input type="text" id="searchInput" class="form-control" placeholder="Search products...">
            </div>
            <div class="text-muted small"><span id="productCount"><?= count($products) ?></span> products found</div>
        </div>

        <div class="table-card">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="productTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th class="text-center">Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($products)): ?>
                            <tr><td colspan="4" class="text-center text-muted py-4">No products found.</td></tr>
                        <?php else: ?>
                            <?php foreach ($products as $product): 
                                $qty = (int)$product['Quantity'];
                                $qtyClass = $qty >= 50 ? 'qty-high' : ($qty >= 15 ? 'qty-medium' : 'qty-low');
                            ?>
                            <tr>
                                <td data-label="ID" class="product-id">#<?= htmlspecialchars($product['ID']) ?></td>
                                <td data-label="Name" class="product-name"><?= htmlspecialchars($product['Name']) ?></td>
                                <td data-label="Description" class="product-desc"><?= htmlspecialchars($product['Description']) ?></td>
                                <td data-label="Qty" class="text-center">
                                    <span class="qty-badge <?= $qtyClass ?>"><?= $qty ?></span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <p class="footer-note">Connected to database · Built with Bootstrap 5</p>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const searchInput = document.getElementById('searchInput');
        const rows = document.querySelectorAll('#productTable tbody tr');
        const countEl = document.getElementById('productCount');
        searchInput.addEventListener('input', function () {
            const term = this.value.toLowerCase().trim();
            let visible = 0;
            rows.forEach(row => {
                if (row.querySelector('td[colspan]')) return;
                const match = row.textContent.toLowerCase().includes(term);
                row.style.display = match ? '' : 'none';
                if (match) visible++;
            });
            countEl.textContent = visible;
        });
    </script>
</body>
</html>