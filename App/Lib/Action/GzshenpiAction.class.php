<?php
/*---------------------------------------------------------------------------
 

 Copyright (c) 2015 http://www.thinkphp.com All rights reserved.

 Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )

 Author:  thinkphp.com

 Support: http://www.thinkphp.com
 -------------------------------------------------------------------------*/

class GzshenpiAction extends CommonAction {
	protected $config = array('app_type' => 'asst');
	//过滤查询字段

	function _search_filter(&$map) {
		if (!empty($_POST['keyword'])) {
			$map['type|name|code'] = array('like', "%" . $_POST['keyword'] . "%");
		}
	}

	public function index() {
      

		header("Content-Type:text/html; charset=utf-8");
		$widget['jquery-ui'] = true;
		$this -> assign("widget", $widget);

		$config = D("UserConfig") -> get_config();
		$this -> assign("home_sort", $config['home_sort']);
		$flow_type=M("flow_type");
		$data['tag']=88;
		$flowlist=$flow_type->where($data)->select();
		$this->assign("flowlist",$flowlist);

		$flow=M("flow");
		//追踪流程
		$this->show=$flow->where('user_id ="'.(int) get_user_id().'" AND (type=69 or type=70 or type=71 or type=72 or type=73)')->limit(50)->select();
        //已审批
		$this->show1=$flow->where('user_id ="'.(int) get_user_id().'" AND (type=69 or type=70 or type=71 or type=72 or type=73) AND step=40')->limit(50)->select();

        //待审批的列表
		$user_id = get_user_id();
		$emp_no = get_emp_no();
		$FlowLog = M("FlowLog");
		$model = D('Flow');
		$where['emp_no'] = $emp_no;
		$where['result'] = 3;
		$log_list = $FlowLog -> where($where) -> getField('flow_id id,flow_id');
	//	dump($where);
		$map['id'] = array('in', $log_list);
		$map['type'] = array('in','69,70,71,72,73');
		$todo_flow_list = $model -> where($map) -> limit(50) -> order("create_time desc") -> select();
		$this -> assign("todo_flow_list", $todo_flow_list);

		$this -> display();
	}

}
?>