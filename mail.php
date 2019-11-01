<?php
require_once(dirname(__FILE__).'/class.phpmailer.php'); //правильный путь к файлу библиотеки
$method = $_SERVER['REQUEST_METHOD'];

//Script Foreach
$email = new PHPMailer();
$c = true;

if($_FILES['upfile']['name'] != ""){
	for($i=0; $i < count($_FILES['upfile']['name']); $i++){
		$name_of_uploaded_file = basename($_FILES['upfile']['name'][$i]);
		//$path_of_uploaded_file = $upload_folder . $name_of_uploaded_file;
		$file_to_attach = $_FILES["upfile"]["tmp_name"][$i];
		$email->AddAttachment($file_to_attach, $name_of_uploaded_file);
    }
}

$project_name = trim($_POST["project_name"]);
// $admin_email  = trim($_POST["admin_email"]);

$admin_email  = trim($_POST["admin_email"]);
$form_subject = trim($_POST["form_subject"]);

foreach ( $_POST as $key => $value ) {
	if ( $value != "" && $key != "project_name" && $key != "admin_email" && $key != "form_subject" ) {
		$message .= "
		" . ( ($c = !$c) ? '<tr>':'<tr style="background-color: #f8f8f8;">' ) . "
		<td style='padding: 10px; border: #e9e9e9 1px solid;'><b>$key</b></td>
		<td style='padding: 10px; border: #e9e9e9 1px solid;'>$value</td>
		</tr>
		";
	}
}

$message = "<table style='width: 100%;'>$message</table>";

function adopt($text) {
	return '=?UTF-8?B?'.base64_encode($text).'?=';
}

$headers = "MIME-Version: 1.0" . PHP_EOL .
"Content-Type: text/html; charset=utf-8" . PHP_EOL .
// 'From: '.adopt($project_name).' <info@'.$_SERVER['HTTP_HOST'].'>' . PHP_EOL .
'Reply-To: '.$admin_email.'' . PHP_EOL;

// mail($admin_email, adopt($form_subject), $message, $headers );
$email->CharSet   = "utf-8";
// $email->From      = 'info@xn--90ahbyabt6ar1f.xn--p1ai';
$email->FromName  = $project_name;
$email->Subject   = $form_subject;
$email->isHTML(true);
$email->Body      = $message;
$email->AddAddress( $admin_email );

$email->Send();

// dushes1@yandex.ru