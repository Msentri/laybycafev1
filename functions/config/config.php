<?php
/**
 * Created by PhpStorm.
 * User: Sakhile
 * Date: 2016/09/05
 * Time: 11:17 AM
 */

include 'keygen.php';


include 'security.php';

$verCode = rand(10000,99999);
$code = md5($verCode);

$db = new MysqliDb (Array (
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'db'=> 'laybycafe',
    'port' => 3306,
    'prefix' => '',
    'charset' => 'utf8'));


// For multiple rows//

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "laybycafe";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

require_once('functions/pdo-mysqli-pagination/src/pagination.php');


/*
 * Connect to the database (Replacing the XXXXXX's with the correct details)
 */
try
{
    $dbh = new PDO('mysql:host=localhost;dbname=laybycafe', 'root', '');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    print "Error!: " . $e->getMessage() . "<br/>";
}

$DB_host = "localhost";
$DB_user = "root";
$DB_pass = "";
$DB_name = "laybycafe";

$MySQLiconn = new MySQLi($DB_host,$DB_user,$DB_pass,$DB_name);

if($MySQLiconn->connect_errno)
{
    die("ERROR : -> ".$MySQLiconn->connect_error);
}


$factory = new CalendR\Calendar;