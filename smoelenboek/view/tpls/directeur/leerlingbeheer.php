<?php
include 'includes/header.php';
include 'includes/menu.php';?>
    <section id='content'>
        <table id="contacten">
            <caption>Dit zijn alle leerlingen van school voor ICT</caption>
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Naam</td>
                    <td>Klas</td>
                    <td>Email</td>
                    <td>Telefoon</td>
                    <td>Wachtwoord</td>
                    <td colspan="3">acties</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach($leerlingen as $leerling):?>
                <tr>
                    <td><?= $leerling->getId(); ?></td>
                    <td><?= $leerling->getNaam(); ?></td>
                    <td><?= $leerling->getKlas_id(); ?></td>
                    <td><?= $leerling->getEmail(); ?></td>
                    <td><?= $leerling->getTelefoon(); ?></td>
                    <td><?= $leerling->getNaam(); ?></td>

                    <td title="bewerk de contact gegevens van dit contact"><a href='?control=directeur&action=update&id=<?= $leerling->getId();?>&prop=leerling'><img src="img/bewerk.png"></a></td>
                    <td title="verwijder dit contact definitief"><a href='?control=directeur&action=delete&id=<?= $leerling->getId();?>&prop=leerling'><img src="img/verwijder.png"></a></td>
                </tr>
                <?php endforeach;?>
                <tr>
                    <td>
                        <a href='?control=directeur&action=createleerling&prop=leerling'>
                            <figure>
                                <img src="img/toevoegen.png" alt='voeg een klas toe image' title='voeg een klas toe' />
                            </figure>
                        </a>
                    </td>
                    <td colspan='8'>Voeg een leerling aan de school toe</td>
                </tr>
            </tbody>
        </table>
        <br id ="breaker" />
    </section>
<?php include 'includes/footer.php';
