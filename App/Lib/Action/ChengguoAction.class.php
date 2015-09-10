<?php
/*---------------------------------------------------------------------------
 

 Copyright (c) 2015 http://www.thinkphp.com All rights reserved.

 Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )

 Author:  thinkphp.com

 Support: http://www.thinkphp.com
 -------------------------------------------------------------------------*/

class ChengguoAction extends CommonAction {
	protected $config = array('app_type' => 'asst');
	//过滤查询字段

	function _search_filter(&$map) {
		if (!empty($_POST['keyword'])) {
			$map['type|name|code'] = array('like', "%" . $_POST['keyword'] . "%");
		}
	}

	public function index() {
		$widget['jquery-ui'] = true;
		$this -> assign("widget", $widget);
		
		$uid = get_user_id();
		$deptid = get_dept_id();
		$username =  get_user_name();

		// 通用流程
		$this->flow=M('flow')->where('type = 96 and (user_id='.$uid.' or confirm like "%'.$deptid.'%" or confirm like "%'.$uid.'%")')->select();
		//通用任务
		$this->task=M('task')->where('type = "chengguo" and (user_id='.$uid.' or executor like "%'.$username.'%")')->select();
		//申报加分
		$this->shenbao=M('flow')->where('type = 44 and user_id='.$uid)->select();

		$config = D("UserConfig") -> get_config();
		$this -> assign("home_sort", $config['home_sort']);


           $flow=M('flow')->select();
	$emp_no = get_emp_no();
	$uid = get_user_id();

	
	//订教材  流程图
	$flow=M('task')->where('name = "科研成果"')->select();
	if (!empty($flow)) {
		//dump($flow);
		$this->isfa =1;//第一步
		
		$this->taskId= $flow[0]['id'];
		$taskFrom= $flow[0]['user_id'];//发起人id
		$taskId= $flow[0]['id'];
		
		//dump($taskId);
		$taskStatus=M('task_log')->where('task_id = "'.$taskId.'" and executor ='.$uid)->find();
		dump($uid);
		if ($taskStatus['status'] ==4 or $taskFrom == $taskStatus['assigner']) { 
			$this->iszhuan =1;//第二步， 已转交 OR 发起人!=分配人 说明任务已被转交
		}
		if($taskStatus['status'] ==3) {
			$this->iszhuan =1;//第二步
			$this->iswan =1;//第三步， 完成
		}
	}



		$this -> display();
	}

}
?>