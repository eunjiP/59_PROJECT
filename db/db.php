<?php
// 192.168.0.70
define("URL", "192.168.0.70");
define("USERNAME", "root");
define("PASSWORD", "506greendg@");
define("DB_NAME", "59project");
define("PORT", "3306");

function get_conn()
{
    return mysqli_connect(URL, USERNAME, PASSWORD, DB_NAME, PORT);
}
