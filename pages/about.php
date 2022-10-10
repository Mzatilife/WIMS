<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <!-- custom css file link  -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- font awesome file link  -->
    <link rel="stylesheet" type="text/css" href="../assets/fontawesome-free-5.15.1-web/css/all.css">

</head>

<body>
    <!-- about section starts  -->

    <?php include "../includes/header.inc.php" ?>
    <section class="about" style="margin-top: 70px">

        <h1 class="heading"> <span>about</span> us </h1>

        <div class="row">

            <div class="image">
                <img src="../assets/images/warehouse.jpg" alt="">
            </div>

            <div class="content">
                <h3>what is Warehouse Information Management System?</h3>
                <?php
                include_once '../includes/classautoloader.inc.php';

                $profile = new ProfileContr;
                $about = $profile->viewAbout();

                foreach ($about as $ab) { ?>
                    <p><?php echo $ab['about'] ?></p>
                <?php } ?>
            </div>

        </div>

    </section>

    <!-- about section ends -->




    <!-- blogs section starts  -->

    <section class="blogs" id="blogs">

        <h1 class="heading"> our <span>Locations</span> </h1>

        <div class="box-container">

            <div class="box">
                <div class="image">
                    <img src="../assets/images/login.jpg" alt="">
                </div>
                <div class="content">
                    <a href="#" class="title">Karonga, Baka</a>
                    <span>Close to Ibrahim Building</span>
                    <?php
                    $address = $profile->viewAddress();

                    foreach ($address as $add) {
                    ?>
                        <address>
                            <p>
                                <?php echo $add['company_name'] . "<br> P. O. Box " . $add['postal_box'] . "<br>" . $add['district'] ?>
                            </p>
                        </address>
                    <?php } ?>
                </div>
            </div>

            <div class="box">
                <div class="image">
                    <img src="../assets/images/login.jpg" alt="">
                </div>
                <div class="content">
                    <a href="#" class="title">Lilongwe, Area 3</a>
                    <span>Close to Ibrahim Building</span>
                    <?php
                    $address = $profile->viewAddress();

                    foreach ($address as $add) {
                    ?>
                        <address>
                            <p>
                                <?php echo $add['company_name'] . "<br> P. O. Box " . $add['postal_box'] . "<br>" . $add['district'] ?>
                            </p>
                        </address>
                    <?php } ?>
                </div>
            </div>

            <div class="box">
                <div class="image">
                    <img src="../assets/images/login.jpg" alt="">
                </div>
                <div class="content">
                    <a href="#" class="title">Blantyre, Limbe</a>
                    <span>Close to Ibrahim Building</span>
                    <?php
                    $address = $profile->viewAddress();

                    foreach ($address as $add) {
                    ?>
                        <address>
                            <p>
                                <?php echo $add['company_name'] . "<br> P. O. Box " . $add['postal_box'] . "<br>" . $add['district'] ?>
                            </p>
                        </address>
                    <?php } ?>
                </div>
            </div>

        </div>

    </section>

    <!-- blogs section ends -->

    <?php include "../includes/footer.inc.php" ?>
    <!-- custom js file link  -->
    <script src="../assets/js/script.js"></script>

</body>

</html>