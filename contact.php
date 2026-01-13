<?php
// Vérifie si le formulaire a été soumis via la méthode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // --- 1. CONFIGURATION ---
    // Remplacez ceci par votre véritable adresse email
    $to = "votre-email@exemple.com"; 
    
    // --- 2. RÉCUPÉRATION DES DONNÉES ---
    // On utilise htmlspecialchars pour éviter les failles de sécurité (XSS)
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $message_content = htmlspecialchars($_POST['message']);

    // --- 3. PRÉPARATION DE L'EMAIL ---
    $subject = "Nouveau message de : $name";
    
    // Construction du corps du message
    $message = "Vous avez reçu un nouveau message depuis votre site Giftos.\n\n";
    $message .= "Nom : $name\n";
    $message .= "Email : $email\n";
    $message .= "Téléphone : $phone\n";
    $message .= "------------------------\n";
    $message .= "Message :\n$message_content\n";

    // En-têtes pour assurer une bonne réception et le "Répondre à"
    $headers = "From: $email" . "\r\n" .
               "Reply-To: $email" . "\r\n" .
               "X-Mailer: PHP/" . phpversion();

    // --- 4. ENVOI ---
    if (mail($to, $subject, $message, $headers)) {
        echo "<script>
                alert('Message envoyé avec succès !');
                window.location.href = 'index.html';
              </script>";
    } else {
        echo "<script>
                alert('Erreur lors de l\'envoi du message.');
                window.history.back();
              </script>";
    }
}
?>