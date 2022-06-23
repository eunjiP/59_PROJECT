<?php
    //login.php에서 넘어오는 값을 적절한 변수에 담는다
    // 변수의 값을 출력

    include_once "../db/db_store.php";

    $store_email = $_POST["store_email"];
    $store_pw = $_POST["store_pw"];

    //echo $store_email;
    //echo $store_pw;

    $param = [
        "store_email" => $store_email
    ];

    $result = login_store($param);
    if(empty($result)) {
        echo "해당하는 아이디가 없음";
        die;
    }

    // echo "i_user : " , $result["i_user"], "<br>";
    // echo "pw : ", $result["store_pw"], "<br>";
    
    // 비밀번호가 맞으면 "list.php로 주소이동"
    // 다르면 "login.php로 주소이동"
    
    
    print_r($result);
    
    
    if($result["store_pw"] === $store_pw)
    {   
        session_start();    
        $_SESSION["login_user"] = $result;
        header("location: store_main.php");
    }
    else
    {
        header("location: store_login.php");        
    }
   