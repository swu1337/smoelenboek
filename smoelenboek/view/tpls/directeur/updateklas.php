<?php
include 'includes/header.php';
include 'includes/menu.php';?>
    <section id='content'>
        <form  method="post" enctype="multipart/form-data" id="gebruiker_form">
            <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
            <table>
                <caption>Wijzig klas voor school voor ICT</caption>
                <tr>
                    <td>Naam</td>
                    <td>
                        <input type="text" name="klasnaam" placeholder="vul verplicht de voornaam in" required="required" value="<?= $klas->getNaam() ;?>" >
                    </td>
                </tr>
                <tr>
                    <td>Mentor:</td>
                    <td>
                        <select name="mentorvan" required>
                            <?php foreach ($mentors as $mentor) :?>
                                <option value="<?= $mentor->getId() ;?>"  <?= $klas->getMentor_id() == $mentor->getId() ? 'selected' : '';?> ><?= $mentor->getNaam() ;?>
                                </option>
                            <?php endforeach; ?>
                        </select>
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
