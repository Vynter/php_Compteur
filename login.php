<?php
$erreur = null;
$password = password_hash('123456', PASSWORD_DEFAULT, ['cost' => 12]); // plus le cost est haut plus ca up la difficulté de hack
if (!empty($_POST['pseudo']) && !empty($_POST['mdp'])) {
    if ($_POST['pseudo'] === 'amine' && password_verify($_POST['mdp'], $password)) {
        session_start();
        $_SESSION['connecte'] = 1;
        header('location: index.php');
    } else {
        $erreur = 'Identifiant incorrects';
    }
}


include('header.php');
include_once('auth.php');
if (est_connecte()) {
    header('location: index.php');
}
?>

<form action="" method="post" style="margin-top: 300px">
    <?php if ($erreur) :  ?>
    <div class="alert alert-danger">
        <?= $erreur; ?>

    </div>
    <?php endif;  ?>
    <div class="form-group">
        <input class="form-control" type="text" name="pseudo" placeholder="Votre pseudo">
    </div>
    <div class="form-group">
        <input class="form-control" type="text" name="mdp" placeholder="Votre mot de passe">
    </div>
    <button type="submit" class="btn btn-primary">Se connecter</button>
</form>