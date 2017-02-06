<?php
include 'includes/header.php';
include 'includes/menu.php';?>
    <section id='content'>
        <table id="contacten">
            <caption>Dit zijn alle klassen van school voor ICT</caption>
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Naam</td>
                    <td>Mentor</td>
                    <td colspan="3">acties</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach($klassen as $klas):?>
                <tr>
                    <td><?= $klas->getId();?></td>
                    <td><?= $klas->getNaam();?></td>
                    <td><?= !empty($klas->getMentor()) ? $klas->getMentor()->getNaam() : '-'; ?></td>
                    <td title="bewerk de contact gegevens van dit contact"><a href='?control=directeur&action=updateklas&id=<?= $klas->getId();?>&prop=klas'><img src="img/bewerk.png"></a></td>
                    <td title="verwijder dit contact definitief"><a href='?control=directeur&action=delete&id=<?= $klas->getId();?>&prop=klas'><img src="img/verwijder.png"></a></td>
                </tr>
                <?php endforeach;?>
                <tr>
                    <td>
                        <a href='?control=directeur&action=createklas&prop=klas'>
                            <figure>
                                <img src="img/toevoegen.png" alt='voeg een klas toe image' title='voeg een klas toe' />
                            </figure>
                        </a>
                    </td>
                    <td colspan='8'>Voeg een klas aan de school toe</td>
                </tr>
            </tbody>
        </table>
        <br id ="breaker" />
    </section>
<?php include 'includes/footer.php';
