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
                        <input type="text" name="vnaam" placeholder="vul verplicht de voornaam in" required="required" value="<?= !empty($form_data['vnaam'])?$form_data['vnaam']:'';?>" >
                    </td>
                </tr>
                <tr>
                    <td>Tussenvoegsel:</td>
                    <td><input type="text" name="tv" placeholder="vul eventueel tussenvoegsels in" value="<?= !empty($form_data['tv'])?$form_data['tv']:'';?>" >
                    </td>
                </tr>
                <tr>
                    <td>Achternaam:</td>
                    <td><input type="text" name="anaam" placeholder="vul verplicht de achternaam in" required="required" value="<?= !empty($form_data['anaam']) ? $form_data['anaam'] : '';?>">
                    </td>
                </tr>
                <tr>
                    <td>Gebruikersnaam:</td>
                    <td>
                        <input type="text" placeholder="kies verplicht een gebruikersnaam" name="gebrnaam" required="required" value="<?= !empty($form_data['gebrnaam']) ? $form_data['gebrnaam'] : '';?>">
                    </td>
                </tr>
                <tr >
                    <td>Wachtwoord:</td>
                    <td>
                        <input type="password" name="ww" placeholder='kies eventueel een ww default "qwerty"' value="<?= !empty($form_data['ww']) ? $form_data['ww'] : '';?>" >
                    </td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>
                        <input type="email" name="email" placeholder="geef verplicht een email op" required="required" value="<?= !empty($form_data['email']) ? $form_data['email'] : '';?>">
                    </td>
                </tr>
                <tr>
                    <td>Telefoon nummer:</td>
                    <td>
                        <input type="text" name="telnummer" placeholder="geef verplicht een telefoon nummer op" required="required" value="<?= !empty($form_data['telnummer']) ? $form_data['telnummer'] : '';?>">
                    </td>
                </tr>
                <tr>
                    <td>Adres</td>
                    <td>
                        <input type="text" name="adres" placeholder="geef verplicht een adres op" required value="<?= !empty($form_data['adres']) ? $form_data['adres'] : '';?>">
                    </td>
                </tr>
                <tr>
                    <td>Plaats:</td>
                    <td>
                        <input type="text" name="plaats" placeholder="geef verplicht een plaats op" required value="<?= !empty($form_data['plaats']) ? $form_data['plaats'] : '';?>">
                    </td>
                </tr>
                <tr>
                    <td>Klas:</td>
                    <td>
                        <select required name="klas">
                            <?php foreach ($klassen as $klas) :?>
                                <option value="<?= $klas->getId() ;?>"><?= $klas->getNaam() ;?>
                                </option>
                            <?php endforeach; unset($klas); ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Foto (optioneel):</td>
                    <td>
                        <input type="file" name="foto"  accept='image/*' />
                    </td>
                </tr>
            </table>
            <div>
                <input type="submit" value="voeg toe">
                <input type="reset" value="reset">
            </div>
        </form>
        <br id ="breaker">
    </section>
<?php include 'includes/footer.php';

