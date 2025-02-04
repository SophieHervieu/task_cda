<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- <nav>
        <a href="/">Accueil</a>
        <a href="/task_cda/moncompte">Mon Compte</a>
        <a href="/task_cda/deconnexion">Se déconnecter</a>
    </nav> -->
    <h1>Mon Compte</h1>
    <h2>Nom : <?php echo $_SESSION['lastname'] ?></h2>
    <h2>Prénom : <?php echo $_SESSION['firstname'] ?></h2>
    <h2>Email : <?php echo $_SESSION['email'] ?></h2>
</body>
</html>