<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/*
Tested working with PHP5.4 and above (including PHP 7 )

 */
require_once './vendor/autoload.php';

$ser="localhost";
$user ="root";
$pwd="";
$db="info1";

use FormGuide\Handlx\FormHandler;


$pp = new FormHandler(); 

$validator = $pp->getValidator();
$validator->fields(['name','email'])->areRequired()->maxLength(50);
$validator->field('email')->isEmail();
$validator->field('comments')->maxLength(6000);

$con=mysqli_connect($ser,$user,$pwd,$db) or die ("connection failed")
;
echo "   success";

//$name1 = $_POST['name'];  
//$email1 = $_POST['email'];
//$message1 = $_POST['message'];

mysqli_select_db($con,"info1");
echo "\n DB is seleted as Test  successfully";

$sql= "INSERT INTO myuser(name,email,comments) VALUES	('$_POST[name]','$_POST[email]','$_POST[comments]')";



if ($con->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}


echo "\n Data inserted. Thank You!";

mysqli_close($con);


$pp->sendEmailTo('visvarthana@gmail.com'); // ← Your email here

echo $pp->process($_POST);