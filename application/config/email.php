<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * smtp邮箱配置参数
 */
$config ['protocol'] = 'smtp';
$config ['smtp_from'] = 'admin@svsos.com';
$config ['smtp_host'] = 'smtp.svsos.com';
$config ['smtp_user'] = 'admin@svsos.com';
$config ['smtp_pass'] = 'svsos2014';
$config ['smtp_port'] = '25';
$config ['smtp_timeout'] = '5';
$config['charset'] = 'utf-8';
$config['mailtype'] = 'html';
$config ['newline'] = "\r\n";
$config ['crlf'] = "\r\n";
$config['send_content'] = "<html><body><strong>尊敬的用户：</strong><br>&nbsp;<br>您好！您于".date('Y年m月d日 H:i')."提交激活邮箱请求，邮箱验证码为：%s<br>&nbsp;<br>
        为了保证您帐号的安全性，该激活码有效期为24小时，并且使用一次后将失效!<br>&nbsp;<br>如果您误收到此电子邮件，
        则可能是其他用户在尝试激活邮箱时的误操作，如果您并未发起该请求，则无需再进行任何操作，并可以放心地忽略此电子邮件，由此给您带来的不便请谅解。
        <br>&nbsp;<br>感谢您使用随售网！<br>&nbsp;<br>随售网账户中心</body></html>";