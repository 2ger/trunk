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
		//$data01['dept_id']=(int) get_user_id();
		//'status=1 AND name="thinkphp"'
		//追踪流程
		$this->show=$flow->where('user_id ="'.(int) get_user_id().'" AND (type=69 or type=70 or type=71 or type=72 or type=73)')->limit(50)->select();
        //已审批
		$this->show1=$flow->where('user_id ="'.(int) get_user_id().'" AND (type=69 or type=70 or type=71 or type=72 or type=73) AND step=40')->limit(50)->select();

        $flow_log=M('flow_log');

		$flow_id=$flow_log->where('user_id='.(int) get_user_id().'')->getField("flow_id");
	   $zz=$flow->where('id='.$flow_id)->limit(50)->select();
		$this->assign("zz",$zz);

		//dump($show1);
		//die();
		$this -> display();
	}

}
?>