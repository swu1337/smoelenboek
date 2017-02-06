        <nav>
            <ul>
                <li>Contactgegevens
                    <ul>
                        <li><a href="?control=docent&action=bekijken">Bekijken</a></li>
                        <li><a href="?control=docent&action=wijzigen">Wijzigen</a></li>
                    </ul>
                </li>
                <li>Wachtwoord
                    <ul>
                        <li><a href="?control=docent&action=wwwijzigen">Wijzigen</a></li>
                    </ul>
                </li>
                <li>Klas
                    <ul>
                        <?php foreach($klassen as $klas): ?>
                            <li><a href="?control=docent&action=klasdetails&kid=<?= $klas->getId();?>"><?= $klas->getMentor_id() === $gebruiker->getId() ? $klas->getNaam() . ' (Mentor)' : $klas->getNaam(); ?></a></li>
                        <?php endforeach;?>
                    </ul>
                </li>
                <li>
                    <a href="?control=docent&action=uitloggen">Uitloggen</a>
                </li>
            </ul>
        </nav>
