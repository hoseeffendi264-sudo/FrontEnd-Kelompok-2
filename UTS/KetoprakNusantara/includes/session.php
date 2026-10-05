<?php
ob_start();
session_start();
if (isset($_SESSION["admin"])) {
    header("location:menuutamaowner.php");
    $login = true;
} elseif (isset($_SESSION["cust"])) {
    $login = true;
} else {
    //$login = false;
    $login = true;
}
?>