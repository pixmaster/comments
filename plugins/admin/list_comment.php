<?
include(dirname(__FILE__)."/security_admin.php");

$page = InitialVar("p");
$count_records = $db->GetValByFName("SELECT COUNT(CommentID) AS count_rows FROM Comments WHERE Comments.CommentOpen='0'","count_rows");
$count_pages   = ceil($count_records/DEF_COUNT_ROW_PER_PAGE);

if ($page === false) $page = 1;

$tmp_array = array();

$query = "SELECT *,
                 DATE_FORMAT(Comments.CommentDate,'%d-%m-%Y') AS CommentDate,
                 DATE_FORMAT(Comments.CommentDate,'%H:%i') AS CommentTime
            FROM Comments
       LEFT JOIN Users ON (Comments.UserID=Users.UserID)
           WHERE Comments.CommentOpen='0'
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