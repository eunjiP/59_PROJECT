<?php 

include_once "../db/db_store.php";

$we = "";
$wp = "";

if(isset($_POST['store_email']))
{
$store_email = $_POST['store_email'];
$store_pw = $_POST['store_pw'];

        if (!$store_email) {
        $we = "이메일을 입력해주세요.";
    }
        if (!$store_pw) {
        $wp = "비밀번호를 입력해주세요.";
    }
        else {        
 
        }
        }
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="wclassth=device-wclassth, initial-scale=1.0">
    <title>이메일로그인</title>
    <script src="https://kit.fontawesome.com/8eb4f0837a.js" crossorigin="anonymous" defer></script>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <!-- 전체사이즈 -->
    <div class="container">
        
    <h1>사장님 회원가입</h1>
    <div>오구 아이디로 모든</div>
    <div>관리자 서비스를 이용할 수 있습니다.</div>
    <form action="create_account.php">
        <button type="submit" href="create_account.php" >회원가입</button>
    </form>
        <form action="store_login_after.php" method="post">
        <div>
        <label class="login_email">   
            <input type="text" name="store_email" placeholder="이메일 주소 입력" >
        </label>
        <p class="warning_massage"><?=$we?></p>
        </div>
        <div>
        <label class="login_pw">   
            <input type="text" name="store_pw" placeholder="비밀번호 입력" >
        </label>
        <p class="warning_massage"><?=$wp?></p>
        </div>
                <div class="login_insert">
            <button type="submit"> 로그인 </button>
        </div> 
        </form>
        <div class="small_flex_box">
            <a href="" class="small_text">이메일 찾기</a>
            <a href="" class="small_text">비밀번호 찾기</a>
        </div>
        </main>
        
        </div>
    </div>
</body>

</html>