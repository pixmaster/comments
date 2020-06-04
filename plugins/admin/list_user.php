<?
include(dirname(__FILE__)."/security_admin.php");

$tmp_array = array();

$query = "SELECT *
            FROM Users";

if ($result = $db->query_exec($query))
 {
  if (mysql_num_rows($result) > 0)
   {
    while ($row = mysql_fetch_assoc($result))
     {
      $tmp_array[] = GetAJAXArrayByDBRow($row);
     }
   }
 }

SetSendVar("user_list","[".implode(",",$tmp_array)."]");

?>