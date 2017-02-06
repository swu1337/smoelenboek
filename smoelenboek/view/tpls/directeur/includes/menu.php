        <nav>
            <ul>
                <li>Contactgegevens
                    <ul>
                        <li><a href="?control=directeur&action=bekijken">Bekijken</a></li>
                        <li><a href="?control=directeur&action=wijzigen">Wijzigen</a></li>
                    </ul>
                </li>
                <li>Wachtwoord
                    <ul>
                        <li><a href="?control=directeur&action=wwwijzigen">Wijzigen</a></li>
                    </ul>
                </li>
                <li>Beheer
                    <ul>
                        <li><a href="?control=directeur&action=docentbeheer">Docent</a></li>
                        <li><a href="?control=directeur&action=leerlingbeheer">Leerling</a></li>
                        <li><a href="?control=directeur&action=klasbeheer">Klas</a></li>
                    </ul>
                </li>
                <li>Klas
                    <ul>
                        <?php foreach($klassen as $k): ?>
                            <li><a href="?control=directeur&action=klasdetails&kid=<?= $k->getId();?>"><?= $k->getMentor_id() === $gebruiker->getId() ? $k->getNaam() . ' (Mentor)' : $k->getNaam(); ?></a></li>
                        <?php unset($k); endforeach; ?>
                    </ul>
                </li>
                <li>
                    <a href="?control=directeur&action=uitloggen">Uitloggen</a>
                </li>
            </ul>
        </nav>
