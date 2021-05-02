<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function sendEmail($to = '', $subject  = '', $body = '', $attachment = '', $cc = '')
{
	$ci =& get_instance();

	$ci->load->helper('path');

	$ci->load->library('email');

    
	$ci->email->from('noreply@emarklist.com', 'EmarkList');

	$ci->email->bcc($to, 10);

	$ci->email->subject($subject);  

	$ci->email->message($body);

	if ($cc != '') {
		$ci->email->cc($cc);
	}

	if ($attachment != '') {
		$ci->email->attach($attachment);

	}

	if ($ci->email->send()) {
// 		echo "success";
	} else {
		// echo $ci->email->print_debugger();
		// exit();
	}
}
	
?>