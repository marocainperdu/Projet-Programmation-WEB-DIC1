<?php
// Démarrer la session en premier
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Calculer le nombre d'articles dans le panier
$nbArticles = 0;
if (isset($_SESSION['panier'])) {
    foreach ($_SESSION['panier'] as $item) {
        $nbArticles += $item['quantite'];
    }
}

// Déterminer la page actuelle
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Déco Élégance Sénégal - Décoration & Ameublement à Dakar</title>
    <meta name="description" content="Déco Élégance - Votre spécialiste en décoration et ameublement au Sénégal. Découvrez notre collection de meubles, luminaires, tapis, artisanat sénégalais et accessoires de décoration à Dakar.">
    <link rel="stylesheet" href="style.css">
    <?php if ($currentPage === 'realisations.php'): ?>
    <link rel="stylesheet" href="realisations.css">
    <?php endif; ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <header class="site-header">
        <!-- Barre d'information -->
        <div class="header-top">
            <div class="container">
                <div class="header-info">
                    <span>📞 +221 33 824 56 78</span>
                    <span>📧 contact@deco-elegance.sn</span>
                    <span>🚚 Livraison gratuite dès 250 000 FCFA</span>
                </div>
                <div class="header-social">
                    <a href="#" aria-label="Facebook"><i class="icon-facebook"></i></a>
                    <a href="#" aria-label="Instagram"><i class="icon-instagram"></i></a>
                    <a href="#" aria-label="Pinterest"><i class="icon-pinterest"></i></a>
                </div>
            </div>
        </div>
        
        <?php include 'menu.php'; ?>
    </header>

    <main class="main-content">
