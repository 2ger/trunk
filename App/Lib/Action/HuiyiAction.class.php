<?php
/*---------------------------------------------------------------------------
 Copyright (c) 2015 http://www.thinkphp.com All rights reserved.

 Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )

 Author:  thinkphp.com

 Support: http://www.thinkphp.com
 -------------------------------------------------------------------------*/

class huiyiAction extends CommonAction {
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
		//未开
		$where['expected_time'] = array('gt',mktime()); //时间判断， 超过现在的则未开
		$where['type'] = array("in","101,102");
		$this->task=M('task')->where($where)->order("id desc")->limit(50)->select();
		//已开
		$where_done['expected_time'] = array('lt',mktime());
		$where_done['type'] = array("in","101,102");
		$this->task_done=M('task')->where($where_done)->limit(50)->select();
		
		$config = D("UserConfig") -> get_config();
		$this -> assign("home_sort", $config['home_sort']);
		$this -> display();
	}
	public function log() {
		$widget['jquery-ui'] = true;
		$this -> assign("widget", $widget);

		$uid = get_user_id();
		$deptid = get_dept_id();
		$username =  get_user_name();
		//未开
		$tasks1 = M('task_log')->where('task_type=103 and status <3 and step =1')->getField('task_id id','task_id');
		$where['id'] = array('in',$tasks1);
		$this->task=M('task')->where($where)->order("id desc")->limit(50)->select();
		//已开
		$tasks = M('task_log')->where('task_type=103 and status =3 and step =2')->getField('task_id id','task_id');
		$where_done['id'] = array('in',$tasks);
		$this->task_done=M('task')->where($where_done)->limit(50)->select();
		
		$config = D("UserConfig") -> get_config();
		$this -> assign("home_sort", $config['home_sort']);
		$this -> display();
	}

}
?>