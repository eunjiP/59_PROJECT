<?php
include_once "../db/db_store.php";

$param = [
    'mon' => "",
    'tue' => "",
    'wed' => "",
    'thu' => "",
    'fri' => "",
    'sat' => "",
    'sun' => ""
];

if(isset($_POST['mon']))
{
    $week_mon = $_POST['mon'];
    $param['mon'] = $week_mon;
}
if(isset($_POST['tue']))
{
    $week_tue = $_POST['tue'];
    $param['tue'] = $week_tue;
}
if(isset($_POST['wed']))
{
    $week_wed = $_POST['wed'];
    $param['wed'] = $week_wed;
}
if(isset($_POST['thu']))
{
    $week_thu = $_POST['thu'];
    $param['thu'] = $week_thu;
}
if(isset($_POST['fri']))
{
    $week_fri = $_POST['fri'];
    $param['fri'] = $week_fri;
}
if(isset($_POST['sat']))
{
    $week_sat = $_POST['sat'];
    $param['sat'] = $week_sat;
}
if(isset($_POST['sun']))
{
    $week_sun = $_POST['sun'];
    $param['sun'] = $week_sun;
}

$result = sales_day($param);
echo $result;

if($result){ header("location: store_main.php");}
