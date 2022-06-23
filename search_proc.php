<?php    
    include_once "db/db_list.php";

    $search_txt = $_POST['search_txt'];
    //공백 제거 preg_replace함수
    $search_txt_re = preg_replace('/\s+/', "",  $search_txt);
    if($search_txt_re != "") {
        $param = [
            'search_txt' => $search_txt
        ];
        $result = ins_search($param);
        header("Location: search_list.php?search_txt={$search_txt_re}");
    } else {
        $errorms = "빈칸을 검색하셨습니다!";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv='refresh' content="2;url=http://localhost/59-project/search.php"> 
    <title>search - ERROR</title>
    <style>
        h1 {color: red;}
        h2 {color: blue;}
    </style>
</head>
<body>
    <h1><?=$errorms?></h1>
    <h2>이 화면은 2초 뒤에 자동으로 이전 페이지로 이동합니다^^</h2>
</body>
</html>
