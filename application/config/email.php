<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = Array(
    
    'protocol' => 'smtp',
    'smtp_host' => 'mail.emarklist.com',
    'smtp_port' => 25,
    // 'smtp_crypto' => 'tls',
    // 'smtp_user' => 'test@fonatur.website',
    // 'smtp_pass' => '8CTR=Cx_#L6!',
    'smtp_user' => 'noreply@emarklist.com',
    'smtp_pass' => '7m8lYZORGsH{',
    'mailtype'  => 'html', 
    'charset'   => 'UTF-8',
    'newline' => "\r\n",
    'crlf' => "\r\n",
    'priority' => 1,
    'smtp_timeout' => 60
);
?>