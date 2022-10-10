<!-- footer section starts  -->

<section class="footer">

    <div class="share">
        <?php
        $profile = new ProfileContr;
        $urls = $profile->viewUrls();

        foreach ($urls as $url) { ?>
            <a href="<?php echo $url['facebook'] ?>" class="fab fa-facebook-f"></a>
            <a href="<?php echo $url['twitter'] ?>" class="fab fa-twitter"></a>
            <a href="<?php echo $url['instagram'] ?>" class="fab fa-instagram"></a>
            <a href="https://wa.me/<?php echo $url['whatsapp'] ?>" class="fab fa-whatsapp"></a>
        <?php } ?>
    </div>

    <div class="links">
        <a href="../index.php">home</a>
        <a href="warehouses.php">Warehouses</a>
        <a href="landlord_terms.php">Add Warehouse</a>
        <a href="account.php">Account</a>
        <a href="about.php">About</a>
    </div>

    <div class="credit"><span>Warehouse Information Management System</span> | all rights reserved</div>

</section>

<!-- footer section ends -->