<?php
/*---------------------------------------------------------------------------
 

 Copyright (c) 2015 http://www.thinkphp.com All rights reserved.

 Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )

 Author:  thinkphp.com

 Support: http://www.thinkphp.com
 -------------------------------------------------------------------------*/

class HomeAction extends CommonAction {
	protected $config = array('app_type' => 'asst');
	//过滤查询字段

	function _search_filter(&$map) {
		if (!empty($_POST['keyword'])) {
			$map['type|name|code'] = array('like', "%" . $_POST['keyword'] . "%");
		}
	}

	public function index() {
	    cookie("current_node", 302);
	   	cookie("top_menu", 301);
	   	cookie("top_menu2", 301);

		$sy= "SELECT *FROM onethink_document_syllabus GROUP BY course ";
		$member = M() -> query($sy);
    
        $this->assign('member',$member);
		$teacher = M('user') ->select();
        $this->assign('teacher',$teacher);

		$task=M('task');
		$wherelog['executor'] =  get_user_id();
		$wherelog['status'] =  array('in','0,1');
		$task_ids =M('task_log')->where($wherelog)->getField("task_id id,task_id");
		//	dump($task_ids);
		$where['id'] =  array('in',$task_ids);
		$this->taskgt=$task->where($where)->order('id desc')->limit(50)->select();
		
		$where_log['executor|assigner|transactor'] =  get_user_id();
		$where_log['status'] =  array("in","3,4");
		$task_ids2 =M('task_log')->where($where_log)->getField("task_id id,task_id");
		$where2['id'] =  array('in',$task_ids2);
		$this->task_done=$task->where($where2)->order('id desc')->limit(50)->select();
		
		

		$widget['jquery-ui'] = true;
		$this -> assign("widget", $widget);

		//dump(get_user_rank());
		// cookie("current_node", null);
// 		cookie("top_menu", null);

		$config = D("UserConfig") -> get_config();
		$this -> assign("home_sort", $config['home_sort']);
		$this -> _mail_list();
		$this -> _flow_list();
		$this -> _schedule_list();
		$this -> _notice_list();
		$this -> _doc_list();
		$this -> _forum_list();
		$this -> _news_list();
		$this -> _slide_list();
		$this -> _task_list();

		$flow=M("flow");
		 //需要我审批的  使用  下方 todo_flow_list
		// $this->show=$flow->where('confirm like "%'.get_emp_no().'%" AND step != 40')->limit('3')->order('id desc')->select();
		$this->show1=$flow->where('(confirm like "%'.get_emp_no().'%" or user_id ="'.(int) get_user_id().'") AND step=40 ')->order('id desc')->limit('25')->select();
		


		$this->notice=M("notice")->limit(50)->select();

		$this->schedule=M("schedule")->where('priority=5')->select();

		//dump($schedule);
		//die();
		

		$this -> display();
	}

	public function showall() {
		$this->show_all=M('flow')->where('confirm like "%'.get_emp_no().'%" or user_id ="'.(int) get_user_id().'"')->order('id desc')->select();
		$this->taskall =M('task')->where('executor like "%'.get_user_id().'%" or user_id ="'.(int) get_user_id().'"')->order('id desc')->select();
		
		$this -> display();
	}
	
	public function tongyong() {
		$where['type'] = array('in','104,105,106,107');
		$this->task =M('task')->where($where)->order('id desc')->limit(50)->select();
		
		
		$this -> display();
	}
	public function chart() {
		$days = date('t');
		$month = date('m');
		$timeline = '1';
		$result = M('schedule')->where('user_id =102 and start_time like "%'.$month.'-01%"')->count();
		$results = $result;
		
		for ($i=2; $i <= $days  ; $i++) { 
			$timeline = $timeline.','.$i;
			$datem =  $month."-0".$i;
			$result = M('schedule')->where('user_id =102 and start_time like "%'.$datem.'%"')->count();
			//echo $reslut." - ".$datem.'<br />';
			$results =  $results.','.$result;
		}
		//$reslut = M('schedule')->where('user_id =102')->select();
		// echo $timeline;
// 		echo $resluts;
		$this->timeline = $timeline;
		$this->results = $results;
		//echo $resluts;
		$this -> display();
	}
	
