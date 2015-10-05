<?php
/*---------------------------------------------------------------------------
 

 Copyright (c) 2015 http://www.thinkphp.com All rights reserved.

 Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )

 Author:  thinkphp.com

 Support: http://www.thinkphp.com
 -------------------------------------------------------------------------*/

class ScheduleAction extends CommonAction {
	protected $config = array('app_type' => 'personal');
	//过滤查询字段
	function _search_filter(&$map) {
		if (!empty($_POST["name"])) {
			$map['name'] = array('like', "%" . $_POST['name'] . "%");
		}
		$map['user_id'] = array('eq', get_user_id());
		$map['is_del'] = array('eq', '0');		
	}

	public function upload() {
		$this -> _upload();
	}

	function read() {
		$widget['jquery-ui'] = true;		
		$this -> assign("widget", $widget);
				
		$model = M('Schedule');
		$id = $_REQUEST['id'];
		$list = $_REQUEST['list'];
		$this -> assign("list", $list);
		$list = array_filter(explode("|", $list));
		$current = array_search($id, $list);

		if ($current !== false) {
			$next = $list[$current + 1];
			$prev = $list[$current - 1];
		}
		$this -> assign('next', $next);
		$this -> assign('prev', $prev);

		$where['id'] = $id;
		$where['user_id'] = get_user_id();
		$vo = $model -> where($where) -> find();
		$this -> assign('vo', $vo);
		$this -> display();
	}

	function search() {
		
		$widget['date'] = true;
		$this -> assign("widget", $widget);

		$map = $this -> _search();
		if (method_exists($this, '_search_filter')) {
			$this -> _search_filter($map);
		}
		
		if (empty($_POST["be_start_date"])&&empty($_POST["en_start_date"])) {
			$start_date = toDate(mktime(0, 0, 0, date("m"), 1, date("Y")), 'Y-m-d');
			$end_date = toDate(mktime(0, 0, 0, date("m") + 1, 0, date("Y")), 'Y-m-d');			
			$map['start_date'] = array(array("egt", $start_date),array("elt",$end_date));					
		} else {
			$start_date = $_POST["be_start_date"];
			$end_date = $_POST["en_start_date"];
		}
		
		$this -> assign('start_date', $start_date);
		$this -> assign('end_date', $end_date);

		$model = D("Schedule");
		if (!empty($model)) {
			$this -> _list($model, $map);
		}
		$this -> assign('type_data', $this -> type_data);
		$this -> display();
		return;
	}

	public function down() {
		$this -> _down();
	}

	public function add() {
		$widget['jquery-ui'] = true;
		$widget['date'] = true;	
		$widget['uploader'] = true;
		$widget['editor'] = true;
		$this -> assign("widget", $widget);

		$this -> display();
	}

