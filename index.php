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
include 'inc/classes/class.actions.php';
global $action;
$action = new _hActions;
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


/**
* @package Jabali Framework
* @subpackage Home
* @link https://docs.mauko.co.ke/jabali/home
* @author Mauko Maunde
* @version 0.17.06
**/
include 'inc/jabali.php';
connectDb();

$url = $_SERVER['REQUEST_URI'];

if ( is_localhost() ) { 
	$url = ltrim( $url, '/'.dirname(__FILE__) );
} else { 
	$url = $_SERVER['REQUEST_URI'] . '/'; 
}

$elements = split('/', $url );

if( empty( $elements[0] ) ) {
	call_user_func_array( array( $action, 'home' ), array() );
} else {

	if ( $elements[0] == 'login' ) {
		call_user_func_array(array( $action, 'login' ), array() ); 
	} elseif ( $elements[0] == 'reset' ) { 
		call_user_func_array(array( $action, 'reset' ), array() );
	} elseif ( $elements[0] == 'register' ) {
		call_user_func_array(array( $action, 'register' ), array() );
	} elseif ( $elements[0] == 'forgot' ) {
		call_user_func_array(array( $action, 'forgot' ), array() );
	} elseif ( $elements[0] == 'blog' ) {
		call_user_func_array(array( $action, 'blog' ), array() );
	} elseif ( $elements[0] == 'category') {
		call_user_func_array( array($action, 'category' ), array( $elements[1] ) );
	} elseif ( $elements[0] == 'tag') {
		call_user_func_array( array($action, 'tags' ), array( $elements[1] ) );
	} else {
		call_user_func_array( array($action, 'fetchPosts' ), array( $one ) );
	}
}

include 'footer.php';