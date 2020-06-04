<?

include(dirname(__FILE__)."/security_admin.php");

if (file_exists(PLUGIN_DIR."/".PLUGIN."/tpl/".LOAD_PAGE.".htm"))
 {
  printText(PLUGIN_DIR."/".PLUGIN."/tpl/".LOAD_PAGE.".htm");
 }


?>