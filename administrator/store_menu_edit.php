<?php

include_once "../db/db_store.php";
include_once "function.php";


// 포스트값 받아오기
$category = $_POST['menu_category'];
$menu_nm = $_POST['menu_nm'];
$menu_intro = $_POST['menu_intro'];
$sales_count = $_POST['sales_count'];
$price = $_POST['price'];
$sub_price = $_POST['sub_price'];
$menu_cd = $_POST['menu_cd'];
$menu_num = $_POST['menu_num'];




// 로그인때만 세션에서 이메일값 받아오기, 수정필요
session_start();
$login = $_SESSION['login_store'];
if (!isset($login)) {
    header("location: store_login.php");
}

$store_num = $login['store_num'];
$store_nm = $login['store_nm'];
print $menu_num;



//이미지 경로설정
define("PROFILE_PATH", "../img/store/$store_nm/Menu_img/");




var_dump($_FILES);
if ($_FILES["menu_img_edit"]["name"] === "") {
    echo "이미지 없음";
    exit;
}




function gen_uuid_v4()
{
    return sprintf(
        '%04x%04x-%04x-%04x-%04x-%04x%04x%04x' // printf - % 자리에 변수들을 넣어준다.
        ,
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff)
    );
}
$img_name = $_FILES["menu_img_edit"]["name"]; // $_FILES["포스트하는 코드의 name 값"]["name=파일이름"]
$last_index = mb_strrpos($img_name, ".");
$ext = mb_substr($img_name, $last_index); // substr(자르고 싶은 문자열, 시작위치, 입력하지 않으면 나머지 전부-입력하면 그자리부터 입력한 자릿수까지)

$target_filenm = gen_uuid_v4() . $ext;
$target_full_path = PROFILE_PATH . "$menu_num";
// is_dir, file_exists 폴더 및 파일 있는지 확인할때, 폴더확인은 is_dir이 파일 확인은 file_exists가 낫다
if (!is_dir($target_full_path)) {
    mkdir($target_full_path, 0777, true);
}
// mkdir 폴더 만들기, (위치, 권한, true일 경우 만들 폴더가 여러개라도 만들어짐)
$tmp_img = $_FILES['menu_img_edit']['tmp_name'];

$imageUpload = move_uploaded_file($tmp_img, $target_full_path . "/" . $target_filenm); //파일이동 성공시 true, 실패시 false
print "<br>" . $target_full_path . "/" . $target_filenm;
// $imageUpload = move_uploaded_file($tmp_img, '../img/store/한식집/Menu_img/1/' . $target_filenm); //파일이동 성공시 true, 실패시 false
$login["menu_photo"] = $target_filenm;
if ($imageUpload) { //업로드 성공!
    print '이미지 생성 성공';
    // 이전에 등록된 프사가 있으면 삭제!      
    // if($login["menu_photo"]) {
    //     $saved_img = $target_full_path . "/" . $login["menu_photo"];
    //     if(file_exists($saved_img)) {
    //         unlink($saved_img);
    //     }
    // }







} else { //업로드 실패!
    echo "업로드 실패";
}
//DB에 저장!
$param = [
    "menu_photo" => $target_filenm,
    "store_num" => $login["store_num"],
    "menu_category" => $category,
    "menu_nm" =>  $menu_nm,
    "menu_intro" => $menu_intro,
    "sales_count" => $sales_count,
    "price" => $price,
    "sub_price" => $sub_price,
    "menu_cd" => $menu_cd,
    "menu_num" => $menu_num

];



$result = store_menu_edit($param);
if ($result) {
    echo "업로드 성공!";
    Header("Location: store_main.php");
} else {
    echo "업로드 실패!";
}
