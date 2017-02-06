<?php
include 'includes/header.php';
include 'includes/menu.php';?>
    <section id='content'>
        <div>
            <table>
                <tr>
                    <th>Gegevens van <?= $leerling->getNaam(); ?></th>
                </tr>
                <tr>
                    <td>Voornaam:</td>
                    <td><?= $leerling->getVoornaam(); ?></td>
                </tr>
                <tr>
                    <td>Tussenvoegsel:</td>
                    <td><?= $leerling->getTussenvoegsel(); ?></td>
                </tr>
                <tr>
                    <td>Achternaam:</td>
                    <td><?= $leerling->getAchternaam(); ?></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><?= $leerling->getEmail(); ?></td>
                </tr>
                <tr>
                    <td>Telefoon nummer:</td>
                    <td><?= $leerling->getTelefoon(); ?></td>
                </tr>
                <tr>
                    <td>Adres:</td>
                    <td><?= $leerling->getAdres(); ?></td>
                </tr>
                <tr>
                    <td>Plaats:</td>
                    <td><?= $leerling->getPlaats(); ?></td>
                </tr>
                <tr>
                    <td>Opmerkingen:</td>
                    <?php if(!$isMentor) :?>
                    <td><?= $leerling->getOpmerkingen(); ?></td>
                    <?php else: ?>
                    <td>
                        <form  method="post" id="gebruiker_form">
                            <textarea type="text" name="opmerkingen"><?= $leerling->getOpmerkingen(); ?></textarea>
                            <input type="submit" value="Submit">
                        </form>
                    </td>
                    <?php endif; ?>
                </tr>
            </table>
        </div>
    </section>
<?php include 'includes/footer.php';
