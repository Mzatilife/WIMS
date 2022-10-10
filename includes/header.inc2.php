<!-- header section starts  -->

<?php
if (isset($_POST['search'])) {
    $_SESSION['search_word'] = $_POST['word'];
    header("location: pages/searchresults.php");
}
?>

<header class="header">

    <a href="#" class="logo">
        <!-- <img src="images/logo.png" alt=""> -->
        <h1 class="logo-word">WIMS</h1>
    </a>

    <nav class="navbar">
        <a href="#">home</a>
        <a href="pages/warehouses.php">Warehouses</a>
        <a href="pages/landlord_terms.php">Add Warehouse</a>
        <a href="pages/account.php">Account</a>
        <a href="pages/about.php">About</a>
    </nav>

    <div class="icons">
        <div class="fa fa-search" id="search-btn"></div>
        <div class="fa fa-bars" id="menu-btn"></div>
    </div>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" style="position: absolute; top:115%; right: 7%;">
        <div class="search-form">
            <input type="search" name="word" id="search-box" placeholder="search here...">
            <button type="submit" name="search" style="background-color: white;"><label for="search-box" class="fas fa-search"></label></button>
        </div>
    </form>

</header>

<!-- header section ends -->