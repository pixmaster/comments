<?

$login = InitialVar('login');
$pwd_post = md5(InitialVar('pwd'));


$Pwd = $db->GetValByFName("SELECT Pwd FROM Users WHERE Login='$login'","Pwd");

if ($pwd_post == $Pwd)
 {
  SetSendVar("result","1");
 }
else
 {
  SetSendVar("result","0");
 }


?>