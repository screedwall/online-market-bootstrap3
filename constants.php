<?php

$root = realpath($_SERVER["DOCUMENT_ROOT"]);
session_start();
require_once "$root/rb-mysql.php";

$db_host="localhost";
$db_name="site";
$db_user="root";
$db_pass="mysql";
R::setup( 'mysql:host='.$db_host.';dbname='.$db_name.'',
	    $db_user, $db_pass );
$common=R::findAll('common');
$panel_user="admin";
$panel_pass="12345";
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
$sitename="http://localhost";
$header="$root/header.php";
$footer="$root/footer.php";
$sidebar="$root/sidebar.php";
$script=$sitename."/js/script.js";
$jquery=$sitename."/js/jquery.min.js";
$bootstrap_js=$sitename."/js/bootstrap.js";
$jqueryui_js=$sitename."/js/jquery-ui.js";
$bootstrap_css=$sitename."/css/bootstrap.css";
$bootstrap_theme_css=$sitename."/css/bootstrap-theme.css";
$jqueryui_css=$sitename."/css/jquery-ui.css";
$fontawesome_css=$sitename."/css/fontawesome-all.css";
$style=$sitename."/css/style.css";
$email=$common[1]->email;
$phone=$common[1]->phone;
?>