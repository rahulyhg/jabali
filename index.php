<?php
/**
* @package Jabali Framework
* @subpackage Home
* @link https://docs.mauko.co.ke/jabali/home
* @author Mauko Maunde
* @version 0.17.06
**/
date_default_timezone_set( "Africa/Nairobi" );
$dbfile = 'inc/config.php';
if ( !file_exists( $dbfile) ) {
  header( "Location: ./setup.php" );
}

$year = date( "Y" );
$month = date( "m" );
$day = date( "d" );
$directory = "uploads/$year/$month/$day/";

if ( !is_dir( $directory) ) {
  mkdir( $directory, 755, true );
}

include 'inc/config.php';
include 'inc/jabali.php';
connectDb();

include 'inc/classes/Actions.php';
use Jabali\classes\Actions;
$action = new Jabali\_hActions;
$action -> connectDB();

if ( isset( $_POST['login'] ) && $_POST['user'] != "" && $_POST['password'] != "" ) {
  call_user_func_array(array($action, 'loginUser'), array());
}

if ( isset( $_POST['create'] ) ) {
  call_user_func_array(array($action, 'registerUser'), array());
}

if ( isset( $_POST['reset'] ) && $_POST['h_password'] !== "" ) {
  call_user_func_array(array($action, 'resetPass'), array());
}

$url = $_SERVER['REQUEST_URI'];

if ( is_localhost() ) { 
	$url = ltrim( $url, '/'.basename ( __DIR__ ) );
} else { 
	$url = $_SERVER['REQUEST_URI'] . '/'; 
}

$elements = explode('/', $url );
$match = $elements[0];

include 'header.php';
if( empty( $match ) || $match == "?logout" ) {
	call_user_func_array( array( $action, 'home' ), array() );
} else switch ( $match ) {
	case "signin":
		call_user_func_array( array( $action, 'login' ), array( $elements[1] ) );
		break;
	case "signup":
		call_user_func_array( array( $action, 'register' ), array( $elements[1] ) );
		break;
	case "reset":
		call_user_func_array( array( $action, 'reset' ), array( $elements[1] ) );
		break;
	case "forgot":
		call_user_func_array( array( $action, 'forgot' ), array( $elements[1] ) );
		break;
	case "posts":
		call_user_func_array( array( $action, 'blog' ), array( ) );
		break;
	case "categories":
		call_user_func_array( array( $action, 'categories' ), array( $elements[1] ) );
		break;
	case "tags":
		call_user_func_array( array( $action, 'topic' ), array( $elements[1] ) );
		break;
	case "users":
		call_user_func_array( array( $action, 'users' ), array( $elements[1] ) );
		break;
	default:
		call_user_func_array( array( $action, 'fetchPosts' ), array( $match ) );
}

connectDb();
include 'footer.php';