<?php
include 'includes/header.php';
include 'includes/menu.php';?>
    <section id='content'>
        <div>
            <table>
                <tr>
                    <th>Gegevens van <?= $gebruiker->getNaam(); ?></th>
                </tr>
                <tr>
                    <td>Voornaam:</td>
                    <td><?= $gebruiker->getVoornaam(); ?></td>
                </tr>
                <tr>
                    <td>Tussenvoegsel:</td>
                    <td><?= $gebruiker->getTussenvoegsel(); ?></td>
                </tr>
                <tr>
                    <td>Achternaam:</td>
                    <td><?= $gebruiker->getAchternaam(); ?></td>
                </tr>
                <tr>
                    <td>Gebruikersnaam:</td>
                    <td><?= $gebruiker->getGebruikersnaam(); ?></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><?= $gebruiker->getEmail(); ?></td>
                </tr>
                <tr>
                    <td>Telefoon nummer:</td>
                    <td><?= $gebruiker->getTelefoon(); ?></td>
                </tr>
                <tr>
                    <td>Adres:</td>
                    <td><?= $gebruiker->getAdres(); ?></td>
                </tr>
                <tr>
                    <td>Plaats:</td>
                    <td><?= $gebruiker->getPlaats(); ?></td>
                </tr>
            </table>
        </div>
    </section>
<?php include 'includes/footer.php';
