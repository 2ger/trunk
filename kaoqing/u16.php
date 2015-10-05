
<?PHP
include 'count.php';
// 中控U160提交考勤到网数据库
/*
创建ADO连接


*/
/*
//地址
 $url = "192.168.10.74";
//账号
 $user = "root";
//密码
 $password = "";
 //连接
 $icon = mysql_connect($url,$user,$password);
 //设置编码机
 mysql_query("set names 'utf8'");
 //连接数据库
 mysql_select_db("kdoa");*/
 $icon = new PDO("mysql:host=lzcpcnet.gotoftp5.com;dbname=lzcpcnet","lzcpcnet","lzc.com"); 

 
 
$str= $count;

$conn = @new COM("ADODB.Connection") or die ("ADO Connection faild.");
$connstr = "PROVIDER=Microsoft.Jet.OLEDB.4.0;Data Source=".realpath("C:\Program Files\ZKTeco\att2000.mdb");
$conn->Open($connstr);
/*
创建记录集查询
*/

$rs = @new COM("ADODB.RecordSet");
$rs->Open("select * from CHECKINOUT  where id >$str ",$conn);

echo $str;
/*
循环读取数据
*/





while(!$rs->eof){

$str++;


$start_time=$rs->Fields["CHECKTIME"]->Value;

$start_time= strtotime($start_time);

$start_time = date("Y-m-d H:i:s",$start_time);
$start_time= preg_replace('/([\x80-\xff]*)/i','',$start_time); // 去中文，如“星期二”


$location=$rs->Fields["SENSORID"]->Value;
$user_id=$rs->Fields["USERID"]->Value;
$end_time= date("Y-m-d H:i:s",time());

$ifend_time= date("His",time());

$rs->Movenext(); //将记录集指针下移
	if( (80000 < $ifend_time and  $ifend_time < 80030) or (95000 < $ifend_time and  $ifend_time < 95030) or (112000 < $ifend_time and  $ifend_time < 112030)  or (143000 < $ifend_time and  $ifend_time < 143030) or (193000 < $ifend_time and  $ifend_time < 193030) or (161000 < $ifend_time and  $ifend_time < 161030))
		{
		echo $start_time;
$sql = "insert into onethink_schedule (location,start_time,end_time,user_id,priority,typename)  values('".$location."','".$start_time."','".$end_time."','".$user_id."','3','正常打卡')";

		}
			if( (80030 < $ifend_time and  $ifend_time < 92500) or (95030 < $ifend_time and  $ifend_time < 111500) or (112030 < $ifend_time and  $ifend_time < 120000)  or (143030 < $ifend_time and  $ifend_time < 155500) or (161030 < $ifend_time and  $ifend_time < 173500) or (193030 < $ifend_time and  $ifend_time < 205500))
		{
				echo $start_time;
$sql = "insert into onethink_schedule (location,start_time,end_time,user_id,priority,typename)  values('".$location."','".$start_time."','".$end_time."','".$user_id."','5','迟到早退')";

		}
	
if (!$icon->exec($sql))
 {
   die('Error: ' . mysql_error());
 }
}

/*插入数据  */

 echo "数据正在上传中请勿关闭";
 
//存最大数入count.php
$myfile = fopen("count.php", "w") or die("Unable to open file!");
$txt = '<?php $count='.$str.'; ?>';

fwrite($myfile, $txt);
fclose($myfile);


 //关闭连接
$rs->close();


?>