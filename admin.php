<?php
require_once 'config.php';
if (isset($_POST['commande_id'], $_POST['statut'])) {
    $stmt = $pdo->prepare('UPDATE commandes SET statut = ? WHERE id = ?');
    $stmt->execute([$_POST['statut'], $_POST['commande_id']]);
    header('Location: admin.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin - Commandes</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body { background: #f8f9fa; }
        .admin-container { max-width: 900px; margin: 40px auto; background: #fff; border-radius: 12px; box-shadow: 0 4px 18px rgba(44,62,80,0.08); padding: 28px 18px 18px 18px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        th, td { padding: 8px 6px; border-bottom: 1px solid #eee; text-align: left; }
        th { background: #f8f9fa; }
        .statut-form { display: flex; gap: 8px; align-items: center; }
        .btn-admin { background: #b48a78; color: #fff; border: none; border-radius: 5px; padding: 5px 14px; cursor: pointer; }
        .btn-admin:hover { background: #8b6914; }
    </style>
</head>
<body>
<div class="admin-container">
    <h2 style="color:#2c3e50;">Back Office - Gestion des commandes</h2>
    <?php
    $sql = 'SELECT c.id, c.date_commande, c.total, c.statut, c.utilisateur_id, c.nom as nom_livraison, u.nom as client_nom, u.email as client_email
            FROM commandes c
            LEFT JOIN utilisateurs u ON c.utilisateur_id = u.id
            ORDER BY c.date_commande DESC';
    $cmds = $pdo->query($sql)->fetchAll();
    if ($cmds) {
        echo '<table>';
        echo '<tr><th>Date</th><th>Client</th><th>Email</th><th>Enregistré</th><th>Produits</th><th>Total</th><th>Statut</th></tr>';
        foreach ($cmds as $cmd) {
            // Produits
            $stmtP = $pdo->prepare('SELECT produit_nom, quantite FROM commande_produits WHERE commande_id = ?');
            $stmtP->execute([$cmd['id']]);
            $prods = $stmtP->fetchAll();
            $produits = [];
            foreach ($prods as $p) {
                $produits[] = htmlspecialchars($p['produit_nom']) . ' × ' . intval($p['quantite']);
            }
            // Nom affiché
            $nomClient = $cmd['client_nom'] ? $cmd['client_nom'] : $cmd['nom_livraison'];
            $emailClient = $cmd['client_email'] ? $cmd['client_email'] : '-';
            $enregistre = $cmd['utilisateur_id'] ? 'Oui' : 'Non';
            echo '<tr>';
            echo '<td>' . date('d/m/Y', strtotime($cmd['date_commande'])) . '</td>';
            echo '<td>' . htmlspecialchars($nomClient) . '</td>';
            echo '<td>' . htmlspecialchars($emailClient) . '</td>';
            echo '<td>' . $enregistre . '</td>';
            echo '<td>' . implode('<br>', $produits) . '</td>';
            echo '<td>' . number_format($cmd['total'], 0, ',', ' ') . ' XOF</td>';
            echo '<td>';
            echo '<form method="post" class="statut-form">';
            echo '<input type="hidden" name="commande_id" value="' . $cmd['id'] . '">';
            echo '<select name="statut">';
            $statuts = ['En attente', 'En cours', 'Livrée', 'Annulée'];
            foreach ($statuts as $s) {
                $sel = ($cmd['statut'] === $s) ? 'selected' : '';
                echo '<option value="' . $s . '" ' . $sel . '>' . $s . '</option>';
            }
            echo '</select> ';
            echo '<button type="submit" class="btn-admin">OK</button>';
            echo '</form>';
            echo '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<div style="color:#888;">Aucune commande trouvée.</div>';
    }
    ?>
</div>
</body>
</html> 