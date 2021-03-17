<?
if($_messages){
	foreach($_messages as $message){
		echo sys_message($message['message'], $message['type']);
	}
}
?>