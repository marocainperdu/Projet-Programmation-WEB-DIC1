<?php
session_start();
require_once 'config.php';
$erreur = '';
$vue = $_POST['vue'] ?? ($_GET['vue'] ?? 'connexion');
if (isset($_POST['action'])) {
    if ($_POST['action'] === 'inscription') {
        $nom = trim($_POST['nom'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $mdp = $_POST['mdp'] ?? '';
        if ($nom && $email && $mdp) {
            $stmt = $pdo->prepare('SELECT id FROM utilisateurs WHERE email = ?');
            $stmt->execute([$email]);
            if ($stmt->fetch()) {
                $erreur = 'Cet email existe déjà.';
                $vue = 'inscription';
            } else {
                $hash = password_hash($mdp, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare('INSERT INTO utilisateurs (nom, email, mot_de_passe) VALUES (?, ?, ?)');
                $stmt->execute([$nom, $email, $hash]);
                $id = $pdo->lastInsertId();
                $_SESSION['utilisateur'] = [
                    'id' => $id,
                    'nom' => $nom,
                    'email' => $email
                ];
                header('Location: compte.php');
                exit;
            }
        } else {
            $erreur = 'Veuillez remplir tous les champs.';
            $vue = 'inscription';
        }
    }
    if ($_POST['action'] === 'connexion') {
        $email = trim($_POST['email'] ?? '');
        $mdp = $_POST['mdp'] ?? '';
        if ($email && $mdp) {
            $stmt = $pdo->prepare('SELECT * FROM utilisateurs WHERE email = ?');
            $stmt->execute([$email]);
            $user = $stmt->fetch();
            if ($user && password_verify($mdp, $user['mot_de_passe'])) {
                $_SESSION['utilisateur'] = [
                    'id' => $user['id'],
                    'nom' => $user['nom'],
                    'email' => $user['email']
                ];
                header('Location: compte.php');
                exit;
            } else {
                $erreur = 'Identifiants incorrects.';
                $vue = 'connexion';
            }
        } else {
            $erreur = 'Veuillez remplir tous les champs.';
            $vue = 'connexion';
        }
    }
    if ($_POST['action'] === 'deconnexion') {
        unset($_SESSION['utilisateur']);
        header('Location: compte.php');
        exit;
    }
}
include 'header.php';
?>
<link rel="stylesheet" href="style.css">
<div class="container compte-container" style="max-width:600px;margin:40px auto 60px auto;background:#fff;border-radius:12px;box-shadow:0 4px 18px rgba(44,62,80,0.08);padding:28px 18px 18px 18px;">
<?php if (isset($_SESSION['utilisateur'])) { ?>
  <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;">
    <div style="font-size:1.2rem;font-weight:600;color:#2c3e50;">Bienvenue, <?php echo htmlspecialchars($_SESSION['utilisateur']['nom']); ?> !</div>
    <form method="post" style="margin:0;">
      <input type="hidden" name="action" value="deconnexion">
      <button type="submit" style="background:none;color:#b48a78;font-weight:600;border:none;cursor:pointer;">Déconnexion</button>
    </form>
  </div>
  <div style="margin-bottom:18px;font-size:1rem;color:#2c3e50;">Vous pouvez suivre vos commandes ici.</div>
  <?php
    // Espace back office si admin (exemple : email = admin@deco-elegance.sn)
    if ($_SESSION['utilisateur']['email'] === 'admin@deco-elegance.sn') {
      echo '<h3 style="margin:30px 0 18px 0;color:#8b6914;">Back Office - Commandes clients</h3>';
      $sql = 'SELECT c.id, c.date_commande, c.total, c.statut, u.nom as client_nom, u.email as client_email
              FROM commandes c
              LEFT JOIN utilisateurs u ON c.utilisateur_id = u.id
              ORDER BY c.date_commande DESC';
      $cmds = $pdo->query($sql)->fetchAll();
      if ($cmds) {
        echo '<table style="width:100%;border-collapse:collapse;margin-bottom:30px;">';
        echo '<tr style="background:#f8f9fa;"><th>Date</th><th>Client</th><th>Email</th><th>Produits</th><th>Total</th><th>Statut</th></tr>';
        foreach ($cmds as $cmd) {
          // Récupérer les produits de la commande
          $stmtP = $pdo->prepare('SELECT produit_nom, quantite FROM commande_produits WHERE commande_id = ?');
          $stmtP->execute([$cmd['id']]);
          $prods = $stmtP->fetchAll();
          $produits = [];
          foreach ($prods as $p) {
            $produits[] = htmlspecialchars($p['produit_nom']) . ' × ' . intval($p['quantite']);
          }
          echo '<tr style="border-bottom:1px solid #eee;">';
          echo '<td>' . date('d/m/Y', strtotime($cmd['date_commande'])) . '</td>';
          echo '<td>' . htmlspecialchars($cmd['client_nom'] ?? '-') . '</td>';
          echo '<td>' . htmlspecialchars($cmd['client_email'] ?? '-') . '</td>';
          echo '<td>' . implode('<br>', $produits) . '</td>';
          echo '<td>' . number_format($cmd['total'], 0, ',', ' ') . ' XOF</td>';
          echo '<td>' . htmlspecialchars($cmd['statut']) . '</td>';
          echo '</tr>';
        }
        echo '</table>';
      } else {
        echo '<div style="color:#888;">Aucune commande trouvée.</div>';
      }
    }
  ?>
  <?php
    $stmt = $pdo->prepare('SELECT * FROM commandes WHERE utilisateur_id = ? ORDER BY date_commande DESC');
    $stmt->execute([$_SESSION['utilisateur']['id']]);
    $commandes = $stmt->fetchAll();
    if ($commandes) {
      echo '<ul class="liste-commandes-client" style="list-style:none;padding:0;">';
      foreach ($commandes as $c) {
        echo '<li class="commande-client-item" style="margin-bottom:16px;padding:12px 0;border-bottom:1px solid #eee;">';
        echo '<div class="commande-date" style="font-weight:600;color:#2c3e50;">Commande du '.date('d/m/Y', strtotime($c['date_commande'])).'</div>';
        echo '<div class="commande-total" style="color:#8b6914;">Total : '.number_format($c['total'],0,',',' ').' XOF</div>';
        // Affichage des produits de la commande
        $stmtP = $pdo->prepare('SELECT produit_nom, quantite FROM commande_produits WHERE commande_id = ?');
        $stmtP->execute([$c['id']]);
        $prods = $stmtP->fetchAll();
        if ($prods) {
          echo '<div style="margin:6px 0 6px 0;color:#2c3e50;font-size:0.98rem;">';
          echo 'Produits : ';
          $liste = [];
          foreach ($prods as $p) {
            $liste[] = htmlspecialchars($p['produit_nom']) . ' × ' . intval($p['quantite']);
          }
          echo implode(' | ', $liste);
          echo '</div>';
        }
        echo '<div class="commande-statut" style="color:#6c757d;">Statut : '.htmlspecialchars($c['statut']).'</div>';
        echo '</li>';
      }
      echo '</ul>';
    } else {
      echo '<div style="color:#888;font-size:1.1rem;">Pas de commande en cours.</div>';
    }
  ?>
<?php } else { ?>
  <div style="max-width:400px;margin:0 auto;">
    <div style="display:flex;justify-content:center;gap:10px;margin-bottom:18px;">
      <form method="post" style="display:inline;">
        <input type="hidden" name="vue" value="connexion">
        <button type="submit" style="padding:7px 18px;border-radius:6px;background:<?php echo $vue==='connexion'?'#b48a78':'#eee'; ?>;color:<?php echo $vue==='connexion'?'#fff':'#333'; ?>;font-weight:600;">Connexion</button>
      </form>
      <form method="post" style="display:inline;">
        <input type="hidden" name="vue" value="inscription">
        <button type="submit" style="padding:7px 18px;border-radius:6px;background:<?php echo $vue==='inscription'?'#b48a78':'#eee'; ?>;color:<?php echo $vue==='inscription'?'#fff':'#333'; ?>;font-weight:600;">Inscription</button>
      </form>
    </div>
    <?php if ($erreur) { echo '<div style="color:#b48a78;margin-bottom:12px;">'.$erreur.'</div>'; } ?>
    <?php if ($vue === 'connexion') { ?>
      <form method="post" style="display:flex;flex-direction:column;gap:12px;">
        <input type="hidden" name="action" value="connexion">
        <input type="email" name="email" placeholder="Email" required style="padding:10px;border-radius:6px;border:1px solid #ccc;">
        <input type="password" name="mdp" placeholder="Mot de passe" required style="padding:10px;border-radius:6px;border:1px solid #ccc;">
        <button type="submit" style="padding:10px 0;border-radius:6px;background:#b48a78;color:#fff;font-weight:600;">Se connecter</button>
      </form>
    <?php } else { ?>
      <form method="post" style="display:flex;flex-direction:column;gap:12px;">
        <input type="hidden" name="action" value="inscription">
        <input type="text" name="nom" placeholder="Nom et prénom" required style="padding:10px;border-radius:6px;border:1px solid #ccc;">
        <input type="email" name="email" placeholder="Email" required style="padding:10px;border-radius:6px;border:1px solid #ccc;">
        <input type="password" name="mdp" placeholder="Mot de passe" required style="padding:10px;border-radius:6px;border:1px solid #ccc;">
        <button type="submit" style="padding:10px 0;border-radius:6px;background:#b48a78;color:#fff;font-weight:600;">S'inscrire</button>
      </form>
    <?php } ?>
  </div>
<?php } ?>
</div>
<?php include 'footer.php'; ?> 