	public function edit() {
		$widget['jquery-ui'] = true;
		$widget['date'] = true;		
		$widget['uploader'] = true;
		$widget['editor'] = true;
		$this -> assign("widget", $widget);

		$id = $_REQUEST['id'];
		$model = M('Schedule');
		$where['user_id'] = get_user_id();
		$where['id'] = $id;
		$vo = $model -> where($where) -> find();

		$vo['start_time'] = fix_time($vo['start_time']);
		$vo['end_time'] = fix_time($vo['end_time']);

		$this -> assign('vo', $vo);
		$this -> display();
	}
	public function huiyi() {
		// 修改权限
		$uid = get_user_id();
		if($uid == 102){
			$this->hidde = "";
		}else{
			$this->hidde = "hidden";
		}
		$this -> display();
	}
	public function day_view() {
		// 修改权限
		$uid = get_user_id();
		if($uid == 99){
			$this->hidde = "";
		}else{
			$this->hidde = "hidden";
		}
		
		
		// 体育学院时间表
// 		1-2 8:00-9:25
// 		3-4 9:50-11:15
// 		5   11:20-12:00
// 		6-7   14:30-15:55
// 		8-9  16:10-17:35
// 		11-12   19:30-20:55
//
// 		柳石
// 		1-2    8:10-9:40
// 		3-4  9:50-11:20
// 		5  11:30-12:10
// 		6-7   14:30-16:00
// 		8-9  16:10-17:30
// 		晚自习 19:30-21:30
//
// 		行政  吴静99   张振华84   刘柏100   宋海霞75   苏龙74   黄海73   吴俊杰120  罗革79  梁然116 张辉明72  蒋钢强 69
		$xingzheng = array(99,84,100,75,74,73,120,79,116,72,69);
// 		80：30 -12：00
// 		3：00-18：00
//
// 		训练
// 		16：30-18：30
		
		//取得上次最大数
		$model = M('Schedule');
		$lastmax = M('Schedule')->max('net_id');
		if ( $lastmax==NULL) {
			$lastmax =0;
		}
		//dump($lastmax);
		// 连接网上数据库
		$icon = new PDO("mysql:host=lzcpcnet.gotoftp5.com;dbname=lzcpcnet","lzcpcnet","lzc.com"); 
		$sql = 'SELECT * FROM onethink_schedule where  id > '.$lastmax;// ;
		  
		   $query = $icon->query($sql);
		   $query->setFetchMode(PDO::FETCH_ASSOC);    //设置结果集返回格式,此处为关联数组,即不包含index下标
		 
			 $list = $query->fetchAll();
		   //TODO 1，获得今天的会议人＋时间， 
		   $today = date("Y-m-d");//"2015-09-30"
		   $huiyi_today = $model->where('start_time like "%'.$today.'%" and actor = "huiyi" and priority = 5')->select();
		   $huiyi_count = count($huiyi_today);
		 //  dump($huiyi_count);
		   
			// 存入本地数据库
			$max = count($list);
			for ($i=0; $i < $max; $i++) { 
				$userinfo = M('user')->where('emp_no = '.$list[$i]['emp_no'])->find(); // 得到用户真实信息
				$uid = $userinfo['id'];
				
				// 会议判断
				for ($y=0; $y < $huiyi_count; $y++) { 
					$hyid = $huiyi_today[$y]['id']; //会议id
	  			//	dump($hyid);
					$huiyi = strtotime($huiyi_today[$y]['start_time']); // 会议时间转成 截
					$daka = strtotime($list[$i]['start_time']); // 打卡时间转成 截
					// 判断是否 在会议前后0.5小时内
  					   $huiyi_before = $huiyi -1800;
  					   $huiyi_after = $huiyi + 1800;

  					   if ( $daka > $huiyi_before and  $daka < $huiyi_after) {
					//   echo $userinfo['id'].'在会议前后0.5小时内-------------------!!!'.$huiyi_today[$y]['user_id'].'<br/>';
						   if ($huiyi_today[$y]['user_id'] == $uid ) { // uid = uid    				
	   		   				 $data2['net_id'] = $list[$i]['id'];
	   		   				 $data2['user_id'] = $userinfo['user_id'];
	   		   				 $data2['user_name'] = $userinfo['name'];
							
							if ($daka < $huiyi) {  // 时间小于 未迟到，标记为绿
								$data2['priority'] = 3;
							}
	   						 $data2['location'] =$list[$i]['location']; // 机器号， 在考勤软件处设置
	   						 $data2['start_time'] =$list[$i]['start_time'];
	   						 $data2['end_time'] =$list[$i]['end_time'];
	   						 $model->where('id='.$hyid)->save($data2);
	   						
						   }
						    continue;// 退出本次循环，
 						 // break; //完全退出循环
  					   }else{
  					   	 // echo '不在时间内';
  					   }
				}
				//会议判断end
			$daka = strtotime($list[$i]['start_time']); // 打卡时间转成 截
			$ifend_time = date('His',$daka);
			
			if(in_array($uid,$xingzheng)) { // 行政打卡
				// 		80：30 -12：00
				// 		3：00-18：00
						$data['actor'] ='xingzheng';
						if( (80000 < $ifend_time and  $ifend_time < 83000) or (120000 < $ifend_time and  $ifend_time < 150000) or (180000 < $ifend_time and  $ifend_time < 183000))// 上班、下班
						{
							$data['priority'] =3;
							$data['name'] ='行政上卡';
						}else if( (83000 < $ifend_time and  $ifend_time < 120000) or (150000 < $ifend_time and  $ifend_time < 180000))
						{ 	 	// 迟到或早退
							$data['priority'] =5;
							$data['name'] ='行政迟到或早退';
						}else {
							//	未判断的时间内打卡   算作正常
							$data['priority'] =3;
							$data['name'] ='正常上卡ud';
						}
			}else{ // 上课打卡   下课打卡未算到  只算 34 67 89三节课
						if( (92000 < $ifend_time and  $ifend_time < 95000) or (140000 < $ifend_time and  $ifend_time < 143000) or (154000 < $ifend_time and  $ifend_time < 161000))
						{// 上课
						$data['priority'] =3;
						$data['name'] ='正常打卡';
						}else if( (95000 < $ifend_time and  $ifend_time < 111500) or (143000 < $ifend_time and  $ifend_time < 154000) or (161000 < $ifend_time and  $ifend_time < 173000) )
						{ 	 	// 迟到或早退
							$data['priority'] =5;
							$data['name'] ='迟到或早退';
						}else {
							//	未判断的时间内打卡   算作正常
							$data['priority'] =3;
							$data['name'] ='正常上卡ud';
						}
			}
			
			
				$data['net_id'] = $list[$i]['id'];
				$data['user_id'] = $userinfo['id'];
				$data['user_name'] = $userinfo['name'];
				$data['location'] =$list[$i]['location']; // 机器号， 在考勤软件处设置 TODO  判断是123
				$data['start_time'] =$list[$i]['start_time'];
				$data['end_time'] =$list[$i]['end_time'];
				$model -> add($data);
			}
		

	// 	//1-2上课时间  未迟到
	// 	$list1 = M("Schedule") -> where('start_time between "2015-09-05 08:00:00" and "2015-09-05 08:30:00"') -> order('start_time,priority desc') -> getField('user_id id,user_id');
	// 	//1-2上课时间  迟到
	// 	$list2 = M("Schedule") -> where('start_time between "2015-09-05 08:31:00" and "2015-09-05 09:30:00"') -> order('start_time,priority desc') -> getField('user_id id,user_id');
	//
	// 	//3-4上课时间  未迟到
	// 	$list3 = M("Schedule") -> where('start_time between "2015-09-05 08:29:00" and "2015-09-05 09:30:00"') -> order('start_time,priority desc') -> getField('user_id id,user_id');
	// 	$list4 = M("Schedule") -> where('start_time between "2015-09-05 09:30:00" and "2015-09-05 10:00:00"') -> order('start_time,priority desc') -> getField('user_id id,user_id');
	// 	$ids = array_diff($list, $list1);
		
		$this -> index();
	}

