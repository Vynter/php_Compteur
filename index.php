<?php
include('auth.php');
forcer_utilisateur_connecte();


include('header.php');
include('function_compteur.php');
ajouter_vue();

$annee = (int) date('Y');
$annee_selection = empty($_GET['annee']) ? /*$annee*/ null : (int) $_GET['annee']; /* si le lien n'est pas en get on affiche l'année actuel*/
$mois_selection = empty($_GET['mois']) ? /*date('m')*/ null :  $_GET['mois'];
if ($annee_selection && $mois_selection) {
    $total = nombre_vue_mois($annee_selection, $mois_selection);
    $détail = nombre_vue_detail_mois($annee_selection, $mois_selection);
} else {
    $total = afficher();
}
$mois = [
    '01' => 'janvier',
    '02' => 'février',
    '03' => 'mars',
    '04' => 'avril',
    '05' => 'mai',
    '06' => 'juin',
    '07' => 'juillet',
    '08' => 'aout',
    '09' => 'septembre',
    '10' => 'octobre',
    '11' => 'novembre',
    '12' => 'décembre',
];
?>
<div class="row" style="margin-top: 200px">
    <div class="col-md-4">
        <div class="list-group">
            <?php for ($i = 0; $i < 5; $i++) : ?>
            <a class="list-group-item <?= $annee_selection === $annee - $i ? 'active' : ''; ?> "
                href="index.php?annee=<?= $annee - $i; ?>"> <?= $annee - $i; ?> </a>
            <?php if ($annee_selection === $annee - $i) : ?>
            <div class="list-group">
                <?php foreach ($mois as $k => $v) : ?>
                <a class="list-group-item <?= $mois_selection === $k ? 'active' : ''; ?>"
                    href="index.php?annee=<?= $annee_selection ?>&mois=<?= $k ?>"><?= $v; ?></a>
                <?php endforeach; ?>
            </div>

            <?php endif; ?>
            <?php endfor; ?>
        </div>
    </div>
    <div class=" col-md-8">
        <div class="card">
            <div class="card-body"><strong style="font-size: 3em;"><?= $total; ?></strong> <br>
                Visite<?= $total > 1 ? 's' : '';  ?> total
            </div>
        </div>
        <?php if (isset($détail)) : ?>
        <h2>Détails des visites par le mois</h2>
        <table class="table table-striped">
            <tr>
                <thead>
                    <tr>
                        <th>Jour</th>
                        <th>Mois</th>
                        <th>l'Année</th>
                        <th>Total des visites</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($détail as $ligne) : ?>
                    <tr>
                        <td><?= $ligne['jour'] ?></td>
                        <td><?= $ligne['mois'] ?></td>
                        <td><?= $ligne['annee'] ?></td>
                        <td><?= $ligne['total'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </tr>
        </table>
        <?php endif; ?>
    </div>
</div>