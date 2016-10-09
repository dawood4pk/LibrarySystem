<?php defined('BASEPATH') OR exit('No direct script access allowed');

//require_once(APPPATH . 'libraries/PHPMailer/class.phpmailer.php');

//include_once(APPPATH . 'libraries/PHPMailer/PHPMailerAutoload.php');

class My_PHPMailer {
	public function My_PHPMailer() {
		require_once('PHPMailer/class.smtp.php');
		require_once('PHPMailer/class.phpmailer.php');
	}
}