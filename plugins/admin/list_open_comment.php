<?
include(dirname(__FILE__)."/security_admin.php");

$tmp_array = array();

$query = "SELECT *,
                 DATE_FORMAT(Comments.CommentDate,'%d-%m-%Y') AS CommentDate,
                 DATE_FORMAT(Comments.CommentDate,'%H:%i') AS CommentTime
            FROM Comments
       LEFT JOIN Users ON (Comments.UserID=Users.UserID)
           WHERE Comments.CommentOpen='1'
        ORDER BY ProductID";

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

SetSendVar("comment_list","[".implode(",",$tmp_array)."]");

?>