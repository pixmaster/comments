<?

$id = InitialVar("id");

$tmp_array = array();

$query = "SELECT *,
                 DATE_FORMAT(Comments.CommentDate,'%d-%m-%Y') AS CommentDate,
                 DATE_FORMAT(Comments.CommentDate,'%H:%i') AS CommentTime
            FROM Comments
       LEFT JOIN Users ON (Comments.UserID=Users.UserID)
           WHERE Comments.ProductID='$id' AND Comments.CommentOpen='1'";

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

// set rating

$Rating = 0;
$count  = 0;

$query = "SELECT Rating
            FROM Rating
           WHERE ProductID='$id'";

if ($result = $db->query_exec($query))
 {
  if (mysql_num_rows($result) > 0)
   {
    while ($row = mysql_fetch_assoc($result))
     {
      $Rating += $row['Rating'];
      $count++;
     }

    SetSendVar("Rating",round($Rating/$count,2));
   }
  else
   {
    SetSendVar("Rating",0);
   }
 }




?>