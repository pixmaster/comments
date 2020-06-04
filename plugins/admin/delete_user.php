<?
include(dirname(__FILE__)."/security_admin.php");

$UserID = InitialVar('UserID');

$result = $db->query_exec("DELETE FROM Users WHERE UserID='$UserID'");

SetSendVar("result","1");



?>