	public function set_sort() {
		$val = $_REQUEST["val"];
		$data['home_sort'] = $val;
		$model = D("UserConfig") -> set_config($data);
	}

	protected function _mail_list() {
		$user_id = get_user_id();
		$model = D('Mail');

		//获取最新邮件
		$where['user_id'] = $user_id;
		$where['is_del'] = array('eq', '0');
		$where['folder'] = array( array('eq', 1), array('gt', 6), 'or');

		$new_mail_list = $model -> where($where) -> field("id,name,create_time") -> order("create_time desc") -> limit(6) -> select();
		$this -> assign('new_mail_list', $new_mail_list);

		//获取未读邮件
		$where['read'] = array('eq', '0');
		$unread_mail_list = $model -> where($where) -> field("id,name,create_time") -> order("create_time desc") -> limit(6) -> select();
		$this -> assign('unread_mail_list', $unread_mail_list);
	}

public function test(){
//带审批的列表
		$emp_no = get_emp_no();
		$FlowLog = M("FlowLog");
		$model = D('Flow');
		$where['result'] = 3;
		$where['emp_no'] = $emp_no;
		$log_list = $FlowLog -> where($where) -> getField('flow_id id,flow_id');
		$map['id'] = array('in', $log_list);
		$todo_flow_list = $model -> where($map) -> limit(6) -> order("create_time desc") -> select();
		dump($todo_flow_list);
			}
	protected function _flow_list() {
		$user_id = get_user_id();
		$emp_no = get_emp_no();
		$model = D('Flow');
		//待审批的列表
		$FlowLog = M("FlowLog");
		$model = D('Flow');
		$where['result'] = 3;
		$where['emp_no'] = $emp_no;
		$log_list = $FlowLog -> where($where) -> getField('flow_id id,flow_id');
		$map['id'] = array('in', $log_list);
		$todo_flow_list = $model -> where($map) -> limit(6) -> order("create_time desc") -> select();
		$this -> assign("todo_flow_list", $todo_flow_list);
		//已提交
		$map = array();
		$map['user_id'] = $user_id;
		$map['step'] = array('gt', 10);
		$submit_process_list = $model -> where($map) -> field("id,name,create_time") -> limit(6) -> order("create_time desc") -> select();
		$this -> assign("submit_flow_list", $submit_process_list);
	}

	protected function _doc_list() {
		$user_id = get_user_id();
		$model = D('Doc');
		//获取最新邮件

		$where['is_del'] = array('eq', '0');
		$folder_list = D("SystemFolder") -> get_authed_folder(get_user_id(), "DocFolder");
		$where['folder'] = array("in", $folder_list);
		$doc_list = $model -> where($where) -> field("id,name,create_time") -> order("create_time desc") -> limit(6) -> select();
		$this -> assign("doc_list", $doc_list);
	}

	protected function _news_list() {
		$user_id = get_user_id();
		$model = D('News');

		$where['is_del'] = array('eq', '0');
		$folder_list = D("SystemFolder") -> get_authed_folder(get_user_id(), "NewsFolder");
		$where['folder'] = array("in", $folder_list);
		$news_list = $model -> where($where) -> field("id,name,create_time") -> order("create_time desc") -> limit(6) -> select();
		$this -> assign("news_list", $news_list);
	}

	protected function _slide_list() {
		$slide_list = M("Slide") -> where($where) -> order('sort asc') -> select();
		$this -> assign("slide_list", $slide_list);
	}

	protected function _schedule_list() {
		$user_id = get_user_id();
		$model = M('Schedule');
		//获取最新邮件
		$start_date = date("Y-m");

		$where['user_id'] = $user_id;
		$where['start_time'] = array('egt', $start_date);
		$schedule_list = M("Schedule") -> where($where) -> order('start_time,priority desc') -> limit(6) -> select();
		$this -> assign("schedule_list", $schedule_list);

		$model = M("Todo");
		$where = array();
		$where['user_id'] = $user_id;
		$where['status'] = array("in", "1,2");
		$todo_list = M("Todo") -> where($where) -> order('priority desc,sort asc') -> limit(6) -> select();
		$this -> assign("todo_list", $todo_list);
	}

