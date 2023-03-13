<?php session_start(); ?>

<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chat</title>
</head>
<body>

<?php

// Récupération des données soumises par l'utilisateur (ici un message + pseudo)
$pseudo = isset($_POST["pseudo"]) ? addslashes($_POST['pseudo']) : false;
$message = isset($_POST['message']) ? addslashes($_POST['message']) : false;

// Vérif s'il s'agit d'un utiliateur déja connecté

if ($pseudo) {
  $_SESSION["pseudo"] = $pseudo;
}

// Vérification de l'existence du tableau d'utilisateurs
if (!isset($_SESSION["utilisateurs"])) {
  $_SESSION["utilisateurs"] = array();
}

// Ajout des informations de l'utilisateur au tableau d'utilisateurs
if ($message) {
$_SESSION["utilisateurs"][] = array("pseudo" => $_SESSION["pseudo"], "message" => $message);
}

// Affichage des informations de tous les utilisateurs
foreach ($_SESSION["utilisateurs"] as $utilisateur) {
  echo  $utilisateur["pseudo"] . " dit : " . $utilisateur["message"] . "<br>";
}
?>

  <h1>Chat</h1>
  <!-- Récupération du pseudo saisi à l'accueil -->
    <p>Bonjour, <?= $_SESSION["pseudo"] ?></p>
  
    <form action="chat.php" method="POST">
    <label for="message">Nouveau message :</label>
    <input type="text" name="message">
    <button type="submit">Envoyer</button>
    </form>

    <!-- Bouton de déconnexion -->
    <form action="logout.php" method="POST">
  <button type="submit" value="Déconnexion">Déconnexion</button>
</form>

  
</body>
</html>
