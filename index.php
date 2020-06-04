<?
header("Expires: Mon, 26 Jul 1991 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include(dirname(__FILE__)."/ini/connection_data.php");
include(dirname(__FILE__)."/lib/db.php");
include(dirname(__FILE__)."/lib/tools.php");
include(dirname(__FILE__)."/lib/valid.php");
include(dirname(__FILE__)."/lib/image.php");

$db = new DBmysql(HOSTNAME,DATABASE,USERNAME,PASSWORD);

define("DEF_COUNT_ROW_PER_PAGE",10);
define("UPLOAD_DIR",dirname(__FILE__)."/images");
define("PLUGIN_DIR",dirname(__FILE__)."/plugins");

if (InitialVar("admin"))
 {
  $_POST['plugin']    = "admin";
  $_POST['load_page'] = "page";
 }

define("ACTION",InitialVar("action"));
define("PLUGIN",InitialVar("plugin"));
define("LOAD_TPL",InitialVar("load_tpl"));
define("LOAD_PAGE",InitialVar("load_page"));
define("LOAD_SCRIPT",InitialVar("load_script"));

if (LOAD_TPL)
 {
  @header("Content-Type: text/plain; charset=windows-1251");

  if (file_exists(PLUGIN_DIR))
   {
    if (file_exists(PLUGIN_DIR."/".PLUGIN))
     {
      if (file_exists(PLUGIN_DIR."/".PLUGIN."/load_tpl.php"))
       {
        include(PLUGIN_DIR."/".PLUGIN."/load_tpl.php");
       }
      else
       {
        if (file_exists(PLUGIN_DIR."/".PLUGIN."/tpl/".LOAD_TPL.".htm"))
         {
          printText(PLUGIN_DIR."/".PLUGIN."/tpl/".LOAD_TPL.".htm");
         }
       }
     }
   }

  echo "\r\n";
 }
else if (LOAD_PAGE)
 {
  @header("Content-Type: text/html; charset=windows-1251");

  if (file_exists(PLUGIN_DIR))
   {
    if (file_exists(PLUGIN_DIR."/".PLUGIN))
     {
      if (file_exists(PLUGIN_DIR."/".PLUGIN."/load_page.php"))
       {
        include(PLUGIN_DIR."/".PLUGIN."/load_page.php");
       }
      else
       {
        if (file_exists(PLUGIN_DIR."/".PLUGIN."/tpl/".LOAD_PAGE.".htm"))
         {
          printText(PLUGIN_DIR."/".PLUGIN."/tpl/".LOAD_PAGE.".htm");
         }
       }
     }
   }

  echo "\r\n";
 }
else if (LOAD_SCRIPT)
 {
  @header("Content-Type: text/javascript; charset=windows-1251");

  if (PLUGIN)
   {
    printText(PLUGIN_DIR."/".PLUGIN."/js/".LOAD_SCRIPT.".js");
   }
  else
   {
    printText(dirname(__FILE__)."/js/".LOAD_SCRIPT.".js");
   }

  echo "\r\n";
 }
else if (PLUGIN)
 {
  if (file_exists(PLUGIN_DIR))
   {
    if (file_exists(PLUGIN_DIR."/".PLUGIN))
     {
      if (ACTION)
       {
        if (file_exists(PLUGIN_DIR."/".PLUGIN."/".ACTION.".php"))
         {
          include(PLUGIN_DIR."/".PLUGIN."/".ACTION.".php");
         }
       }
      else
       {
        if (file_exists(PLUGIN_DIR."/".PLUGIN."/index.php"))
         {
          include(PLUGIN_DIR."/".PLUGIN."/index.php");
         }
       }
     }
   }

  PrintSendVars();
 }
else
 {
  echo "\r\n";
 }


?>