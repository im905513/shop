<?php 
//configure for bluehost email server
/*
$config['useragent']	= "CodeIgniter";
$config['protocol'] = 'sendmail';
$config['mailpath']  = "/usr/sbin/sendmail";
$config['smtp_host'] = 'mail.7even.com.tw';
$config['smtp_port'] = 25;
$config['smtp_user'] = 's805@7even.com.tw';
$config['smtp_pass'] = 'S80688142';
$config['smtp_timeout'] = 10;
*/
/*
$config['useragent']	= "CodeIgniter";
$config['protocol'] 	= 'smtp';
$config['mailpath']  	= "/usr/sbin/sendmail.postfix";
$config['smtp_host'] 	= '216.127.161.26';

$config['smtp_port'] 	= 25;
$config['smtp_user'] 	= '';
$config['smtp_pass'] 	= '';
$config['smtp_timeout'] = 10;

$config['mailtype'] = 'html';
$config['charset'] = 'utf-8';
$config['wordwrap'] = TRUE;
$config['crlf'] = '\r\n';
$config['newline'] = '\r\n';
$config['validate'] = TRUE;
*/

$config['protocol'] = "smtp";
$config['smtp_host'] = "ssl://smtp.gmail.com";
$config['smtp_port'] = "465";
$config['smtp_user'] = "service.ytalent@gmail.com"; 
$config['smtp_pass'] = "pplesearch";
$config['charset'] = "utf-8";
$config['mailtype'] = "html";
$config['newline'] = "\r\n";