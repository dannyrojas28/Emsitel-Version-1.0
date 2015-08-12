<?php
session_start();
if(empty($_SESSION['login'])){
    header('location:../../index.php');
}else{
header('location:../../inicio.php');
}
    ?>