<?php
//this config files connects to the database
//DB credentials
$db_name = 'eric_phpblog';
$db_user = 'eric_bloguser';
$db_password = 'VTETjmDBpYBpBTGQ';

//connect to DB
$db = new mysqli( 'localhost', $db_user, $db_password, $db_name );

//handle any errors - checks to see if theres more than zero errors
if( $db->connect_errno > 0 ){

	//stop the page from loading and show a messge instead
	die( 'Unable to connect to Database' );

}

//Define file Path Constants - make constants all caps to distinguish between variables
//on Xampp, DOCUMENT_ROOT takes you to c:/xampp/htdocs
define("SITE_PATH", 'http://localhost/ericrozet/blog/');

//error reporting--set the sensitivity of PHP'S error disply
//show all errors except notices (E_ALL & ~E_NOTICE)
//show all errors while developing--not for live site! (E_ALL)
error_reporting ( E_ALL );
//no close php