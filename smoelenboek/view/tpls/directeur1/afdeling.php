<?php
include 'includes/header.php';
include 'includes/menu.php';?>
        <section id='content'>
            <form  method="post" id="gebruiker_form">
                <p>Wijzig hier de teks voor de afdeling</p>
                <br />
                <table >
                    <?php foreach($afdelingen as $afdeling): ?>
                        <tr>
                            <td>Team <?= strtoupper($afdeling->getAfkorting()) ?></td>
                            <td>
                                <textarea rows="12" cols="50" type="text" name=<?= $afdeling->getAfkorting(); ?> placeholder="Tekst voor de team ao"  required><?= $afdeling->getOmschrijving();?></textarea>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <div>
                    <input type="submit" value="verstuur" />
                    <input type="reset" value ="reset" />
                </div>
            </form>
        <br id="breaker">
        </section>
<?php include 'includes/footer.php';
