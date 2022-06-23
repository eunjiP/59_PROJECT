<?php

include_once "../db/db_store.php";

session_start();
$login = $_SESSION['login_store'];

$result = store_notice_insert($login);
if($result){
    header("location: store_main.php");
}
