<?php
session_start();
require_once 'config.php';
if (!isset($_SESSION['panier']) || empty($_SESSION['panier'])) {
    header('Location: panier.php');
    exit;
}
$panier = $_SESSION['panier'];
$total = 0;
foreach ($panier as $item) {
    $total += $item['prix'] * $item['quantite'];
}
$commande_validee = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom'] ?? '');
    $tel = trim($_POST['tel'] ?? '');
    $adresse = trim($_POST['adresse'] ?? '');
    $email = trim($_POST['email'] ?? '');
    if ($nom && $tel && $adresse && $email) {
        $utilisateur_id = isset($_SESSION['utilisateur']['id']) ? $_SESSION['utilisateur']['id'] : null;
        $stmt = $pdo->prepare('INSERT INTO commandes (utilisateur_id, nom, telephone, adresse, email, total) VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->execute([$utilisateur_id, $nom, $tel, $adresse, $email, $total]);
        $commande_id = $pdo->lastInsertId();
        foreach ($panier as $item) {
            $stmt2 = $pdo->prepare('INSERT INTO commande_produits (commande_id, produit_nom, quantite, prix_unitaire) VALUES (?, ?, ?, ?)');
            $stmt2->execute([$commande_id, $item['nom'], $item['quantite'], $item['prix']]);
        }
        unset($_SESSION['panier']);
        $commande_validee = true;
    }
}
?>
<?php include 'header.php'; ?>
<link rel="stylesheet" href="style.css">
<div class="checkout-simple" style="max-width:700px;margin:40px auto 60px auto;background:#fff;border-radius:12px;box-shadow:0 4px 18px rgba(44,62,80,0.08);padding:28px 18px 18px 18px;">
<?php if ($commande_validee) { ?>
    <div style="text-align:center;padding:40px 0;">
        <div style="font-size:1.2rem;color:#2c3e50;font-weight:600;margin-bottom:18px;">Merci pour votre commande !</div>
        <div style="color:#8b6914;">Nous vous contacterons très vite pour la livraison.</div>
        <a href="index.php" class="btn-checkout" style="margin-top:28px;display:inline-block;">Retour à l'accueil</a>
    </div>
<?php } else { ?>
    <h2 style="font-size:1.3rem;font-weight:600;color:#2c3e50;margin-bottom:18px;">Vos informations pour la livraison</h2>
    <form method="post" action="#" style="margin-bottom:28px;">
        <div style="margin-bottom:12px;">
            <label style="display:block;margin-bottom:4px;color:#8b6914;">Nom et prénom</label>
            <input type="text" name="nom" required style="width:100%;padding:10px 12px;border:1px solid #e9ecef;border-radius:6px;">
        </div>
        <div style="margin-bottom:12px;">
            <label style="display:block;margin-bottom:4px;color:#8b6914;">Téléphone</label>
            <input type="tel" name="tel" required style="width:100%;padding:10px 12px;border:1px solid #e9ecef;border-radius:6px;">
        </div>
        <div style="margin-bottom:12px;">
            <label style="display:block;margin-bottom:4px;color:#8b6914;">Adresse complète</label>
            <input type="text" name="adresse" required style="width:100%;padding:10px 12px;border:1px solid #e9ecef;border-radius:6px;">
        </div>
        <div style="margin-bottom:12px;">
            <label style="display:block;margin-bottom:4px;color:#8b6914;">Email (pour le suivi)</label>
            <input type="email" name="email" required style="width:100%;padding:10px 12px;border:1px solid #e9ecef;border-radius:6px;">
        </div>
        <div style="margin-top:18px;text-align:right;">
            <button type="submit" class="btn-checkout" style="padding:12px 32px;font-size:1rem;">Confirmer la commande</button>
        </div>
    </form>
    <div style="background:#f8f9fa;border-radius:8px;padding:18px 14px 10px 14px;">
        <div style="font-size:1.08rem;font-weight:600;color:#2c3e50;margin-bottom:10px;">Votre panier</div>
        <?php foreach ($panier as $item) { ?>
            <div style="display:flex;justify-content:space-between;font-size:1rem;margin-bottom:6px;">
                <span><?php echo htmlspecialchars($item['nom']); ?> × <?php echo $item['quantite']; ?></span>
                <span><?php echo number_format($item['prix'] * $item['quantite'], 0, ',', ' '); ?> XOF</span>
            </div>
        <?php } ?>
        <div style="display:flex;justify-content:space-between;font-weight:700;color:#8b6914;border-top:1px solid #e9ecef;padding-top:10px;margin-top:10px;">
            <span>Total</span>
            <span><?php echo number_format($total, 0, ',', ' '); ?> XOF</span>
        </div>
    </div>
    <div style="margin-top:18px;font-size:0.98rem;color:#6c757d;">Livraison à Dakar et partout au Sénégal. Un conseiller vous contactera pour valider la commande.</div>
<?php } ?>
</div>
<?php include 'footer.php'; ?> 