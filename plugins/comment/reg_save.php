<?

$data = InitialVar('data');

$data['Pwd'] = md5($data['Pwd']);

$result = $db->InsertHash("Users",$data);

SetSendVar("result",$result?"1":"0");
?>