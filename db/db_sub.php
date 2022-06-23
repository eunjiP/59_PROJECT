<?php
include_once('db/db.php');
function search_sub_for_user(&$param)
{
    $user_num = $param['user_num'];
    $sql =
        "   SELECT A.*, B.menu_nm, B.menu_photo , C.store_nm
            FROM t_sub as A
            INNER JOIN t_menu as B
            ON A.menu_num = B.menu_num
            INNER JOIN t_store as C
            On A.store_num = C.store_num
            WHERE user_num = ${user_num}
            ORDER BY A.pay_date
        ";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}

function search_now_reservation_for_user(&$param)
{
    $user_num = $param['user_num'];
    $sql =
        "   SELECT A.*, B.user_num 
            FROM t_usedsub as A
            INNER JOIN t_sub as B
            ON A.sub_num = B.sub_num
            WHERE B.user_num = ${user_num}
        ";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}

function search_now_reservation_for_store(&$param)
{
    $store_num = $param['store_num'];
    $sql =
        "   SELECT A.*, B.store_num
            FROM t_usedsub as A
            INNER JOIN t_sub as B
            ON A.sub_num = B.sub_num
            WHERE B.store_num = $store_num
            ORDER BY used_at
        ";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}


function insert_usedsub(&$param)
{
    $sub_num = $param['sub_num'];
    $reservation_date = $param['reservation_date'];
    $remaining_count = $param['remaining_count'];

    if ($remaining_count <= 0) {
        return 0;
    }
    $sql =
        "   INSERT INTO t_usedsub
            (sub_num, reservation_date)
            VALUES
            ('$sub_num', '$reservation_date')
        ";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}

function change_cd_sub_status(&$param)
{
    $sub_num = $param['sub_num'];
    $used_at = $param['used_at'];

    $sql =
        "   UPDATE t_usedsub
            SET cd_sub_status = 1
            WHERE sub_num='$sub_num' AND used_at = '$used_at'
        ";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}
