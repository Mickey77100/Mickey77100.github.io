<?php
//Vérification honeypot

if (!empty($_POST['website'])){
    die("Erreur : détection de spam.");
}


function clean($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

$nom     = clean($_POST['nom']);
$prenom  = clean($_POST['prenom']);
$email   = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
$message = clean($_POST['message']);

if (!$email) {
    die("Erreur : email invalide.");
}

$contenu = "Message depuis le site :\n\n";
$contenu .= "Nom : $nom\n";
$contenu .= "Prénom : $prenom\n";
$contenu .= "Email : $email\n";
$contenu .= "Message :\n$message\n";

$headers = "From: $email\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

mail("webcoop77@free.fr", "Formulaire de contact", $contenu, $headers);

unset($_SESSION['captcha']);

echo "Merci, votre message a été envoyé.";
?>