	protected function _notice_list() {
		$model = D('Notice');
		//获取最新通知
		$where['is_del'] = array('eq', '0');
		$folder_list = D("SystemFolder") -> get_authed_folder(get_user_id(), "NoticeFolder");
		$where['folder'] = array("in", $folder_list);
		$new_notice_list = $model -> where($where) -> field("id,folder,name,create_time") -> order("create_time desc") -> limit(6) -> select();
		$this -> assign("new_notice_list", $new_notice_list);
		//dump($new_notice_list);
	}

	protected function _forum_list() {
		$model = D('Forum');
		$where['is_del'] = array('eq', '0');
		$folder_list = D("SystemFolder") -> get_authed_folder(get_user_id(), "ForumFolder");
		$where['folder'] = array("in", $folder_list);
		$new_forum_list = $model -> where($where) -> field("id,name,create_time") -> order("create_time desc") -> limit(6) -> select();
		$this -> assign("new_forum_list", $new_forum_list);
	}

	protected function _task_list() {
		//等我接受的任务
		$model = M("Task");
		$where = array();
		$where_log['type'] = 1;
		$where_log['status'] = 0;
		$where_log['executor'] = get_user_id();
		$task_list = M("TaskLog") -> where($where_log) -> getField('task_id id,task_id');

		//$where['id'] = array('in', $task_list);

		$task_todo_list = $model -> where($where) -> order("create_time desc") -> limit(6) -> select();
		//dump($task_todo_list);
		$this -> assign("task_todo_list", $task_todo_list);
	

		//我部门任务
		$where = array();
		$auth = D("Role") -> get_auth("Task");
		if ($auth['admin']) {
			$where_log['type'] = 2;
			$where_log['executor'] = get_dept_id();
			$task_list = M("TaskLog") -> where($where_log) -> getField('task_id id,task_id');
			$where['id'] = array('in', $task_list);
		} else {
			$where['_string'] = '1=2';
		}

		$task_dept_list = $model -> where($where) -> order("create_time desc") -> limit(6) -> select();
		$this -> assign("task_dept_list", $task_dept_list);
	}
	

	
	function qrcode(){
		$logo="";//http://www.liantu.com/images/2013/sample.jpg
		$width=300;
		$user_id=22;
		$model = M('qrcode');
		
		for($i=1;$i<=10000;$i++){
			
			$num =rand(1000000000,2147483646); //date("YmdHis") //rand(1000000000,9999999999) //mktime()
			$data['number']= $num;
			$data['score']= 10;//rand(1,10)
			$data['create_time']= mktime();
			$data['done']= 0;
			$result = $model->add($data);
			if ($result) {
				$url= "http://www.80gj.com/mobile/qrcode.php?id=".$num;
				//$qrcode = "http://qr.liantu.com/api.php?logo=".$logo."&w=".$width."&text=".$url;
			
				$qrcode = "https://chart.googleapis.com/chart?cht=qr&chs=300x300&choe=UTF-8&chld=L|1&chl=http%3A%2F%2Fwww.80gj.com%2Fmobile%2Fqrcode.php%3Fid%3D".$num;
				//echo $qrcode;
		
				get_photo($qrcode);
			}
			
			sleep(2);
		}
		
		//dump($qrcode);
	}
	function qrcode2(){
		Vendor("phpqrcode.phpqrcode");
		$model = M('qrcode');
		for($i=1;$i<=100000;$i++){
			
			$num =rand(1000000000,2147483646); //date("YmdHis") //rand(1000000000,9999999999) //mktime()
			$data['number']= $num;
			$data['score']= 10;//rand(1,10)
			$data['create_time']= mktime();
			$data['done']= 0;
			$result = $model->add($data);
			if ($result) {
				$url= "http://www.80gj.com/mobile/qrcode.php?id=".$num;
				//$value = 'http://www.jb51.net'; //二维码内容 
				$filename = 'test/Z'.date("YmdHis").".jpg"; 
				// 纠错级别：L、M、Q、H 
				$errorCorrectionLevel = 'L'; 
				// 点的大小：1到10 
				$matrixPointSize = 10; 
				QRcode::png($url, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
			}
			sleep(2);
		}
		
	}

}
?>