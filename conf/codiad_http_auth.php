<?php
if (!isset($_SESSION['user'])) {
	require_once( COMPONENTS . "/user/class.user.php" );
	$_SESSION['user'] = $_SERVER['PHP_AUTH_USER'];
	$_SESSION['lang'] = 'en';
	$_SESSION['theme'] = 'default';
	$_SESSION['project'] = '/var/www/codiad';
	$User = new User();
	$User->username = $_SERVER['PHP_AUTH_USER'];
	if ($User->CheckDuplicate()) {
		// confusingly, this means the user must be created
		$User->users[] = array( 'username' => $User->username, 'password' => null, 'project' => "" );
		saveJSON( "users.php", $User->users );
	}
}