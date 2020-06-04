<?

function InitialFile($var_name)
 {
  global $_FILES;

  return (isset($_FILES[$var_name])) ? $_FILES[$var_name] : false;
 }

function InitialVar($var_name,$type=false)
 {
  global $_POST, $_GET;

  $result = false;

  if (isset($_POST[$var_name]) && (!empty($_POST[$var_name]) || $_POST[$var_name]==0))
   {
    if (Valid_NonZero($_POST[$var_name]) && Valid_String($_POST[$var_name])) $result = $_POST[$var_name];
   }
  else if (isset($_GET[$var_name]) && (!empty($_GET[$var_name]) || $_GET[$var_name]==0))
   {
    if (Valid_NonZero($_GET[$var_name]) && Valid_String($_GET[$var_name])) $result = $_GET[$var_name];
   }

  if ($result !== false && $type !== false)
   {
    if ($type == "int"   && !Valid_Int($result))   $result = false;
    if ($type == "word"  && !Valid_Word($result))  $result = false;
    if ($type == "email" && !Valid_Email($result)) $result = false;
    if ($type == "array" && !is_array($result))    $result = false;

    if      ($type == "bool" && empty($result)) $result = false;
    else if ($type == "bool")                   $result = true;
   }

  return $result;
 }

function Valid_Simbol($string)
 {
  if (is_array($string)) $string = implode("",$string);
  if (preg_match("'[^a-zA-Z0-9\-\_]'",$string)) return false;
  else                                          return true;
 }

function Valid_String($string)
 {
  if (is_array($string)) $string = implode("",$string);
  if (preg_match("'[\x01-\x08\x11\x12\x14-\x1F]'",$string)) return false;
  else                                                       return true;
 }

function Valid_Int($string)
 {
  if (preg_match("'[^0-9]'",$string)) return false;
  else                                return true;
 }

function Valid_Word($string)
 {
  if (preg_match("'[^a-zA-ZР-пр-џ0-9 \-\_]'",$string)) return false;
  else                                             return true;
 }

function Valid_Email($string)
 {
  if (preg_match("'^[a-zA-Z_\.0-9\-]{1,15}\@([a-zA-Z_\.0-9\-]{1,12}\.){1,3}[a-zA-Z_\.0-9\-]{1,5}'i",$string)) return true;
  else                                 return false;
 }

function Valid_NonZero($string)
 {
  if (is_array($string)) $string = implode("",$string);
  if (strpos($string,"\x00") === false) return true;
  else                                  return false;
 }

function Valid_AllVarNonZero()
 {
  global $_POST;

  foreach($_POST as $VarVal)
   {
    if (!Valid_NonZero($VarVal)) return false;
   }
  return true;
 }


?>