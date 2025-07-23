<?php
session_start();
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_POST['action']) ? $_POST['action'] : '';
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    if ($action === 'ajouter') {
        $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
        $prix = isset($_POST['prix']) ? floatval($_POST['prix']) : 0;
        $quantite = isset($_POST['quantite']) ? intval($_POST['quantite']) : 1;
        if ($id && $nom && $prix) {
            if (isset($_SESSION['panier'][$id])) {
                $_SESSION['panier'][$id]['quantite'] += $quantite;
            } else {
                $_SESSION['panier'][$id] = [
                    'nom' => $nom,
                    'prix' => $prix,
                    'quantite' => $quantite
                ];
            }
        }
    }
    if ($action === 'modifier') {
        $quantite = isset($_POST['quantite']) ? intval($_POST['quantite']) : 1;
        if ($id && isset($_SESSION['panier'][$id])) {
            $_SESSION['panier'][$id]['quantite'] = $quantite > 0 ? $quantite : 1;
        }
    }
    if ($action === 'supprimer') {
        if ($id && isset($_SESSION['panier'][$id])) {
            unset($_SESSION['panier'][$id]);
        }
    }
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $nbArticles = 0;
        foreach ($_SESSION['panier'] as $item) {
            $nbArticles += $item['quantite'];
        }
        header('Content-Type: application/json');
        echo json_encode(['nbArticles' => $nbArticles]);
        exit;
    }
}
header('Location: panier.php');
exit; 