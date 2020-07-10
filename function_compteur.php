<?php
function ajouter_vue()
{
    $path = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'compteur';
    $path_month = $path . '-' . date('Y-m-d');
    increment_vue($path);
    increment_vue($path_month);
}

function increment_vue($fichier)
{

    if (file_exists($fichier)) {   // si le fichier existe
        $nbr = (int) file_get_contents($fichier); // on récupére le contenu
        $nbr += 1; // on l'incrément
        file_put_contents($fichier, (string) $nbr); // on rajoute la nouvelle valeur
    } else {
        file_put_contents($fichier, '1'); // on crée le bordel avec la valeur de 1
        $nbr = '1';
    }
}

function afficher()
{
    $fichier = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'compteur';
    return file_get_contents($fichier);
}
function nombre_vue_mois($annee, $mois)
{
    $mois = str_pad($mois, 2, '0', STR_PAD_LEFT); //si le mois comporte 1 chiffre on lui rajoute 0 a gauche
    $fichier = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'compteur-' . $annee . '-' . $mois . '-' . '*';
    $fichiers = glob($fichier); /* il chercher tt les fichier qui ont le chemin d'endessus et qui finisse par * */
    $total = 0;
    foreach ($fichiers as $fichier) {
        $total += (int) file_get_contents($fichier);
    }
    return $total;
}

function nombre_vue_detail_mois($annee, $mois)
{
    $mois = str_pad($mois, 2, '0', STR_PAD_LEFT); //si le mois comporte 1 chiffre on lui rajoute 0 a gauche
    $fichier = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'compteur-' . $annee . '-' . $mois . '-' . '*';
    $fichiers = glob($fichier); /* il chercher tt les fichier qui ont le chemin d'endessus et qui finisse par * */
    $visite = [];
    foreach ($fichiers as $fichier) {

        $partie = explode('-', basename($fichier)); // ca donne ['compteur','2020','05','01']
        $visite[] = [
            'annee' => $partie[1],
            'mois' => $partie[2],
            'jour' => $partie[3],
            'total' => file_get_contents($fichier)
        ];
    }
    return $visite;
}