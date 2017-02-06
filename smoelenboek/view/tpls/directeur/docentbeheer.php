<?php
include 'includes/header.php';
include 'includes/menu.php';?>
    <section id='content'>
        <table id="contacten">
            <caption>Dit zijn alle docenten van school voor ICT</caption>
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Naam</td>
                    <td>Mentor van klas</td>
                    <td>Email</td>
                    <td>Telefoon nummer</td>
                    <td>Wachtwoord</td>
                    <td colspan="3">acties</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach($docenten as $docent):?>
                <tr>
                    <td><?= $docent->getId();?></td>
                    <td><?= $docent->getNaam();?></td>
                    <td><?= $docent->klasnaam ?></td>
                    <td><?= $docent->getEmail();?></td>
                    <td><?= $docent->getTelefoon();?></td>
                    <td title="reset het wachtwoord van dit contact naar qwerty"><a href='?control=directeur&action=reset&id=<?= $docent->getId();?>'><img src="img/resetww.png"></a></td>
                    <td title="bewerk de contact gegevens van dit contact"><a href='?control=directeur&action=update&id=<?= $docent->getId();?>&prop=docent'><img src="img/bewerk.png"></a></td>
                    <td title="verwijder dit contact definitief"><a href='?control=directeur&action=delete&id=<?= $docent->getId();?>&prop=docent'><img src="img/verwijder.png"></a></td>
                </tr>
                <?php endforeach;?>
                <tr>
                    <td>
                        <a href='?control=directeur&action=createdocent&prop=docent'>
                            <figure>
                                <img src="img/toevoegen.png" alt='voeg een klas toe image' title='voeg een klas toe' />
                            </figure>
                        </a>
                    </td>
                    <td colspan='7'>Voeg een docent aan de school toe</td>
                </tr>
            </tbody>
        </table>
        <br id ="breaker" />
    </section>
<?php include 'includes/footer.php';
