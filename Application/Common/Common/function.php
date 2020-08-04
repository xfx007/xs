<?php

function curl($utl){
	$curl = curl_init(); 
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查   
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); // 从证书中检查SSL加密算法是否存在   
curl_setopt($curl, CURLOPT_URL,$utl); 
curl_setopt($curl, CURLOPT_HEADER, 1);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);// 这个是主要参数
$url = curl_exec($curl); 
curl_close($curl);
return $url;
}
?>