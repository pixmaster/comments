<?
include(dirname(__FILE__)."/security_admin.php");

$CommentID = InitialVar('CommentID');

$result = $db->query_exec("UPDATE Comments SET CommentOpen='1' WHERE CommentID='$CommentID'");

SetSendVar("result",($result?"1":"0"));


?>