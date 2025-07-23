<?php
session_start();
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}
$panier = $_SESSION['panier'];
$total = 0;
foreach ($panier as $item) {
    $total += $item['prix'] * $item['quantite'];
}
?>
<?php include 'header.php'; ?>
<link rel="stylesheet" href="style.css">
<div class="container">
    <h1>Mon Panier</h1>
    <?php if (empty($panier)) { ?>
        <p>Votre panier est vide.</p>
    <?php } else { ?>
        <table class="panier-table">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($panier as $id => $item) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['nom']); ?></td>
                        <td><?php echo number_format($item['prix'], 2, ',', ' '); ?> €</td>
                        <td>
                            <form method="post" action="traitement-panier.php" style="display:inline-flex;align-items:center;">
                                <input type="hidden" name="action" value="modifier">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <input type="number" name="quantite" value="<?php echo $item['quantite']; ?>" min="1" style="width:50px;">
                                <button type="submit">OK</button>
                            </form>
                        </td>
                        <td><?php echo number_format($item['prix'] * $item['quantite'], 2, ',', ' '); ?> €</td>
                        <td>
                            <form method="post" action="traitement-panier.php">
                                <input type="hidden" name="action" value="supprimer">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <button type="submit">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="panier-total">
            <strong>Total : <?php echo number_format($total, 2, ',', ' '); ?> €</strong>
        </div>
        <div style="text-align:right;margin-top:25px;">
            <a href="commande.php" class="btn-checkout">Procéder au paiement</a>
        </div>
    <?php } ?>
</div>
<?php include 'footer.php'; ?> 