	public function read2(){
		$this -> read();
	}
	
	public function del(){
		$this->_del();
	}

	function json() {
		header("Cache-Control: no-cache, must-revalidate");
		header("Content-Type:text/html; charset=utf-8");
		$user_id = get_user_id();
		$start_date = $_REQUEST["start_date"];
		$end_date = $_REQUEST["end_date"];

		$where['user_id'] = $user_id;
		$where['is_del']=array('eq',0);
		$where['priority']=array('in','3,5');
		$where['start_time'] = array( array('egt', $start_date), array('elt', $end_date)); // 修改为小于当前时间显示
		$list = M("Schedule") -> where($where) -> order('start_time,priority desc') -> select();
		exit(json_encode($list));
	}
	function jsonall() {
		header("Cache-Control: no-cache, must-revalidate");
		header("Content-Type:text/html; charset=utf-8");
		$user_id = get_user_id();
		$start_date = $_REQUEST["start_date"];
		$end_date = $_REQUEST["end_date"];

		//$where['user_id'] = $user_id;
		// $where['is_del']=array('eq',0);
		$where['user_id']=array('neq',0);
		$where['priority']=array('in','3,5');
		$where['start_time'] = array( array('egt', $start_date), array('elt', $end_date)); //原来
	//	$where['start_time'] = array('elt',mktime); // 修改为小于当前时间显示
		$list = M("Schedule") -> where($where) -> order('start_time  desc,priority desc') -> select();
		exit(json_encode($list));
	}
	function jsonhuiyi() {
		header("Cache-Control: no-cache, must-revalidate");
		header("Content-Type:text/html; charset=utf-8");
		$user_id = get_user_id();
		$start_date = $_REQUEST["start_date"];
		$end_date = $_REQUEST["end_date"];

		//$where['user_id'] = $user_id;
		// $where['is_del']=array('eq',0);
		$where['actor']='huiyi';
		$where['priority']=array('in','3,5');
		$where['start_time'] = array( array('egt', $start_date), array('elt', $end_date)); //原来
	//	$where['start_time'] = array('elt',mktime); // 修改为小于当前时间显示
		$list = M("Schedule") -> where($where) -> order('start_time  desc,priority desc') -> select();
		exit(json_encode($list));
	}
	function update($id,$p){
		M("Schedule") -> where('id='.$id)->setField('priority',$p);
		$this->success('修改成功');
	}

}
?>