<?
$AllowedExtensions = array("jpg","jpeg","gif","png");
$AllowedMimeType   = array("image/jpeg","image/pjpeg","image/gif","image/png","image/x-png");

$login    = InitialVar('login');
$pwd_post = md5(InitialVar('pwd'));

$Pwd = $db->GetValByFName("SELECT Pwd FROM Users WHERE Login='$login'","Pwd");

if ($pwd_post == $Pwd)
 {
  $files = $_FILES["comment_pic"];

  $fname = array();

  foreach($files['name'] as $key=>$name)
   {
    $extension = strtolower(pathinfo($name,PATHINFO_EXTENSION));
    $tmp_name  = $files['tmp_name'][$key];
    $size      = $files['size'][$key];
    $type      = strtolower($files['type'][$key]);

    if (!empty($name) &&
        is_uploaded_file($tmp_name) &&
        in_array($extension,$AllowedExtensions) &&
        in_array($type,$AllowedMimeType) &&
        $size < 210000)
     {
      $new_name = md5(mktime().$key).".$extension";

      $fname[] = "'$new_name'";

      CreateThumb($tmp_name,UPLOAD_DIR."/thumb_$new_name.jpg",120,90);

      move_uploaded_file($tmp_name,UPLOAD_DIR."/".$new_name);

      echo "<script> parent.setGlobal('result_upload',200); </script>";
     }
    else if ($size >= 210000)
     {
      echo "<script> parent.setGlobal('result_upload','�������� ����� �� ������ ����� $name - ".($size/1000)." �����.\\r\\n������������ ������ 200 �����'); </script>";
      break;
     }
    else if (empty($name))
     {

     }
    else if (!in_array(strtolower($extension),$AllowedExtensions) ||
             !in_array(strtolower($type),$AllowedMimeType))
     {
      echo "<script> parent.setGlobal('result_upload','�������� ������ ����� � $name - $type $extension.\\r\\n��������� ����� ������� - JPG,GIF,PNG'); </script>";
      break;
     }
    else if (!is_uploaded_file($tmp_name))
     {
      echo "<script> parent.setGlobal('result_upload','������ � �������� ����� - $name'); </script>";
      break;
     }
   }

  echo "<script> parent.setGlobal('uploaded_files',[".implode(",",$fname)."]); </script>";
 }
else
 {
  echo "<script>
parent.setGlobal('uploaded_files',[]);
parent.setGlobal('result_upload','������');
</script>";
 }


?>