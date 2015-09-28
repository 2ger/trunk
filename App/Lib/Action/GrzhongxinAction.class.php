<?php
/*---------------------------------------------------------------------------
 

 Copyright (c) 2015 http://www.thinkphp.com All rights reserved.

 Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )

 Author:  thinkphp.com

 Support: http://www.thinkphp.com
 -------------------------------------------------------------------------*/

class GrzhongxinAction extends CommonAction {
	protected $config = array('app_type' => 'asst');
	//过滤查询字段

	function _search_filter(&$map) {
		if (!empty($_POST['keyword'])) {
			$map['type|name|code'] = array('like', "%" . $_POST['keyword'] . "%");
		}
	}

	public function index() {
	    cookie("current_node", 354);
	   	// cookie("top_menu", 255);
 	// 	   	cookie("top_menu2", 255);
		
		if (!empty($_GET['id'])) {
			$uid = $_GET['id'];
		}else {
			$uid  = get_user_id();
		}
		$this->userlist=M('user')->find($uid);
		
		$emp_no = $this->userlist['emp_no'];
		$userName = $this->userlist['name'];
		$position_id = $this->userlist['position_id'];
		if ($position_id == 16) {
			$where['user'] = "教研室主任";
		}else {
			$where['user'] = $userName;
		}
		if ($position_id == 14) {
			$where['_string'] = "id >38 and step1_position = ".$position_id;
			$where['_logic'] = 'OR';
		}
		$this->leftMenu = M('task_type')->where($where)->select();
		
		
		$sy= "SELECT *FROM onethink_document_syllabus GROUP BY course ";
		$member = M() -> query($sy);
    
        $this->assign('member',$member);


		
		$teacher = M('user') ->select();
    
        $this->assign('teacher',$teacher);

		$task=M('task');
		$taskgt=$task->where(' executor like "%'.get_user_name().'%"')->order('id desc')->select();
		$this->assign('taskgt',$taskgt);
		
	
		$widget['jquery-ui'] = true;
		$this -> assign("widget", $widget);

		//dump($uid);
		//die();
		$config = D("UserConfig") -> get_config();
		$this -> assign("home_sort", $config['home_sort']);

		$flow=M('flow');
		$flow_log=M('flow_log');
		$this->data01=$flow->where('user_id ="'.$uid.'" and (type=38)')->limit(1)->select();
		$this->data02=$flow->where('user_id ="'.$uid.'" and (type=50)')->limit(1)->select();
		$this->data03=$flow->where('user_id ="'.$uid.'" and (type=53)')->limit(1)->select();
		$this->data04=$flow->where('user_id ="'.$uid.'" and (type=55)')->limit(1)->select();
		$this->data05=$flow->where('user_id ="'.$uid.'" and type=68')->limit(1)->select();// and jiaoan =""
		$this->data06=$flow->where('user_id ="'.$uid.'" and (type=77)')->limit(1)->select();

		$this->data11=$flow->where('user_id ="'.$uid.'" and (type=79)')->limit(1)->select();
		$this->data12=$flow->where('user_id ="'.$uid.'" and (type=80)')->limit(1)->select();
		$this->data13=$flow->where('user_id ="'.$uid.'" and (type=81)')->limit(1)->select();
		$this->data14=$flow->where('user_id ="'.$uid.'" and (type=82)')->limit(1)->select();
		$this->data15=$flow->where('user_id ="'.$uid.'" and (type=85)')->limit(1)->select();
		$this->data16=$flow->where('user_id ="'.$uid.'" and (type=89)')->limit(1)->select();
		
		$this->yichang=M('schedule')->where('user_id ="'.$uid.'" and priority = 5')->limit(6)->select();

			//待办任务	
		$task=M('task');
		$wherelog['executor'] =  $uid;
		$wherelog['status'] =  array('in','0,1');
		$task_ids =M('task_log')->where($wherelog)->getField("task_id id,task_id");
		$where['id'] =  array('in',$task_ids);
		$this->fabu=$task->where($where)->order('id desc')->limit(50)->select();
		//完成任务
		$where_log['executor|assigner|transactor'] =  $uid;
		$where_log['status'] =  array("in","3,4");
		$task_ids2 =M('task_log')->where($where_log)->getField("task_id id,task_id");
		$where2['id'] =  array('in',$task_ids2);
		$this->jieshou = $task->where($where2)->order('id desc')->limit(50)->select();
		

		//待审批的列表
		$model = D('Flow');
		$FlowLog = M("FlowLog");
		$model = D('Flow');
		$where['result'] = 3;
		$where['emp_no'] = $emp_no;
		$log_list = $FlowLog -> where($where) -> getField('flow_id id,flow_id');
		$map['id'] = array('in', $log_list);
		$todo_flow_list = $model -> where($map) -> limit(6) -> order("create_time desc") -> select();
		$this -> assign("faqi", $todo_flow_list);
		
		$this->shenpi=$flow->where('(confirm like "%'.get_emp_no().'%" or user_id ="'.$uid.'") AND step=40 ')->order('id desc')->limit('50')->select();

		//dump($jieshou);
		//die();
		$this -> display();
	}

	public function myjob() {
	    cookie("current_node", 354);
	   	// cookie("top_menu", 255);
 	// 	   	cookie("top_menu2", 255);
	
		
		if (!empty($_GET['id'])) {
			$uid = $_GET['id'];
		}else {
			$uid  = get_user_id();
		}
		$this->userlist=M('user')->find($uid);
		$userName = $this->userlist['name'];
		$position_id = $this->userlist['position_id'];
		if ($position_id == 16) {
			$where['user'] = "教研室主任";
			
		}else {
			$where['user'] = $userName;
			$this -> username = $userName;
		}
		if ($position_id == 14) {
			$where['_string'] = "id >38 and step1_position = ".$position_id;
			$where['_logic'] = 'OR';
		}
		$this->leftMenu = M('task_type')->where($where)->select();
		
		$this->uid =$uid;
		$this->tasktype =I('tasktype');
		
		$this -> username =M('task_type')->where('type = '.$this->tasktype)->getfield('user');
		
		$this->task=M('task')->where('type='.I('tasktype').' and user_id='.$uid)->order('id desc')->select();
		
		$this -> display();
	}

}
?>