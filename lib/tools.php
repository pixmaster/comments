<?
function PrintSendVars()
 {
  @header("Content-Type: text/plain; charset=windows-1251");

  $v = $GLOBALS['send_vars'];

  if (is_array($v) && count($v) > 0)
   {
    $send_list = array();

    foreach($v as $name=>$val)
     {
      $send_list[] = "$name=$val";
     }

    printExt(implode("\t",$send_list));
   }
  else
   {

   }
 }

function SetSendVar($name,$val)
 {
  $GLOBALS['send_vars'][$name] = $val."";
 }

function SetSendVarsByAssoc($array_assoc)
 {
  if (is_array($array_assoc) && count($array_assoc) > 0)
   {
    foreach($array_assoc as $key=>$val)
     {
      SetSendVar($key,$val);
     }
   }
 }

function GetAJAXArrayByDBRow($row)
 {
  $tmp_row = array();

  foreach($row as $key=>$val)
   {
    $tmp_row[] = "'$key':'$val'";
   }

  return "{".implode(",",$tmp_row)."}";
 }


function printText($path)
 {
  if (file_exists($path))
   {
    printExt(implode("",file($path)));
   }
  else
   {
    echo "";
   }
 }

function printExt($text)
 {
  $set_type_list = explode(",",str_replace(" ","",$_SERVER['HTTP_ACCEPT_ENCODING']));

  if (in_array("deflate",$set_type_list))
   {
    @header("Vary: Accept-Encoding");
    @header("Content-Encoding: deflate");
    echo gzdeflate($text,5);
   }
  else if (in_array("gzip",$set_type_list))
   {
    @header("Vary: Accept-Encoding");
    @header("Content-Encoding: gzip");
    echo gzencode($text,5);
   }
  else
   {
    echo $text;
   }
 }
?>