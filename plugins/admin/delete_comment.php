<?
include(dirname(__FILE__)."/security_admin.php");

$CommentID = InitialVar('CommentID');

$query = "SELECT Pic1,Pic2,Pic3 FROM Comments WHERE CommentID='$CommentID'";

if ($result = $db->query_exec($query))
 {
  if (mysql_num_rows($result) > 0)
   {
    $row = mysql_fetch_assoc($result);

    for($i=1;$i<4;$i++)
     {
      if (!empty($row['Pic'.$i]) && file_exists(UPLOAD_DIR."/".$row['Pic'.$i]))
       {
        unlink(UPLOAD_DIR."/".$row['Pic'.$i]);
        unlink(UPLOAD_DIR."/thumb_".$row['Pic'.$i].".jpg");
       }
     }
   }
 }

$result = $db->query_exec("DELETE FROM Comments WHERE CommentID='$CommentID'");

SetSendVar("result","1");


?>