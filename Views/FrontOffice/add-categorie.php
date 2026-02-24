<?php

include '../../Controllers/CategoryController.php';
require_once __DIR__ . '/../../Models/Category.php';
$error = "";
$categoryController = new CategoryController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["title"]) && isset($_POST["description"])) {
        if (!empty($_POST["title"])) {
            $title = $_POST['title'];
            $description = $_POST['description'] ?? '';

            $category = new Category($title, $description);
            $categoryController->addCategory($category);

            // Redirection vers la liste des catégories (à créer)
            header('Location: categoryList.php');
            exit;
        } else {
            $error = "Le titre est obligatoire.";
        }
    } else {
        $error = "Informations manquantes.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="/assets/images/favicon.ico" type="image/x-icon" />
    <title>Ajouter une catégorie</title>

    <!-- ========== CSS ========= -->
    <link rel="stylesheet" href="/assets/vendor/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/assets/vendor/font-awesome/css/all.min.css" />
    <link rel="stylesheet" href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" />
    <link rel="stylesheet" href="/assets/css/style.css" />
</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="spinner"></div>
    </div>

    <!-- Sidebar -->
    <aside class="sidebar-nav-wrapper">
        <div class="navbar-logo">
            <a href="/index.php">
                <img src="/assets/images/logo.svg" alt="logo" width="40%" />
            </a>
        </div>
        <nav class="sidebar-nav">
            <ul>
                <li class="nav-item nav-item-has-children">
                    <a href="#0" data-bs-toggle="collapse" data-bs-target="#ddmenu_1" aria-expanded="false">
                        <span class="icon"><i class="bi bi-speedometer2"></i></span>
                        <span class="text">Dashboard</span>
                    </a>
                    <ul id="ddmenu_1" class="collapse show dropdown-nav">
                        <li><a href="/index.php" class="active">Accueil</a></li>
                    </ul>
                </li>
                <li class="nav-item nav-item-has-children">
                    <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#ddmenu_5">
                        <span class="icon"><i class="bi bi-tags"></i></span>
                        <span class="text">Gestion Catégories</span>
                    </a>
                    <ul id="ddmenu_5" class="collapse dropdown-nav">
                        <li><a href="categoryList.php">Liste</a></li>
                        <li><a href="addCategory.php">Ajouter</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </aside>
    <div class="overlay"></div>

    <main class="main-wrapper">
        <!-- Header -->
        <header class="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-6">
                        <div class="header-left d-flex align-items-center">
                            <div class="menu-toggle-btn mr-15">
                                <button id="menu-toggle" class="main-btn danger-btn btn-hover">
                                    <i class="lni lni-chevron-left me-2"></i> Menu
                                </button>
                            </div>
                            <div class="header-search d-none d-md-flex">
                                <form action="#">
                                    <input type="text" placeholder="Rechercher..." />
                                    <button><i class="lni lni-search-alt"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-6">
                        <div class="header-right">
                            <div class="profile-box ml-15">
                                <button class="dropdown-toggle bg-transparent border-0" data-bs-toggle="dropdown">
                                    <div class="profile-info">
                                        <div class="info">
                                            <div class="image">
                                                <img src="/assets/images/avatar/01.jpg" alt="" />
                                            </div>
                                            <div>
                                                <h6 class="fw-500">Admin</h6>
                                                <p>Admin</p>
                                            </div>
                                        </div>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Contenu principal -->
        <section class="section">
            <div class="container-fluid">
                <div class="title-wrapper pt-30">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h2>Ajouter une catégorie</h2>
                        </div>
                        <div class="col-md-6">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Ajouter</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="content mt-4">
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>

                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="title" class="form-label">Titre <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Titre de la catégorie" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="4" placeholder="Description optionnelle"></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i> Ajouter
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <p class="text-sm">Designed and Developed by Esprit Student</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="#0" class="text-sm me-3">Term & Conditions</a>
                        <a href="#0" class="text-sm">Privacy & Policy</a>
                    </div>
                </div>
            </div>
        </footer>
    </main>

    <!-- Scripts -->
    <script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/main.js"></script>
</body>

</html>