<?php
include 'includes/header.php';
include 'includes/menu.php';
print_r($medewerker);?>
        <section id='content'>
            <form  method="post" id="gebruiker_form">
                <table >
                    <caption>Detail gegevens van  <?= $medewerker->getNaam();?></caption>
                    <tr>
                        <td >voorletter</td>
                        <td>
                            <input type="text" name="vl" placeholder="vul verplicht je voorletter in." value="<?= $medewerker->getVoorletter();?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td >tussenvoegsel</td>
                        <td>
                            <input type="text" placeholder="vul optioneel tussenvoegsels in." name="tv" value="<?= $medewerker->getTussenvoegsel();?>">
                        </td>
                    </tr>
                    <tr>
                        <td >achternaam</td>
                        <td>
                            <input type="text" name="an" placeholder="vul verplicht je achternaam in." value="<?= $medewerker->getAchternaam();?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td >intern</td>
                        <td>
                            <input type="text" name="int" placeholder="vul optioneel een intern nummer in." value="<?= $medewerker->getIntern();?>" >
                        </td>
                    </tr>
                    <tr>
                        <td >extern</td>
                        <td>
                            <input type="text" name="ext" placeholder="vul optioneel een extern nummer in."  value="<?= $medewerker->getExtern();?>">
                        </td>
                    </tr>
                    <tr>
                        <td >email</td>
                        <td>
                            <input type="email" name="email"  placeholder="vul verplicht een emailadres in."  value="<?= $medewerker->getEmail();?>" required>
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
