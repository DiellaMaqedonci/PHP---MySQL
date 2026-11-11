<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {

    if ($_POST['action'] === 'update') {
        $stmt = $pdo->prepare("UPDATE products SET Name = ?, Description = ?, Quantity = ? WHERE ID = ?");
        $stmt->execute([
            trim($_POST['name']),
            trim($_POST['description']),
            (int)$_POST['quantity'],
            (int)$_POST['id']
        ]);
    }

    if ($_POST['action'] === 'delete') {
        $stmt = $pdo->prepare("DELETE FROM products WHERE ID = ?");
        $stmt->execute([(int)$_POST['id']]);
    }

    if ($_POST['action'] === 'add') {
        $stmt = $pdo->prepare("INSERT INTO products (Name, Description, Quantity) VALUES (?, ?, ?)");
        $stmt->execute([
            trim($_POST['name']),
            trim($_POST['description']),
            (int)$_POST['quantity']
        ]);
    }

    header("Location: edit.php");
    exit;
}

$stmt = $pdo->query("SELECT * FROM products ORDER BY ID ASC");
$products = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Products · Inventory</title>
    
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
        .edit-card { background: var(--card); border-radius: 16px; border: 1px solid var(--border); box-shadow: 0 10px 40px rgba(44,62,80,0.08); overflow: hidden; }
        .table thead th { background: #f4f1ec; color: var(--primary); font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.6px; border-bottom: 2px solid var(--border); padding: 1rem 1.25rem; }
        .table tbody td { padding: 0.9rem 1.25rem; vertical-align: middle; border-color: #f0ebe3; }
        .product-id { font-family: monospace; color: var(--muted); }
        .form-control { border-radius: 8px; border: 1.5px solid var(--border); font-size: 0.92rem; padding: 0.5rem 0.85rem; }
        .form-control:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(230,126,34,0.15); }
        .btn-edit { background: #f4f1ec; color: var(--primary); border: none; border-radius: 8px; padding: 0.4rem 0.9rem; font-size: 0.85rem; font-weight: 500; }
        .btn-edit:hover { background: var(--primary); color: white; }
        .btn-delete { background: #fdecea; color: #c0392b; border: none; border-radius: 8px; padding: 0.4rem 0.9rem; font-size: 0.85rem; font-weight: 500; }
        .btn-delete:hover { background: #c0392b; color: white; }
        .btn-save { background: var(--accent); color: white; border: none; border-radius: 10px; padding: 0.65rem 1.6rem; font-weight: 600; }
        .btn-save:hover { background: #d35400; color: white; }
        .btn-add { background: var(--primary); color: white; border: none; border-radius: 10px; padding: 0.65rem 1.4rem; font-weight: 600; }
        .btn-add:hover { background: #1a252f; color: white; }
        .footer-note { text-align: center; color: var(--muted); font-size: 0.85rem; margin-top: 2.5rem; padding-bottom: 2rem; }
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
                    <li class="nav-item"><a class="nav-link" href="index.php">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link active" href="edit.php">Edit Products</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="page-header">
        <div class="container">
            <h1>Edit Products</h1>
            <p class="mb-0">Update stock levels, names and descriptions</p>
        </div>
    </header>

    <main class="container pb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <p class="text-muted mb-0 small">Changes are saved directly to the database</p>
            <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addProductModal">+ Add Product</button>
        </div>

        <div class="edit-card">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Qty</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($products)): ?>
                            <tr><td colspan="5" class="text-center text-muted py-4">No products yet. Add one!</td></tr>
                        <?php else: ?>
                            <?php foreach ($products as $p): ?>
                            <tr>
                                <td class="product-id">#<?= htmlspecialchars($p['ID']) ?></td>
                                <td>
                                    <form method="POST" class="d-flex gap-2 align-items-center flex-wrap">
                                        <input type="hidden" name="action" value="update">
                                        <input type="hidden" name="id" value="<?= $p['ID'] ?>">
                                        <input type="text" name="name" class="form-control form-control-sm" value="<?= htmlspecialchars($p['Name']) ?>" required>
                                </td>
                                <td>
                                        <input type="text" name="description" class="form-control form-control-sm" value="<?= htmlspecialchars($p['Description']) ?>">
                                </td>
                                <td style="width:90px;">
                                        <input type="number" name="quantity" class="form-control form-control-sm" value="<?= (int)$p['Quantity'] ?>" min="0" required>
                                </td>
                                <td class="text-center">
                                        <button type="submit" class="btn btn-edit btn-sm me-1">Save</button>
                                    </form>
                                    <form method="POST" style="display:inline;" onsubmit="return confirm('Delete this product?')">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id" value="<?= $p['ID'] ?>">
                                        <button type="submit" class="btn btn-delete btn-sm">Delete</button>
                                    </form>
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

    <!-- Add Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius:16px; border:1px solid var(--border);">
                <form method="POST">
                    <input type="hidden" name="action" value="add">
                    <div class="modal-header" style="border-bottom:1px solid var(--border);">
                        <h5 class="modal-title" style="font-family:'Playfair Display',serif;">Add New Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Product Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Description</label>
                            <input type="text" name="description" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Quantity</label>
                            <input type="number" name="quantity" class="form-control" value="0" min="0" required>
                        </div>
                    </div>
                    <div class="modal-footer" style="border-top:1px solid var(--border);">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-save">Add Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>