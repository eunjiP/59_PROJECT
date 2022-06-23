<?php
    include_once "../db/db_store.php";
    session_start();
    $login = $_SESSION['login_store'];
    $store_email = $login['store_email'];    
    $intro = $_POST["store_intro"];
    
    $sql = 
    "   UPDATE t_store
        SET store_info ='$intro'
        WHERE store_email = '$store_email';
    ";

    $conn = get_conn();
    $result = mysqli_query($conn, $sql);   
    
    mysqli_close($conn);    

    header("location: store_main.php");
    return $result;

    
    


