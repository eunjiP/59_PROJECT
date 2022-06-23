<?php

include_once "../db/db_store.php";
$a = menu_num_load();
print_r($a) ;
foreach($a as $b);
print $b['MAX(menu_num)'];

