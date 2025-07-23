<?php
// Traitement du formulaire de contact - Déco Élégance

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Récupération et nettoyage des données
    $prenom = htmlspecialchars(trim($_POST['prenom'] ?? ''));
    $nom = htmlspecialchars(trim($_POST['nom'] ?? ''));
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
    $telephone = htmlspecialchars(trim($_POST['telephone'] ?? ''));
    $sujet = htmlspecialchars(trim($_POST['sujet'] ?? ''));
    $budget = htmlspecialchars(trim($_POST['budget'] ?? ''));
    $message = htmlspecialchars(trim($_POST['message'] ?? ''));
    $newsletter = isset($_POST['newsletter']) ? 1 : 0;
    $rgpd = isset($_POST['rgpd']) ? 1 : 0;
    
    // Validation des champs obligatoires
    $erreurs = [];
    
    if (empty($prenom)) {
        $erreurs[] = "Le prénom est obligatoire.";
    }
    
    if (empty($nom)) {
        $erreurs[] = "Le nom est obligatoire.";
    }
    
    if (!$email) {
        $erreurs[] = "L'email est obligatoire et doit être valide.";
    }
    
    if (empty($sujet)) {
        $erreurs[] = "Le sujet est obligatoire.";
    }
    
    if (empty($message)) {
        $erreurs[] = "Le message est obligatoire.";
    }
    
    if (!$rgpd) {
        $erreurs[] = "Vous devez accepter l'utilisation de vos données.";
    }
    
    // Si pas d'erreurs, traitement du message
    if (empty($erreurs)) {
        
        // Préparer l'email
        $destinataire = "contact@deco-elegance.sn";
        $sujet_email = "Nouveau message de contact - " . $sujet;
        
        $corps_message = "
        Nouveau message de contact reçu sur le site Déco Élégance
        
        Informations du contact :
        - Prénom : $prenom
        - Nom : $nom
        - Email : $email
        - Téléphone : $telephone
        - Sujet : $sujet
        - Budget : $budget
        - Newsletter : " . ($newsletter ? 'Oui' : 'Non') . "
        
        Message :
        $message
        
        ---
        Message envoyé depuis le formulaire de contact du site Déco Élégance
        Date : " . date('d/m/Y à H:i:s') . "
        ";
        
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        
        // Tentative d'envoi de l'email
        $envoye = mail($destinataire, $sujet_email, $corps_message, $headers);
        
        if ($envoye) {
            // Succès
            $message_succes = "Votre message a été envoyé avec succès ! Nous vous répondrons dans les plus brefs délais.";
            
            // Si inscription newsletter demandée
            if ($newsletter) {
                // Ici vous pourriez ajouter la logique pour inscrire à la newsletter
                // Par exemple : ajouter l'email à votre base de données newsletter
            }
            
        } else {
            $erreurs[] = "Une erreur est survenue lors de l'envoi du message. Veuillez réessayer.";
        }
        
    }
}

// Redirection vers la page de contact avec le résultat
if (isset($message_succes)) {
    // Succès - rediriger avec message de succès
    header("Location: contact.php?succes=1");
    exit;
} elseif (!empty($erreurs)) {
    // Erreurs - rediriger avec message d'erreur
    $erreurs_encoded = urlencode(implode('|', $erreurs));
    header("Location: contact.php?erreur=" . $erreurs_encoded);
    exit;
} else {
    // Accès direct au fichier - rediriger vers le formulaire
    header("Location: contact.php");
    exit;
}
?>
