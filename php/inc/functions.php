<?php
function send_email($from,$to,$subject,$body)
{
	$charset='utf-8';
	mb_language("en");
	$headers="MIME-Version: 1.0 \n";
	$headers.="From: <".$from."> \n";
	$headers.="Reply-to: <".$from."> \n";
	$headers.="Content-Type: text/html; charset=$charset \n";
	
	$subject= '=?'.$charset.'?B?'.base64_encode($subject).'?=';
	mail($to,$subject,$body,$headers);
}


?>