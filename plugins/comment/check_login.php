<?

$query = "SELECT *
            FROM Users
           WHERE Login='".InitialVar('login')."'";

if ($result = $db->query_exec($query))
 {
  if (mysql_num_rows($result) > 0)
   {
    SetSendVar("result","1");
   }
  else
   {
    SetSendVar("result","0");
   }
 }
else
 {
  SetSendVar("result","2");
 }


?>