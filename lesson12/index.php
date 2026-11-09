<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Dashboard</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://jsdelivr.net" rel="stylesheet">
    <style>
        body {
            background-color: #f8fafc;
            font-family: system-ui, -apple-system, sans-serif;
        }
        /* Sidebar Styling */
        .sidebar {
            min-height: 100vh;
            background-color: #ffffff;
            border-right: 1px solid #e2e8f0;
            padding-top: 20px;
        }
        .sidebar .nav-link {
            color: #475569;
            font-weight: 500;
            padding: 10px 20px;
            border-radius: 0;
            border-left: 3px solid transparent;
        }
        .sidebar .nav-link:hover {
            background-color: #f1f5f9;
            color: #0f172a;
        }
        .sidebar .nav-link.active {
            color: #0284c7;
            background-color: #f0f9ff;
            border-left-color: #0284c7;
        }
        .welcome-text {
            padding: 10px 20px;
            font-size: 0.9rem;
            color: #64748b;
        }
        /* Table and Content Styling */
        .main-content {
            padding: 40px;
        }
        .table-container {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            margin-top: 15px;
        }
        .table th {
            font-weight: 600;
            color: #334155;
            background-color: #ffffff;
            border-bottom: 2px solid #e2e8f0;
        }
        .action-links a {
            text-decoration: none;
            font-size: 0.9rem;
            margin-right: 5px;
        }
        .action-links a.delete {
            color: #0284c7;
        }
        .action-links a.update {
            color: #0284c7;
        }
    </style>
</head>
<body>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar Links Component -->
            <div class="col-md-2 px-0 sidebar">
                <div class="welcome-text">Hello,</div>
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link text-start" id="v-pills-dash-tab" data-bs-toggle="pill" data-bs-target="#v-pills-dash" type="button" role="tab">Dashboard</button>
                    <button class="nav-link text-start active" id="v-pills-prod-tab" data-bs-toggle="pill" data-bs-target="#v-pills-prod" type="button" role="tab">Product Dashboard</button>
                    <button class="nav-link text-start" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab">Edit Profile</button>
                </div>
            </div>

            <!-- Main Content Container Switchboard -->
            <div class="col-md-10 main-content">
                <div class="tab-content" id="v-pills-tabContent">
                    
                    <!-- Dashboard Static View -->
                    <div class="tab-pane fade" id="v-pills-dash" role="tabpanel">
                        <h2>Welcome to Dashboard Overview</h2>
                    </div>

                    <!-- Product Dashboard Main Component View -->
                    <div class="tab-pane fade show active" id="v-pills-prod" role="tabpanel">
                        <h2 class="fw-normal mb-3 text-dark">Products Dashboard</h2>
                        
                        <!-- Add Product Context Trigger -->
                        <div class="mb-2">
                            <a href="#" class="text-decoration-none" style="color: #0284c7;">Add Product</a>
                        </div>

                        <!-- Data Grid Display Layout -->
                        <div class="table-container table-responsive">
                            <table class="table align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Update</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>7</td>
                                        <td>Water bottle</td>
                                        <td>glass water bottle</td>
                                        <td>2</td>
                                        <td>0.05$</td>
                                        <td class="action-links">
                                            <a href="#" class="delete">Delete</a>|
                                            <a href="#" class="update">Update</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>White Board</td>
                                        <td>white board for teaching</td>
                                        <td>5</td>
                                        <td>25$</td>
                                        <td class="action-links">
                                            <a href="#" class="delete">Delete</a>|
                                            <a href="#" class="update">Update</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Edit Profile Mutation Form Template View -->
                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel">
                        <h2 class="fw-normal mb-4">Dashboard (Edit Profile)</h2>
                        <div class="card p-4 border-0 shadow-sm" style="max-width: 500px;">
                            <form>
                                <div class="mb-3">
                                    <label class="form-label text-secondary small">Id</label>
                                    <input type="text" class="form-control" placeholder="ID" disabled>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-secondary small">Name</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-secondary small">Surname</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-secondary small">Username</label>
                                    <input type="text" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary bg-gradient px-4">Update</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://jsdelivr.net"></script>
</body>
</html>
