<?php

    include_once "../db/db_store.php";

    session_start();
    $login = $_SESSION['login_store'];
    $store_email = $login['store_email'];   


    
    
    $result = store_time_insert($login);
    if($result){
        header("location: store_main.php");
    }
    