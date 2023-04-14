<?php

// <!-- <>Vous êtes en charge de développer une application de gestion de vol pour une compagnie aérienne. 
//     L'un des besoins de l'application est de pouvoir afficher les horaires de départ et d'arrivée de chaque vol, ainsi que la durée du vol.

// Pour cela, vous devez créer une fonction calculate_flight_duration qui prend en entrée 
// deux chaînes de caractères représentant l'heure de départ et l'heure d'arrivée d'un vol (au format "HH:MM") et renvoie une chaîne de caractères 
// indiquant la durée du vol (au format "HH:MM").

// La fonction doit respecter les spécifications suivantes :

// Si l'heure d'arrivée est antérieure à l'heure de départ, la fonction doit renvoyer une erreur.
// Si la durée du vol est supérieure à 24 heures, la fonction doit renvoyer une erreur.
// La durée du vol doit être arrondie à la minute supérieure.
// Bien sur, le format des horaires doit etre francais -->


//ON attend que les données existent avant de les récuperer
if (isset($_POST['start']) && isset($_POST['end'])) {


    // on récupéres les donnees
    $start2 = $_POST['start'];
    $end2 = $_POST['end'];
    $dateStart = $_POST['dateStart'];
    $dateEnd = $_POST['dateEnd'];

    //on creer les dates
    $date = new DateTime("$dateStart $start2");
    $date2 = new DateTime("$dateEnd-$end2");

    //on prépare le résultat pour les tests
    $duration = $date->diff($date2);
}


function calculate_flight_duration($duration)
{
    //on test si le resultat est négatif 

    if ($duration->invert == 1) {
        return 'La date d arrivée ne peut pas etre antérieur à la date de depart.';

        //on test la durée
    } else if ($duration->d > 0) {
        return 'La durée du vol dépasse 24h.';

        //on affiche le résultat
    } else {
        return $duration->format('%hh %Im');
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fly</title>
    <link rel="stylesheet" href="fly.css">
</head>

<body>




    <div class='container'>

<!-- on ATTEND les données du formulaire avant d'afficher le résultat -->
        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') { ?>

            <ul>
                <li class="bold">DEPART</li>
                <li><?= $date->format('d/m/Y') ?></li>
                <li><?= $date->format("H:i") ?></li><br>
                <li class="bold">ARRIVEE</li>
                <li><?= $date2->format('d/m/Y') ?></li>
                <li><?= $date2->format("H:i") ?></li><br>
                <li class="bold">TEMPS DE VOL</li>
                <li><?= calculate_flight_duration($duration) ?></li>
            </ul>
            <a href="index.php">RETOUR</a>
    </div>



<?php } else { ?>
<h1>Calculateur de durée de Vol </h1>
    <div class='form'>
        <form action="index.php" method="post">
            <label for="dateStart">Date de départ</label>
            <input type="date" name="dateStart" id="dateStart" required><br>
            <label for="start">Heure de Départ</label>
            <input type="time" name="start" id="start" required><br>
            <br>
            <label for="dateEnd">Date d'arrivée</label>
            <input type="date" name="dateEnd" id="dateEnd" required><br>
            <label for="end">Heure d'arrivée</label>
            <input type="time" name="end" id="end" required><br>
            <button type="submit">GO !</button>
        </form>


    <?php } ?>
    </div>


</body>

</html>