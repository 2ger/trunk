<?php
/*---------------------------------------------------------------------------
 

 Copyright (c) 2015 http://www.thinkphp.com All rights reserved.

 Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )

 Author:  thinkphp.com

 Support: http://www.thinkphp.com
 -------------------------------------------------------------------------*/

class ChangguanglAction extends CommonAction {
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

		// 完成
		$where['type'] =array('in','102,110,111,112,113,114,115,116,117');
		$where['step'] =array('egt','40');
		$this->flow=M('flow')->where($where)->order('id desc')->select();
		//待办
		$where2['type'] =array('in','102,110,111,112,113,114,115,116,117');
		$where2['step'] =array('lt','40');
		$this->todo=M('flow')->where($where2)->order('id desc')->select();
		
		
		$this -> display();
	}

}
?>