<?php
include 'includes/header.php';
include 'includes/menu.php';?>
        <section id='content'>
            <h2 class="klas__name">Klas <?= $klas1->getNaam();?> </h2>
            <div class="klas-genoot__container">
                <div class="klas-genoot__mentor-wrapper">
                    <img class="klas-genoot__image" src="img/personen/<?= $mentor->getFoto()?>">
                    <figure class="klas-genoot__name"><?= $mentor->getNaam(); ?></figure>
                </div>
                <ul class="klas-genoot__list">
                    <?php foreach($klasgenoten as $klasgenoot): ?>
                    <li class="klas-genoot__list-item">
                        <img class="klas-genoot__image" src="img/personen/<?= $gebruiker->getFoto()?>">
                        <figure class="klas-genoot__name"><?= $klasgenoot->getNaam(); ?></figure>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <br id ="breaker" />
        </section>
<?php include 'includes/footer.php';
