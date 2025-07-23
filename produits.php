<?php
include 'header.php';

$products = [
    1 => ['categorie' => 'meubles', 'nom' => 'Canapé Wax', 'description' => 'Design africain en tissu wax', 'prix' => 150000, 'image' => 'images/meubles-canape-wax.jpg'],
    2 => ['categorie' => 'meubles', 'nom' => 'Chaise en bois sculpté', 'description' => 'Chaise artisanale en bois', 'prix' => 85000, 'image' => 'images/meubles-chaise.jpg'],
    3 => ['categorie' => 'tapis', 'nom' => 'Tapis berbère', 'description' => 'Fabriqué à la main, 100% laine', 'prix' => 75000, 'image' => 'images/tapis-berbere.jpg'],
    4 => ['categorie' => 'tapis', 'nom' => 'Tapis en jute naturel', 'description' => 'Tapis écologique en fibres naturelles', 'prix' => 65000, 'image' => 'images/tapis-jute.jpg'],
    5 => ['categorie' => 'luminaires', 'nom' => 'Lampe en osier', 'description' => 'Lampe artisanale tressée', 'prix' => 55000, 'image' => 'images/luminaires-osier.jpg'],
    6 => ['categorie' => 'luminaires', 'nom' => 'Suspension en métal', 'description' => 'Lampe design industrielle', 'prix' => 120000, 'image' => 'images/luminaires-metal.jpg'],
    7 => ['categorie' => 'artisanat', 'nom' => 'Sculpture en bois', 'description' => 'Artisanat local de Casamance', 'prix' => 45000, 'image' => 'images/artisanat-sculpture-bois.jpg'],
    8 => ['categorie' => 'artisanat', 'nom' => 'Poterie traditionnelle', 'description' => 'Poterie artisanale sénégalaise', 'prix' => 30000, 'image' => 'images/artisanat-poterie.jpg'],
    9 => ['categorie' => 'accessoires', 'nom' => 'Coussin en wax', 'description' => 'Coussin décoratif en tissu wax coloré', 'prix' => 12000, 'image' => 'images/accessoires-coussin-wax.jpg'],
    10 => ['categorie' => 'accessoires', 'nom' => 'Corbeille tressée', 'description' => 'Corbeille artisanale pour rangement', 'prix' => 18000, 'image' => 'images/accessoires-corbeille.jpg'],
];

$selectedCategory = $_GET['category'] ?? null;
$productId = $_GET['id'] ?? null;

if ($productId && isset($products[$productId])) {
    $prod = $products[$productId];
    ?>
    <main class="fiche-produit">
      <h1><?php echo htmlspecialchars($prod['nom']); ?></h1>
      <img src="<?php echo $prod['image']; ?>" alt="<?php echo htmlspecialchars($prod['nom']); ?>" style="max-width:400px;">
      <p><?php echo htmlspecialchars($prod['description']); ?></p>
      <p class="prix"><?php echo number_format($prod['prix'], 0, ',', ' ') . ' XOF'; ?></p>
      <button class="btn-ajouter-panier" data-id="<?php echo $productId; ?>" data-nom="<?php echo htmlspecialchars($prod['nom']); ?>" data-prix="<?php echo $prod['prix']; ?>">Ajouter au panier</button>
      <p><a href="produits.php<?php echo $selectedCategory ? '?category='.$selectedCategory : ''; ?>">← Retour aux produits</a></p>
    </main>
<?php
} else {
    $displayProducts = [];
    if ($selectedCategory) {
        foreach ($products as $id => $prod) {
            if ($prod['categorie'] === $selectedCategory) {
                $displayProducts[$id] = $prod;
            }
        }
    } else {
        $displayProducts = $products;
    }
    ?>

    <main class="produits">
      <h1>Nos Produits</h1>

      <?php if ($selectedCategory): ?>
        <h2>Catégorie : <?php echo ucfirst($selectedCategory); ?></h2>
      <?php else: ?>
        <h2>Toutes les catégories</h2>
      <?php endif; ?>

      <div class="produits-grid">
        <?php if (!empty($displayProducts)): ?>
          <?php foreach ($displayProducts as $id => $prod): ?>
            <div class="produit">
              <a href="produits.php?id=<?php echo $id; ?>">
                <img src="<?php echo $prod['image']; ?>" alt="<?php echo htmlspecialchars($prod['nom']); ?>" style="max-width: 200px;">
                <h3><?php echo htmlspecialchars($prod['nom']); ?></h3>
              </a>
              <p><?php echo htmlspecialchars($prod['description']); ?></p>
              <p class="prix"><?php echo number_format($prod['prix'], 0, ',', ' ') . ' XOF'; ?></p>
              <button class="btn-ajouter-panier" data-id="<?php echo $id; ?>" data-nom="<?php echo htmlspecialchars($prod['nom']); ?>" data-prix="<?php echo $prod['prix']; ?>">Ajouter au panier</button>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p>Aucun produit trouvé dans cette catégorie.</p>
        <?php endif; ?>
      </div>

      <hr>

      <nav class="categories-nav">
        <a href="produits.php?category=meubles">Meubles</a> | 
        <a href="produits.php?category=tapis">Tapis</a> | 
        <a href="produits.php?category=luminaires">Luminaires</a> | 
        <a href="produits.php?category=artisanat">Artisanat Sénégalais</a> |
        <a href="produits.php?category=accessoires">Accessoires</a> | 
        <a href="produits.php">Toutes les catégories</a>
      </nav>
    </main>

<?php
}

include 'footer.php';
?>

<div id="modal-panier" class="modal-panier" style="display:none;">
  <div class="modal-content-panier">
    <span class="close-modal-panier">&times;</span>
    <h2 id="modal-produit-nom"></h2>
    <form id="form-ajout-panier">
      <input type="hidden" name="id" id="modal-produit-id">
      <input type="hidden" name="nom" id="modal-produit-nom-input">
      <input type="hidden" name="prix" id="modal-produit-prix">
      <label for="modal-quantite">Quantité :</label>
      <input type="number" name="quantite" id="modal-quantite" value="1" min="1" style="width:60px;">
      <button type="submit">Ajouter</button>
    </form>
  </div>
</div>
<script src="script.js"></script>
