<?php
if (isset($_GET['dis'])) {
$user->editStatus($_GET['dis'], 0);
}elseif(isset($_GET['en'])){
$user->editStatus($_GET['en'], 1);
}elseif(isset($_GET['del'])){
$user->deleteUser($_GET['del']);
}
 ?>