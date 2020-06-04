<?
class DBmysql
 {
  /*var $DB_Host, $DB_Name, $DB_User, $DB_Pass;
  var $DB_ptr = false, $DBcon_ptr=false;
  */
  function DBmysql($host=false,$dbase=false,$user=false,$pass=false)
   {
    if ($host && $dbase && $user)
     {
      $this->DB_Host   = $host;
      $this->DB_Name   = $dbase;
      $this->DB_User   = $user;
      $this->DB_Pass   = $pass;

      if ($this->DB_ptr = @mysql_connect($this->DB_Host,$this->DB_User,$this->DB_Pass,true))
       {
        $this->DBcon_ptr = @mysql_select_db($this->DB_Name,$this->DB_ptr);
       }
      else
       {

       }
     }
    else echo("Соединение с базой данных невозможно. Проверьте параметры подключения.");
   }

  function close()
   {
    if ($this->DB_ptr)
     {
      @mysql_close($this->DB_ptr);
      $this->DB_ptr = false;
     }
   }

  function ListField($TableName,$detailed_flag=false)
   {
    if ($this->DB_ptr && $this->DBcon_ptr)
     {
      if ($Result = mysql_query("DESCRIBE $TableName",$this->DB_ptr))
       {
        if (mysql_num_rows($Result) > 0)
         {
          $return_data = array();

          while($row = mysql_fetch_array($Result))
           {
            $return_data[] = ($detailed_flag) ? $row : $row[0];
           }

          return $return_data;
         }
       }
     }

    return false;
   }

  function GetLastInsertId()
   {
    if ($this->DB_ptr) return mysql_insert_id($this->DB_ptr);
    else               return false;
   }

  function query_exec($Query=false)
   {
    $Result = false;

    if ($Query && $this->DB_ptr)
     {
      if ($Result = $this->DBcon_ptr)
       {
        $Result = mysql_query($Query,$this->DB_ptr);

        if (!$Result)
         {
          $Result = false;
         }
       }
      else echo("Нет доступа к базе данных");
     }
    return $Result;
   }

  function GetValByFName($Query=false, $Name=false)
   {
    if($Query && $Name && ($result = $this->query_exec($Query)) && (mysql_num_rows($result) > 0))
     {
      $row = mysql_fetch_array($result);

      if (isset($row[$Name])) return $row[$Name];
     }

    return false;
   }

  function InsertArray($TableName,$Values)
   {
    $Result = true;

    if ($Result = $this->DBcon_ptr)
     {
      foreach($Values as $Val)
       {
        $Query = "INSERT INTO ".$TableName." VALUES(".$Val.")";
        $Result = mysql_query($Query,$this->DB_ptr);

        if (!$Result)
         {
          $Result = false;
         }
       }
     }
    else echo("Нет доступа к базе данных");

    return($Result);
   }

  function InsertHash($TableName,$Values,$Expression=false)
   {
    $Result = true;

    if ($Expression && !empty($Expression))
     {
      $CountRow = (int)$this->GetValByFName("SELECT COUNT(*) AS CountRow FROM $TableName WHERE $Expression","CountRow");
      if ($CountRow > 0)
       {
        return false;
       }
     }

    if ($Result = $this->DBcon_ptr)
     {
      $Query = "INSERT INTO $TableName SET ";

      $tmp_set = array();

      foreach($Values as $FieldName=>$FieldVal)
       {
        if ($FieldVal == 'NOW()') $tmp_set[] = "$FieldName=$FieldVal";
        else                      $tmp_set[] = "$FieldName='$FieldVal'";
       }

      $Query .= implode(",",$tmp_set);

      $Result = @mysql_query($Query,$this->DB_ptr);
     }

    return($Result);
   }

  function GetPrimaryKeyFieldName($TableName)
   {
    if ($this->DB_ptr && $this->DBcon_ptr)
     {
      if ($Result = mysql_query("SHOW KEYS FROM $TableName",$this->DB_ptr))
       {
        if (mysql_num_rows($Result) > 0)
         {
          while($row = mysql_fetch_array($Result))
           {
            if ($row['Key_name'] == "PRIMARY") return $row['Column_name'];
           }
         }
       }
     }

    return false;
   }

  function UpdateHash($TableName,$Values)
   {
    $KeyFieldVal = -1;

    if ($Result = $this->DBcon_ptr)
     {
      $KeyField = $this->GetPrimaryKeyFieldName($TableName);

      $Query = "UPDATE $TableName SET ";

      $tmp_set = array();

      foreach($Values as $FieldName=>$FieldVal)
       {
        if ($FieldName == $KeyField)
         {
          $KeyFieldVal = $FieldVal;
         }
        else $tmp_set[] = "$FieldName='$FieldVal'";
       }

      if ($KeyFieldVal != -1)
       {
        $Query .= implode(",",$tmp_set)." WHERE $KeyField='$KeyFieldVal'";
        $Result = @mysql_query($Query,$this->DB_ptr);

        return $Result;
       }
      else
       {
        return false;
       }
     }

    return false;
   }

  function TableExists($name)
   {
    if ($Result = @mysql_query("SHOW TABLES",$this->DB_ptr))
     {
      while($row = mysql_fetch_row($Result)) if ($row[0] == $name) return true;
     }

    return false;
   }

  function AddTables($tables,$flag=false)
   {
    reset($tables);

    if (!$this->TableExists(key($tables)))
     {
      $this->CreateTable($tables,$flag);
      return true;
     }
    else
     {
      return false;
     }
   }

  function CreateTable($Fields,$flag_prefix=true)
   {
    if ($this->DBcon_ptr && is_array($Fields) && count($Fields) > 0)
     {
      $ListTableName = array_keys($Fields);

      foreach($ListTableName as $TableName)
       {
        unset($tmp);

        if (!$this->TableExists($TableName))
         {
          foreach($Fields[$TableName] as $FieldName=>$FieldType)
           {
            $prefix = ($flag_prefix) ? "${TableName}_" : "";
            if ($FieldName != '0') $tmp[]   = "${prefix}$FieldName $FieldType";
            else                   $primary = "PRIMARY KEY  (${prefix}$FieldType)";
           }

          $tmp[] = $primary;
          $query = implode(",\n",$tmp);
          $query = "CREATE TABLE $TableName (\n$query\n) /*!40101 ENGINE=MyISAM */ /*!40101 DEFAULT CHARSET=cp1251 */";
          $this->query_exec($query);
         }
       }
     }
    return false;
   }
 }
?>