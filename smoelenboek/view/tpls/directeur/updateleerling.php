<?php
include 'includes/header.php';
include 'includes/menu.php';?>
    <section id='content'>
        <form  method="post" enctype="multipart/form-data" id="gebruiker_form">
            <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
            <table>
                <caption>Wijzig Leerling voor school voor ICT</caption>
                <tr>
                    <td>Voorletter</td>
                    <td>
                        <input type="text" name="vnaam" placeholder="vul verplicht de voornaam in" required="required" value="<?= !empty($leerling->getVoornaam()) ? $leerling->getVoornaam() : '';?>" >
                    </td>
                </tr>
                <tr>
                    <td>Tussenvoegsel:</td>
                    <td><input type="text" name="tv" placeholder="vul eventueel tussenvoegsels in" value="<?= !empty($leerling->getTussenvoegsel()) ? $leerling->getTussenvoegsel() : '';?>" >
                    </td>
                </tr>
                <tr>
                    <td>Achternaam:</td>
                    <td><input type="text" name="anaam" placeholder="vul verplicht de achternaam in" required="required" value="<?= !empty($leerling->getAchternaam()) ? $leerling->getAchternaam() : '';?>">
                    </td>
                </tr>
                <tr>
                    <td>Gebruikersnaam:</td>
                    <td>
                        <input type="text" placeholder="kies verplicht een gebruikersnaam" name="gebrnaam" required="required" value="<?= !empty($leerling->getGebruikersnaam()) ? $leerling->getGebruikersnaam() : '';?>">
                    </td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>
                        <input type="email" name="email" placeholder="geef verplicht een email op" required="required" value="<?= !empty($leerling->getEmail()) ? $leerling->getEmail() : '';?>">
                    </td>
                </tr>
                <tr>
                    <td>Telefoon nummer:</td>
                    <td>
                        <input type="text" name="telnummer" placeholder="geef verplicht een telefoon nummer op" required="required" value="<?= !empty($leerling->getTelefoon()) ? $leerling->getTelefoon() : '';?>">
                    </td>
                </tr>
                <tr>
                    <td>Adres</td>
                    <td>
                        <input type="text" name="adres" placeholder="geef verplicht een adres op" required value="<?= !empty($leerling->getAdres()) ? $leerling->getAdres() : '';?>">
                    </td>
                </tr>
                <tr>
                    <td>Plaats:</td>
                    <td>
                        <input type="text" name="plaats" placeholder="geef verplicht een plaats op" required value="<?= !empty($leerling->getPlaats()) ? $leerling->getPlaats() : '';?>">
                    </td>
                </tr>
                <tr>
                    <td>Klas:</td>
                    <td>
                        <select required name="klas">
                            <?php foreach ($klassen as $klas) :?>
                                <option value="<?= $klas->getId() ;?>" <?= $klas->getId() === $leerling->getKlas_id() ? 'selected' : ''?>><?= $klas->getNaam() ;?>
                                </option>
                            <?php endforeach; unset($klas); ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Opmerkingen:</td>
                    <td><textarea name="opmerkingen"><?= $leerling->getOpmerkingen();?></textarea></td>
                </tr>
            </table>
            <div>
                <input type="submit" value="Wijzig">
                <input type="reset" value="reset">
            </div>
        </form>
        <br id ="breaker">
    </section>
<?php include 'includes/footer.php';

