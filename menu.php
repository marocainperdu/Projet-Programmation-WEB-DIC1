<nav class="main-nav">
    <div class="nav-container">
        <!-- Logo -->
        <div class="nav-logo">
            <a href="index.php">
                <img src="images/logo.png" alt="Déco Élégance" class="logo-img" />
                <span class="logo-text">Déco Élégance</span>
            </a>
        </div>

        <!-- Menu principal -->
        <ul class="nav-menu" id="nav-menu">
            <li class="nav-item">
                <a href="index.php" class="nav-link active">Accueil</a>
            </li>
            <li class="nav-item dropdown">
                <a href="produits.php" class="nav-link">Produits</a>
                <div class="dropdown-content">
                    <a href="produits.php?category=meubles">Meubles</a>
                    <a href="produits.php?category=luminaires">Luminaires</a>
                    <a href="produits.php?category=tapis">Tapis & Textiles</a>
                    <a href="produits.php?category=accessoires">Accessoires</a>
                    <a href="produits.php?category=artisanat">Artisanat Sénégalais</a>
                </div>
            </li>
            <li class="nav-item">
                <a href="services.php" class="nav-link">Services</a>
            </li>
            <li class="nav-item">
                <a href="realisations.php" class="nav-link">Réalisations</a>
            </li>
            <li class="nav-item">
                <a href="blog.php" class="nav-link">Blog</a>
            </li>
            <li class="nav-item">
                <a href="apropos.php" class="nav-link">À propos</a>
            </li>
            <li class="nav-item">
                <a href="contact.php" class="nav-link">Contact</a>
            </li>
        </ul>

        <!-- Actions utilisateur -->
        <div class="nav-actions">
            <a href="compte.php" class="nav-action" title="Mon compte">
                <i class="icon-user"></i>
                <span class="action-text">Mon compte</span>
            </a>
            <a href="panier.php" class="nav-action cart-link" title="Panier">
                <i class="icon-cart"></i>
                <span class="action-text">Panier</span>
                <span class="cart-count" id="cart-count">0</span>
            </a>
        </div>

        <!-- Bouton menu burger pour mobile -->
        <button class="nav-toggle" id="nav-toggle" aria-label="Menu">
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
        </button>
    </div>
</nav>

