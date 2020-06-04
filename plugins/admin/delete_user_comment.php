<?
include(dirname(__FILE__)."/security_admin.php");

$UserID = InitialVar('UserID');

$result = $db->query_exec("DELETE FROM Users WHERE UserID='$UserID'");

$query = "SELECT Pic1,Pic2,Pic3,CommentID FROM Comments WHERE UserID='$UserID'";

if ($result = $db->query_exec($query))
 {
  if (mysql_num_rows($result) > 0)
   {
    while($row = mysql_fetch_assoc($result))
     {
      for($i=1;$i<4;$i++)
       {
        if (!empty($row['Pic'.$i]) && file_exists(UPLOAD_DIR."/".$row['Pic'.$i]))
         {
          unlink(UPLOAD_DIR."/".$row['Pic'.$i]);
          unlink(UPLOAD_DIR."/thumb_".$row['Pic'.$i].".jpg");
         }
       }

      $r = $db->query_exec("DELETE FROM Comments WHERE CommentID='".$row['CommentID']."'");
     }
   }
 }


SetSendVar("result","1");

?>