<?php

include_once "db.php";


// function id_check(&$param)
// {
//     $store_email = $param['store_email'];

//     $sql = "SELECT store_email 
//             from t_store
//             where store_email = '$store_email' 
//     ";
//     $conn = get_conn();
//     $row = mysqli_query($conn, $sql);
//     $result = mysqli_fetch_assoc($row);
//     mysqli_close($conn); 
//     if(isset($result['store_email']))
//     {
//     return true;
//     }
//     return false;
// }

// function mailCheck($_str)
// // 아이디 이메일형식 정규화
// {
//     if (preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $_str) == false)
//     {
//         return array(false,"올바른 이메일 주소를 입력해주세요.");
//     }
//     else
//     {
//         return array(true);
//     }
// }

// function passwordCheck($_str)
// // 비밀번호 정규화
// {
//     $pw = $_str;
//     $num = preg_match('/[0-9]/u', $pw);
//     $eng = preg_match('/[a-z]/u', $pw);
//     $spe = preg_match("/[\!\@\#\$\%\^\&\*]/u",$pw);
 
//     if(strlen($pw) < 10 || strlen($pw) > 30)
//     {
//         return array(false,"비밀번호는 영문, 숫자, 특수문자를 혼합하여 최소 10자리 ~ 최대 30자리 이내로 입력해주세요.");
//         exit;
//     }
 
//     if(preg_match("/\s/u", $pw) == true)
//     {
//         return array(false, "비밀번호는 공백없이 입력해주세요.");
//         exit;
//     }
 
//     if( $num == 0 || $eng == 0 || $spe == 0)
//     {
//         return array(false, "영문, 숫자, 특수문자를 혼합하여 입력해주세요.");
//         exit;
//     }
 
//     return array(true);
// }



function owner_login(&$param){

    $store_email = $param['store_email'];
    $store_pw = $param['store_pw'];

        $sql = 
            "   SELECT *
                from t_store                
                where store_email = '$store_email'
        ";

//password(해야함)
$conn = get_conn();
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
mysqli_close($conn);

return $row;
}