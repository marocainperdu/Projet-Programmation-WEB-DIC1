<?php
include 'header.php';

$servicesList = [
    'amenagement' => [
        'titre' => "Aménagement d'intérieur",
        'description' => "Conception et mise en place de votre décoration sur mesure, adaptée à votre espace et à vos envies."
    ],
    'evenementiel' => [
        'titre' => "Décoration événementielle",
        'description' => "Nous décorons vos événements (mariages, baptêmes, soirées) avec goût et selon votre thème."
    ],
    'conseil' => [
        'titre' => "Conseil déco personnalisé",
        'description' => "Nos experts vous accompagnent dans vos choix de couleurs, matières, et agencement."
    ]
];

$selectedService = $_GET['service'] ?? null;
$formSubmitted = $_SERVER['REQUEST_METHOD'] === 'POST';

?>

<main class="services">

  <?php if ($formSubmitted): 
    // Récupérer les données postées
    $nom = htmlspecialchars($_POST['nom'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $tel = htmlspecialchars($_POST['tel'] ?? '');
    $date = htmlspecialchars($_POST['date'] ?? '');
    $heure = htmlspecialchars($_POST['heure'] ?? '');
    $details = htmlspecialchars($_POST['details'] ?? '');
    $service = $_POST['service'] ?? '';
  ?>
    <h1>Demande envoyée</h1>
    <p>Merci <strong><?php echo $nom; ?></strong>, votre demande pour le service "<strong><?php echo $service; ?></strong>" a bien été reçue.</p>
    <p>Nous reviendrons vers vous rapidement.</p>
    <p><a href="services.php">Retour aux services</a></p>

  <?php elseif ($selectedService && isset($servicesList[$selectedService])): 
    $serviceInfo = $servicesList[$selectedService];
  ?>
    <h1>Réservation : <?php echo $serviceInfo['titre']; ?></h1>

    <form action="services.php?service=<?php echo $selectedService; ?>" method="post">
      <input type="hidden" name="service" value="<?php echo $selectedService; ?>">

      <label for="nom">Nom complet :</label><br>
      <input type="text" id="nom" name="nom" required><br><br>

      <label for="email">Email :</label><br>
      <input type="email" id="email" name="email" required><br><br>

      <label for="tel">Téléphone :</label><br>
      <input type="tel" id="tel" name="tel" required><br><br>

      <label for="date">Date souhaitée :</label><br>
      <input type="date" id="date" name="date" required><br><br>

      <label for="heure">Heure souhaitée :</label><br>
      <input type="time" id="heure" name="heure" required><br><br>

      <label for="details">Informations complémentaires :</label><br>
      <textarea id="details" name="details" rows="4"></textarea><br><br>

      <button type="submit">Envoyer la demande</button>
    </form>

    <p><a href="services.php">← Retour aux services</a></p>

  <?php else: ?>
    <h1>Nos Services</h1>

    <?php foreach ($servicesList as $key => $service): ?>
      <section class="service">
        <h2><?php echo $service['titre']; ?></h2>
        <p><?php echo $service['description']; ?></p>
        <a href="services.php?service=<?php echo $key; ?>" class="btn">Prendre rendez-vous</a>
      </section>
    <?php endforeach; ?>
  <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
