<?php
include_once "db.php";

function join_user(&$param) {

$user_mail = $param['user_mail'];
$user_pw = $param['user_pw'];
$nickname = $param['nickname'];
$user_nm = $param['user_nm'];

$sql = "INSERT INTO t_user
(user_mail,user_pw,nickname,user_nm)
value
('$user_mail',password('$user_pw'),'$nickname','$user_nm')
";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}

function id_check(&$param)
{
    $user_mail = $param['user_mail'];

    $sql = "SELECT user_mail 
            from t_user
            where user_mail = '$user_mail' 
    ";
    $conn = get_conn();
    $row = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($row);
    mysqli_close($conn); 
    if(isset($result['user_mail']))
    {
    return true;
    }
    return false;
}

function nkname_check(&$param)
{
    $nickname = $param['nickname'];

    $sql = "SELECT nickname 
            from t_user
            where nickname = '$nickname' 
    ";
    $conn = get_conn();
    $row = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($row);
    mysqli_close($conn); 
    if(isset($result['nickname']))
    {
    return array(false,$result['nickname']);
    }
    return array(true);
}

function login_user(&$param){

        $user_mail = $param['user_mail'];
        $user_pw = $param['user_pw'];

            $sql = "SELECT *
            from t_user 
            where user_mail = '$user_mail' and user_pw = password('$user_pw')
    ";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    mysqli_close($conn);
    if(!empty($row))
    {       session_start();
            $_SESSION['login_user'] = $row;
            $param = [
               'user_num' => $row['user_num']
            ];
            sub_check($param);
    }
    return $row;
}

function sel_user(&$param)
{
    $user_num = $param['user_num'];

    $sql = "SELECT * from t_user where user_num = $user_num
    ";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    mysqli_close($conn);
    if(!empty($row))
    {       session_start();
            $_SESSION['login_user'] = $row;
    }
    return $row;
}

function upd_user_info(&$param)
{
        $user_num = $param['user_num'];
        $user_mail = $param['user_mail'];
        $user_pw = $param['user_pw'];
        $nickname = $param['nickname'];
        $user_nm = $param['user_nm'];

    $sql = "UPDATE t_user
            SET user_mail = '$user_mail',
            user_pw = password('$user_pw'),
            nickname = '$nickname',
            user_nm = '$user_nm'
            WHERE user_num = '$user_num'
    ";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}

function mailCheck($_str)
// 아이디 이메일형식 정규화
{
    if (preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $_str) == false)
    {
        return array(false,"올바른 이메일 주소를 입력해주세요.");
    }
    else
    {
        return array(true);
    }
}

function passwordCheck($_str)
// 비밀번호 정규화
{
    $pw = $_str;
    $num = preg_match('/[0-9]/u', $pw);
    $eng = preg_match('/[a-z]/u', $pw);
    $spe = preg_match("/[\!\@\#\$\%\^\&\*]/u",$pw);
 
    if(strlen($pw) < 10 || strlen($pw) > 30)
    {
        return array(false,"비밀번호는 영문, 숫자, 특수문자를 혼합하여 최소 10자리 ~ 최대 30자리 이내로 입력해주세요.");
        exit;
    }
 
    if(preg_match("/\s/u", $pw) == true)
    {
        return array(false, "비밀번호는 공백없이 입력해주세요.");
        exit;
    }
 
    if( $num == 0 || $eng == 0 || $spe == 0)
    {
        return array(false, "영문, 숫자, 특수문자를 혼합하여 입력해주세요.");
        exit;
    }
 
    return array(true);
}

function user_Hours_of_use(&$param)
{
    $created_at = $param['created_at'];
    $sub_created_at = mb_substr($created_at,0,10);

$firstDate = $sub_created_at;
$secondDate = date("Y-m-d");

$dateDifference = abs(strtotime($secondDate) - strtotime($firstDate));

$years  = floor($dateDifference / (365 * 60 * 60 * 24));
$months = floor(($dateDifference - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
$days   = floor(($dateDifference - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 *24) / (60 * 60 * 24));

echo "${years}" . '년 ' . "${months}" . '월 ' . "${days}" . "일 " ;
}

function all_discount_price(&$param)
{
    $user_num = $param['user_num'];
    
    $sql = "SELECT sum(save_price) from t_sub where user_num = $user_num
    ";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    mysqli_close($conn);
    return $row['sum(save_price)'];
} 

function user_dropout(&$param)
{   
    $user_num = $param['user_num'];
    
    $sql = "DELETE FROM t_user where user_num = $user_num
    ";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}

function user_coupon_count(&$param)
{
    $user_num = $param['user_num'];

    $sql = "SELECT count(coupon_num) as cnt FROM t_coupon WHERE user_num = $user_num AND used_at IS NULL
    ";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    mysqli_close($conn);
    return $row['cnt'];

}

function user_sub_count(&$param)
{
    $user_num = $param['user_num'];
    $day = date("Y-m-d");

    $sql = "SELECT COUNT(sub_num) as cnt FROM t_sub WHERE user_num = $user_num and end_date > '$day'";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    mysqli_close($conn);
    return $row['cnt'];
}

function user_review_count(&$param)
{
    $user_num = $param['user_num'];

    $sql = "SELECT COUNT(not_num) as cnt FROM t_not
            where user_num = '$user_num' 
            and not_read_check = 0
            and not_type = 7
    ";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    mysqli_close($conn);
    return $row['cnt'];
}

// DB 알림 기능

function sub_check(&$param)
{
    $user_num = $param['user_num'];
    $day = date("Y-m-d");
    $beforeDay = date("Y-m-d", strtotime($day." -1 day"));

    $sql = "SELECT store_num, menu_num, end_date FROM t_sub where user_num = $user_num
    ";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    mysqli_close($conn);
    if($row['end_date'] == $beforeDay) {
    $param = [
        'user_num' => $param['user_num'],
        'store_num' => $row['store_num'],
        'menu_num' => $row['menu_num']
    ];
    ins_sub_not($param);
}
}

function ins_sub_not(&$param)
{
    $user_num = $param['user_num'];
    $store_num = $param['store_num'];
    $menu_num = $param['menu_num'];

    $sql_1 = "SELECT store_nm from t_store where store_num = $store_num
    ";
    $sql_2 = "SELECT menu_nm from t_menu where menu_num = $menu_num
    ";
    $conn = get_conn();
    $result_1 = mysqli_query($conn, $sql_1);
    $result_2 = mysqli_query($conn, $sql_2);
    $row_1 = mysqli_fetch_assoc($result_1);
    $row_2 = mysqli_fetch_assoc($result_2);
    $store_nm = $row_1['store_nm'];
    $menu_nm = $row ['menu_nm'];

    $sql_3 = "INSERT INTO t_not
            (user_num,user_nm,store_nm,not_type,not_url)
            value
            ('$user_num','$user_nm','$store_nm','4','store-detail.php?store_num=$store_num')
    ";
    $result_3 = mysqli_query($conn, $sql_3);
    mysqli_close($conn);
    return $result;
}

function upd_read(&$param)
{
    $not_num = $param['not_num'];

    $sql = "UPDATE t_not
    set not_read_check = 1
    where not_num = $not_num";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}

function sel_today(&$param)
{
    $not_num = $param['not_num'];
    
    $sql = "SELECT * FROM t_not
            where not_num = '$not_num'";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    mysqli_close($conn);
    return $row;
}

function check_not(&$param)
{
    $user_num = $param['user_num'];
    
    $sql = "SELECT COUNT(not_num) as cnt FROM t_not
            where user_num = '$user_num'
            and not_read_check = 0";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    mysqli_close($conn);
    return $row['cnt'];
}

function sel_not_today(&$param)
{
    $user_num = $param['user_num'];
    $row_count = $param['row_count'];
    $start_idx = $param['start_idx'];
    
    $sql = "SELECT * FROM t_not
            where user_num = '$user_num' 
            and not_read_check = 0
            order by created_at DESC
            limit $start_idx,$row_count";

    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}

function sel_not_last(&$param)
{
    $user_num = $param['user_num'];
    $day = date("Y-m-d");
    $sql = "SELECT * FROM t_not
            where user_num = '$user_num' 
            and not_read_check = 0
            and left(created_at,10) < '$day'
            order by created_at DESC";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}

function user_review(&$param)
{
    $user_num = $param['user_num'];
    $row_count = $param['row_count'];
    $start_idx = $param['start_idx'];
    
    $sql = "SELECT * FROM t_not
            where user_num = '$user_num' 
            and not_read_check = 0
            and not_type = 7
            order by created_at DESC
            limit $start_idx,$row_count";

    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}