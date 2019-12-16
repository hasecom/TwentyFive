<?php 
namespace Routes;
require_once(__DIR__.'/routes.php');
use Routes\Routes;
$Routes =new Routes;
$Domain = $_SERVER['HTTP_HOST'] == 'localhost' ? '/TwentyFive' : '';//環境によって外す（独自ドメイン)
$Routes->Action("SaveImage",$Domain.'/request/Image/Save',"ImageController",$_REQUEST);
?>