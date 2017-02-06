<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Smoelenboek</title>
        <link rel="stylesheet" href="css/normalize.css" type="text/css">
        <link rel="stylesheet" href="css/telefoonlijst.css" type="text/css">
        <link rel="stylesheet" href="css/bezoeker.css" type="text/css">
    </head>
    <body>
        <header>
            <figure>
                <img src="img/mondriaan.jpg" alt="ons schoolgebouw aan de tinwerf 10 denhaag" />
            </figure>
            <div>
                <p>Wij zijn een school voor ICT bestaande uit twee afdelingen.</p>
                <p>De afdeling <em>ICT beheer</em> en de afdeling <em>Applicatieontwikkeling</em>. Onze school heeft ongeveer 30 collega's verdeeld over beide afdelingen</p>
                <p>De school heeft als manager <a href="?control=bezoeker&action=directeur"><em><?= $directeur->getNaam();?></em></a>
                    <?= isset($boodschap)?"<p id = 'boodschap'><em>$boodschap</em></p>":""?>
            </div>
        </header>
        <section>
