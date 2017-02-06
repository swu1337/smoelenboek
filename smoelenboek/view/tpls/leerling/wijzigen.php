<?php
include 'includes/header.php';
include 'includes/menu.php';?>
        <section id='content'>
            <form  method="post" id="gebruiker_form">
                <table >
                    <caption>Detail gegevens van  <?= $gebruiker->getNaam();?></caption>
                        <td >Email:</td>
                        <td>
                            <input type="email" name="email"  placeholder="vul verplicht een emailadres in."  value="<?= $gebruiker->getEmail();?>" required>
                        </td>
                        <td >Telefoon nummer:</td>
                        <td>
                            <input type="text" name="telefoon" placeholder="vul verplicht een telefoon nummer in." value="<?= $gebruiker->getTelefoon();?>" required>
                        </td>
                    </tr>
                </table>
                <div>
                    <input type="submit" value="verstuur" />
                    <input type="reset" value ="reset" />
                </div>
            </form>
        <br id ="breaker">
        </section>
<?php include 'includes/footer.php';
