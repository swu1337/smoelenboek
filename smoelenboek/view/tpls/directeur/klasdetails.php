<?php
include 'includes/header.php';
include 'includes/menu.php';?>
        <section id='content'>
            <h2 class="klas__name">Klas <?= $klas1->getNaam();?> </h2>
            <div class="klas-genoot__container">
                <div class="klas-genoot__mentor-wrapper">
                    <?php if(!empty($mentor)) :?>
                    <img class="klas-genoot__image" src="<?= $mentor->getFoto()?>">
                    <figure class="klas-genoot__name"><?= $mentor->getNaam(); ?></figure>
                <?php else :?>
                    <p>Deze klas heeft momenteel geen mentor. Contact Directeur</p>
                <?php endif;?>
                </div>
                <ul class="klas-genoot__list">
                    <?php foreach($klasgenoten as $klasgenoot): ?>
                    <li class="klas-genoot__list-item">
                        <a class="klas-genoot__link" href="?control=directeur&action=leerlingdetails&lid=<?= $klasgenoot->getId();?>">
                            <img class="klas-genoot__image" src="<?= $klasgenoot->getFoto()?>">
                            <figure class="klas-genoot__name"><?= $klasgenoot->getNaam(); ?></figure>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <br id ="breaker" />
        </section>
<?php include 'includes/footer.php';
