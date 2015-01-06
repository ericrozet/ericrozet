<?php
//this config files connects to the database
//DB credentials
$db_name = 'eric_sadipity';
$db_user = 'sadipity';
$db_password = 'XVrK5Q69Jv2bxaCy';

//connect to DB
$db = new mysqli( 'localhost', $db_user, $db_password, $db_name );

//handle any errors - checks to see if theres more than zero errors
if( $db->connect_errno > 0 ){

	//stop the page from loading and show a messge instead
	die( 'Unable to connect to Database' );

}

define("SITE_URL",  'http://localhost/ericrozet/sadipity/');
define("SITE_PATH",  'C:/xampp/htdocs/ericrozet/sadipity/');

//error reporting--set the sensitivity of PHP'S error disply
//show all errors except notices (E_ALL & ~E_NOTICE)
//show all errors while developing--not for live site! (E_ALL)
error_reporting ( E_ALL & ~E_NOTICE );
//no close php