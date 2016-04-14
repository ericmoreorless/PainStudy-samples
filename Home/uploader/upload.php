<?php


require_once('../Classes/Globals.php');


if(isset($_POST['upload']))
{

$placeToStoreFiles = '../media/';
$contenttype = $_FILES['userfile']['type'];
$tmpName  = $_FILES['userfile']['tmp_name'];
$size = $_FILES['userfile']['size'];
$name=$_POST['name'];

var_dump($size);

$path = $placeToStoreFiles.$name.'.wav';

if(move_uploaded_file($tmpName, $path)){

	echo 'success: '.$path;

}else{

	echo 'its fucked';

}

$query = "INSERT INTO AudioFiles (`path`,`name`,`contenttype`, `size`)
   VALUES ('" .  str_replace('../media/', '', $path) . "','$name','$contenttype','$size')";

   




$con  = Globals::getConnection();



$res = mysqli_query($con, $query);




if (!$res) {
    ('Invalid query: ' . mysql_error());

}




}
?>
