<?

$data   = InitialVar("data");
$rating = InitialVar("rating");

$login = InitialVar('login');
$pwd_post = md5(InitialVar('pwd'));

$query = "SELECT Pwd,
                 UserID
            FROM Users
           WHERE Login='$login'";

$result = $db->query_exec($query);

if ($result && mysql_num_rows($result) > 0)
 {
  $row = mysql_fetch_assoc($result);

  if ($pwd_post == $row['Pwd'])
   {
    $data['UserID']      = $row['UserID'];
    $data['CommentDate'] = "NOW()";
    $rating['UserID']    = $row['UserID'];

    $result = $db->InsertHash("Comments",$data);

    $resultRating = $db->InsertHash("Rating",$rating,"UserID='".$row['UserID']."' AND ProductID='".$rating['ProductID']."'");

    SetSendVar("result",$result?"1":"0");
    SetSendVar("resultRating",$resultRating?"1":"0");
   }
  else
   {
    SetSendVar("result",0);
   }
 }
else
 {
  SetSendVar("result",0);
 }
?>