<?php 
session_start();
ini_set('max_execution_time', 20);
require_once 'classes/jsonRPCClient.php';
//require_once 'classes/recaptcha.php';
require_once 'config.php';
$uslinkf = $_SESSION["uslink"];
 

include("top.php");

include_once("alert.php");



include_once("game1.php");
include_once("sessao.php");



include_once("out.php");



?>