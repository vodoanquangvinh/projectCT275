<?php

include '../src/connect.php';

session_start();
session_unset();
session_destroy();

header('location:../public/index_admin.php');

?>