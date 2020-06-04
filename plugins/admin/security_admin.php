<?

define("DEF_USER","admin");
define("DEF_PWD","c4ca4238a0b923820dcc509a6f75849b");

function SendAuthHeader()
 {
  @header("content-type:text/html; charset=windows-1251");
  @header("WWW-authenticate: Basic realm=\"Comment admin\"");
  @header("HTTP/1.0 401 Unauthorized");
  echo  "Введите правильный логин или пароль для доступа на данную страницу";
  exit;
 }

$user = $_SERVER['PHP_AUTH_USER'];
$pwd  = md5($_SERVER['PHP_AUTH_PW']);

unset($_SERVER['PHP_AUTH_USER']);
unset($_SERVER['PHP_AUTH_PW']);

if (isset($user) && !empty($user) && isset($pwd) && !empty($pwd) &&
    Valid_NonZero($user) && Valid_NonZero($pwd) &&
    Valid_String($user)  && Valid_String($pwd) &&
    Valid_Simbol($user)  && Valid_Simbol($pwd))
 {
  if (DEF_USER == $user && DEF_PWD == $pwd)
   {
    unset($user);
    unset($pwd);
   }
  else
   {
    unset($user);
    unset($pwd);

    SendAuthHeader();
   }
 }
else
 {
  unset($user);
  unset($pwd);

  SendAuthHeader();
 }

?>