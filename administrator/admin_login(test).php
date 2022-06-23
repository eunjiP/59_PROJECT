<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>로그인</title>
    <link rel="stylesheet" href="../css/screens/email.css">
</head>
<body>
    <h1>사장님 회원가입</h1>
    <div>오구 아이디로 모든</div>
    <div>관리자 서비스를 이용할 수 있습니다.</div>
    <form action="create_account.php">
        <button type="submit" href="create_account.php" >회원가입</button>
    </form>
    <h1>로그인</h1>
    <div>이메일로 로그인</div>
    <form action="admin_login_proc.php" method="post">
    <div class="login_email" ><input  type="email" name="store_email" placeholder="이메일" autocomplete="on"></div>    
    <div class="login_pw" ><input type="password" name="store_pw" placeholder="비밀번호"></div>    
    <div><button type="submit" >로그인</button></div>
    </form>
    
</body>
</html>