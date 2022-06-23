<?php
include_once 'db.php';

function ins_menu_review(&$param)
{
  $store_num  = $param['store_num'];
  $user_num = $param['user_num'];
  $ctnt = $param['ctnt'];
  $star_rating = $param['star_rating'];

  $conn = get_conn();
  $sql =
    "INSERT INTO t_review 
    (store_num, user_num, ctnt, star_rating) 
    VALUES 
    ($store_num,$user_num,'${ctnt}', $star_rating)";

  $result = mysqli_query($conn, $sql);
  mysqli_close($conn);

  return $result;
}
