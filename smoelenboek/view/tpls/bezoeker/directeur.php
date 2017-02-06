<?php
include 'includes/header.php';
include 'includes/menu.php';?>
    <section id='content'>
        <figure id="details">
            <div>
                <table id="details_table">
                    <caption>
                        Detail gegevens van  <?= $directeur->getNaam();?>
                    </caption>
                    <tr>
                        <th>Tel nummer:</th>
                        <td><?= $directeur->getTelefoon(); ?></td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td><a href="mailto:<?= $directeur->getEmail();?>" title="klik om te mailen"><?= $directeur->getEmail();?></a></td>
                    </tr>
                </table>
            </div>
            <img src="img/personen/<?= $directeur->getFoto();?>" alt="mijn foto:  <?= $directeur->getNaam();?>" />
            <figcaption>
                De huidige foto van <?= $directeur->getNaam();?>
            </figcaption>
        </figure>
    <br id ="breaker" />
    </section>
<?php include 'includes/footer.php';
