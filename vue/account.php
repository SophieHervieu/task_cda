<html lang="fr">
<body>
    <section>
    <h1>Ajouter un utilisateur</h1>
        <form action="" method="post">
            <label for="lastname">Nom:</label><br>
            <input type="text" name="lastname"><br>
            <label for="firstname">Prénom:</label><br>
            <input type="text" name="firstname"><br>
            <label for="email">Adresse email:</label><br>
            <input type="email" name="email"><br>
            <label for="password">Mot de passe:</label><br>
            <input type="password" name="password"><br>
            <input type="submit" value="envoyer" name="submit">
        </form>
        <p>
            <?= htmlspecialchars($message) ?>
        </p>
    </section>
    <section>
        <h2>Liste des utilisateurs</h2>
        <?= $output ?>
    </section>
    <section>
    <h1>Connexion</h1>
        <form action="" method="post">
            <label for="email">Adresse email:</label><br>
            <input type="email" name="email"><br>
            <label for="password">Mot de passe:</label><br>
            <input type="password" name="password"><br>
            <input type="submit" value="me connecter" name="connect">
        </form>
        <p>
            <?php echo $loginMessage ?>
        </p>
    </section>
</body>
</html>