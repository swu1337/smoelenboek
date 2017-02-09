<?php
include 'includes/header.php';
include 'includes/menu.php';?>
    <section id='content'>
        <form  method="post" enctype="multipart/form-data" id="gebruiker_form">
            <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
            <table>
                <caption>Wijzig Docent voor school voor ICT</caption>
                <tr>
                    <td>Voorletter</td>
                    <td>
                        <input type="text" name="vnaam" placeholder="vul verplicht de voornaam in" required value="<?= !empty($docent->getVoornaam()) ? $docent->getVoornaam() : '';?>" >
                    </td>
                </tr>
                <tr>
                    <td>Tussenvoegsel:</td>
                    <td><input type="text" name="tv" placeholder="vul eventueel tussenvoegsels in" value="<?= !empty($docent->getTussenvoegsel()) ? $docent->getTussenvoegsel() : '';?>" >
                    </td>
                </tr>
                <tr>
                    <td>Achternaam:</td>
                    <td><input type="text" name="anaam" placeholder="vul verplicht de achternaam in" required value="<?= !empty($docent->getAchternaam()) ? $docent->getAchternaam() : '';?>">
                    </td>
                </tr>
                <tr>
                    <td>Gebruikersnaam:</td>
                    <td>
                        <input type="text" placeholder="kies verplicht een gebruikersnaam" name="gebrnaam" required value="<?= !empty($docent->getGebruikersnaam()) ? $docent->getGebruikersnaam() : '';?>">
                    </td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>
                        <input type="email" name="email" placeholder="geef verplicht een email op" required value="<?= !empty($docent->getEmail()) ? $docent->getEmail() : '';?>">
                    </td>
                </tr>
                <tr>
                    <td>Telefoon nummer:</td>
                    <td>
                        <input type="text" name="telnummer" placeholder="geef verplicht een telefoon nummer op" required value="<?= !empty($docent->getTelefoon()) ? $docent->getTelefoon() : '';?>">
                    </td>
                </tr>
                <tr>
                    <td>Adres</td>
                    <td>
                        <input type="text" name="adres" placeholder="geef een adres op" value="<?= !empty($docent->getAdres()) ? $docent->getAdres() : '';?>">
                    </td>
                </tr>
                <tr>
                    <td>Plaats:</td>
                    <td>
                        <input type="text" name="plaats" placeholder="geef een plaats op" value="<?= !empty($docent->getPlaats()) ? $docent->getPlaats() : '';?>">
                    </td>
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

