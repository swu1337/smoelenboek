        <nav>
            <ul>
                <li>Contactgegevens
                    <ul>
                        <li><a href="?control=leerling&action=bekijken">Bekijken</a></li>
                        <li><a href="?control=leerling&action=wijzigen">Wijzigen</a></li>
                    </ul>
                </li>
                <li>Wachtwoord
                    <ul>
                        <li><a href="?control=leerling&action=wwwijzigen">Wijzigen</a></li>
                    </ul>
                </li>
                <li>Klas
                    <ul>
                        <?php foreach($klassen as $klas): ?>
                        <li><a href="?control=leerling&action=klasdetails&kid=<?= $klas->getId();?>"><?= $klas->getNaam(); ?><?= $klas->getId() === $gebruiker->getKlas_id() ? '(mijn klas)' : '';?> </a></li>
                        <?php endforeach;?>
                    </ul>
                </li>
                <li>
                    <a href="?control=leerling&action=uitloggen">Uitloggen</a>
                </li>
            </ul>
        </nav>
