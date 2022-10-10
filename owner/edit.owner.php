<?php
include "../includes/session.inc.php";
include_once '../includes/classautoloader.inc.php';

function compressedImage($source, $path, $quality)
{
    $info = getimagesize($source);
    if ($info['mime'] == 'image/jpeg')
        $image = imagecreatefromjpeg($source);
    elseif ($info['mime'] == 'image/gif')
        $image = imagecreatefromgif($source);
    elseif ($info['mime'] == 'image/png')
        $image = imagecreatefrompng($source);
    imagejpeg($image, $path, $quality);
}
if (isset($_POST['edit'])) {

    $name = strip_tags($_POST['name']);
    $capacity = strip_tags($_POST['capacity']);
    $location = strip_tags($_POST['district']);
    $area = strip_tags($_POST['area']);
    $price = strip_tags($_POST['price']);

    //object passing data to the "ManageWarehouseContr.class.php" file ----------------------------------------------->
    $upload = new ManageWarehouseContr;
    $st = $upload->editWarehouse($name, $user_id, $capacity, $location, $area, $price, $_FILES['images']['name'][0], $_FILES['images']['name'][1], $_FILES['images']['name'][2], $_FILES['images']['name'][3], $_SESSION['edit_id']);

    //checking if the data has been uploaded -------------------------------------------------------------------------->
    if ($st) {
        foreach ($_FILES['images']['name'] as $key => $val) {

            $filename = $_FILES['images']['name'][$key];
            // Valid extension 
            $valid_ext = array('png', 'jpeg', 'jpg');
            $photoExt1 = @end(explode('.', $filename));

            //GET FILENAME WITHOUT EXTENSION
            $name_no_ext = pathinfo($filename, PATHINFO_FILENAME);
            // explode the image name to get the extension 	 
            $phototest1 = strtolower($photoExt1);
            $new_profle_pic = $name_no_ext . '.' . $phototest1;
            // Location 
            $location = "../uploads/" . $new_profle_pic;
            // file extension 
            $file_extension = pathinfo($location, PATHINFO_EXTENSION);
            $file_extension = strtolower($file_extension);

            // Check extension 
            if (in_array($file_extension, $valid_ext)) {
                // Compress Image 
                compressedImage($_FILES['images']['tmp_name'][$key], $location, 60);
                //Here i am enter the insert code in the step ........ 
            }
        }

        $msg = "Warehouse edited successfully!";
    } else {

        $msg = "Error, failure editing warehouse!";
    }
}
?>
<!Doctype HTML>
<html>

<head>
    <title>Edit Warehouse</title>
    <link rel="stylesheet" href="../assets/css/dashboard-style.css" type="text/css" />
    <!-- font awesome file link  -->
    <link rel="stylesheet" type="text/css" href="../assets/fontawesome-free-5.15.1-web/css/all.css">
    <style>
        :root {
            --main-color: #d3ad7f;
            --black: #13131a;
            --bg: #010103;
            --border: .1rem solid black;
        }

        .colu {
            width: 48%;
        }

        .inputBox2 {
            display: flex;
            align-items: center;
            margin-top: 5px;
            margin-bottom: 5px;
            background: #fff;
            border: var(--border);
        }

        .inputBox2 span {
            color: black;
            font-size: 1.3rem;
            padding: 10px;
        }

        .inputBox2 input {
            width: 100%;
            padding: 10px;
            font-size: 1.3rem;
            color: black;
            border: none;
            text-transform: none;
            background: none;
        }

        .inputBox2 input:hover {
            border: none;
            padding: 10px;
        }

        .btn-stall {
            background-color: black;
            color: white;
            padding: 10px;
            margin-top: 5px;
        }

        .btn-stall:hover {
            background-color: white;
            color: black;
            border: 2px solid black;
            letter-spacing: 2.5px;
        }
    </style>
</head>


<body>
    <!-- header link file -->
    <?php include "header.owner.php" ?>
    <div class="clearfix"></div>
    </div>
    <?php
    if (!empty($msg)) {
        echo "<p class='error_noti'>" . $msg . "</p>";
    } else {
    }
    ?>
    <?php
    $warehouse = new ManageWarehouseContr();
    $row = $warehouse->viewWarehouseDetails($_SESSION['edit_id']);
    ?>
    <div class="contact">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
            <div style="background-color: #fff; padding:10px; border-radius:10%; border:2px solid red; color:red;">
                <p>NOTE! if you edit the property, we will have to verify it again if it was already approved!</p>
            </div>
            <div class="row">
                <div class="colu">
                    <label for="customer" class="form-label">Warehouse Name</label>
                    <div class="inputBox2">
                        <span class="fas fa-warehouse"></span>
                        <input type="text" value="<?php echo $row['name']; ?>" pattern="[a-zA-Z ]+" name="name" required>
                    </div>
                </div>
                <div class="colu">
                    <label for="customer" class="form-label">Capacity in m<sup>2</sup></label>
                    <div class="inputBox2">
                        <span class="fas fa-building"></span>
                        <input type="number" value="<?php echo $row['capacity']; ?>" name="capacity" required>
                    </div>
                </div>
                <div class="colu">
                    <label for="customer" class="form-label">District</label>
                    <div class="inputBox2">
                        <span class="fas fa-tag"></span>
                        <input type="text" value="<?php echo $row['location']; ?>" pattern="[a-zA-Z ]+" name="district" required>
                    </div>
                </div>
                <div class="colu">
                    <label for="customer" class="form-label">Area</label>
                    <div class="inputBox2">
                        <span class="fas fa-tag"></span>
                        <input type="text" value="<?php echo $row['area']; ?>" pattern="[a-zA-Z ]+" name="area" required>
                    </div>
                </div>
                <div class="colu">
                    <label for="customer" class="form-label">Price/m<sup>2</sup></label>
                    <div class="inputBox2">
                        <span class="fas fa-credit-card"></span>
                        <input type="number" value="<?php echo $row['price']; ?>" name="price" required>
                    </div>
                </div>
                <div class="colu">
                    <img src="../uploads/<?php echo $row['image1'] ?>" alt="image 1" width="100px">
                    <img src="../uploads/<?php echo $row['image2'] ?>" alt="image 2" width="100px">
                    <img src="../uploads/<?php echo $row['image3'] ?>" alt="image 3" width="100px">
                    <img src="../uploads/<?php echo $row['image4'] ?>" alt="image 4" width="100px"><br>
                    <label for="customer" class="form-label">Images (Upload 4 Images)</label>
                    <div class="inputBox2">
                        <span class="fas fa-camera"></span>
                        <input type="file" name="images[]" required multiple>
                    </div>
                </div>
                <input type="submit" name="edit" value="Edit Warehouse" class="btn-stall" style="width: 40%;">
            </div>
        </form>
    </div>

    <div class="clearfix"></div>
    <!-- footer link file -->
    <?php include "footer.owner.php" ?>
    </div>


</body>


</html>