<?php
 
include 'phpqrcode.php'; 

for($i=1;$i<=10;$i++){
			
			$num =rand(1000000000,2147483646); //date("YmdHis") //rand(1000000000,9999999999) //mktime()
			//$data['number']= $num;
			//$data['score']= 10;//rand(1,10)
			//$data['create_time']= mktime();
		//	$data['done']= 0;
		//	$model->add($data);
			$data= "http://www.80gj.com/mobile/qrcode.php?id=".$num;
			//$value = 'http://www.jb51.net'; //二维码内容 
$filename = 'test/'.date("YmdHis").".jpg"; 
// 纠错级别：L、M、Q、H 
$errorCorrectionLevel = 'L'; 
// 点的大小：1到10 
$matrixPointSize = 10; 
QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
			
			sleep(1);
		}
		
