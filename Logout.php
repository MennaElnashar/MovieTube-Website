<?php
session_start();
$connection = new mysqli("localhost", "root","","movies");
session_unset();
session_destroy();
header("location:index.php");
exit();
?>