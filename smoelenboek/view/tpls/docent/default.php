<?php
include 'includes/header.php';
include 'includes/menu.php';?>
        <section id='content'>
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
                        <img class="klas-genoot__image" src="<?= $klasgenoot->getFoto()?>">
                        <figure class="klas-genoot__name"><?= $klasgenoot->getNaam(); ?></figure>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <br id ="breaker" />
        </section>
<?php include 'includes/footer.php';
