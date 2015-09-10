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

	public function day_view() {
		
		
		// // 上课时间
	// 	if( (80000 < $ifend_time and  $ifend_time < 80030) or (95000 < $ifend_time and  $ifend_time < 95030) or (112000 < $ifend_time and  $ifend_time < 112030)  or (143000 < $ifend_time and  $ifend_time < 143030) or (193000 < $ifend_time and  $ifend_time < 193030))
	// 	{
	//
	// 	}
	// 	// 迟到或早退
	// 	if( (80030 < $ifend_time and  $ifend_time < 92500) or (95030 < $ifend_time and  $ifend_time < 111500) or (112030 < $ifend_time and  $ifend_time < 120000)  or (143030 < $ifend_time and  $ifend_time < 155500) or (161000 < $ifend_time and  $ifend_time < 173500) or (193030 < $ifend_time and  $ifend_time < 205500))
	// 	{
	//
	// 	}
	//
	//
	// 	//1-2上课时间  未迟到
	// 	$list1 = M("Schedule") -> where('start_time between "2015-09-05 08:00:00" and "2015-09-05 08:30:00"') -> order('start_time,priority desc') -> getField('user_id id,user_id');
	// 	//1-2上课时间  迟到
	// 	$list2 = M("Schedule") -> where('start_time between "2015-09-05 08:31:00" and "2015-09-05 09:30:00"') -> order('start_time,priority desc') -> getField('user_id id,user_id');
	//
	// 	//3-4上课时间  未迟到
	// 	$list3 = M("Schedule") -> where('start_time between "2015-09-05 08:29:00" and "2015-09-05 09:30:00"') -> order('start_time,priority desc') -> getField('user_id id,user_id');
	// 	$list4 = M("Schedule") -> where('start_time between "2015-09-05 09:30:00" and "2015-09-05 10:00:00"') -> order('start_time,priority desc') -> getField('user_id id,user_id');
	// 	$ids = array_diff($list, $list1);
	//
		
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
		$where['is_del']=array('eq',0);
		$where['priority']=array('in','3,5');
		$where['start_time'] = array( array('egt', $start_date), array('elt', $end_date)); // 修改为小于当前时间显示
		$list = M("Schedule") -> where($where) -> order('start_time,priority desc') -> select();
		exit(json_encode($list));
	}
	function update($id,$p){
		M("Schedule") -> where('id='.$id)->setField('priority',$p);
		$this->success('修改成功');
	}

}
?>