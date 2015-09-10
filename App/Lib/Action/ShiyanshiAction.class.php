<?php
/*---------------------------------------------------------------------------
 

 Copyright (c) 2015 http://www.thinkphp.com All rights reserved.

 Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )

 Author:  thinkphp.com

 Support: http://www.thinkphp.com
 -------------------------------------------------------------------------*/

class ShiyanshiAction extends CommonAction {
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
		
		// 流程提交记录
		$where['type'] = array("in","104,105,106,107,108,109");
		$this->flow=M('flow')->where($where)->select();
	//	$this->flow=M('flow')->where('type = 92 and (user_id='.$uid.' or confirm like "%'.$deptid.'%" or confirm like "%'.$uid.'%")')->select();
		//通用任务
		$this->task=M('task')->where('type = "shiyanshi" and (user_id='.$uid.' or executor like "%'.$username.'%")')->select();
		//申报加分
		$this->shenbao=M('flow')->where('type = 40')->select();// and user_id='.$uid

		$config = D("UserConfig") -> get_config();
		$this -> assign("home_sort", $config['home_sort']);
		$this -> display();
	}

}
?>