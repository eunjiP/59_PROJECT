<?php
include_once '../db/db_store.php';

$sub_num = $_POST['reserve'];
echo $sub_num;
if(accept($sub_num)){
    header('location: store_main.php');
}
