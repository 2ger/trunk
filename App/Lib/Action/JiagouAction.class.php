<?php
/*---------------------------------------------------------------------------
 

 Copyright (c) 2015 http://www.thinkphp.com All rights reserved.

 Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )

 Author:  thinkphp.com

 Support: http://www.thinkphp.com
 -------------------------------------------------------------------------*/

class JiagouAction extends CommonAction {
	protected $config = array('app_type' => 'asst');
	//过滤查询字段

	function _search_filter(&$map) {
		if (!empty($_POST['keyword'])) {
			$map['type|name|code'] = array('like', "%" . $_POST['keyword'] . "%");
		}
	}

	public function index() {
		$user=M('user');
		$yuanzhang=$user->where('dept_id = 30')->select();
		$lingdao=$user->where('dept_id = 32')->select();
		$zhuren=$user->where('dept_id = 24')->select();
		$mishu=$user->where('dept_id = 6')->select();
		$laoshi=$user->where('dept_id = 7')->select();
		$lunwenld=$user->where('dept_id = 28')->select();
		$lunwendb=$user->where('dept_id = 29')->select();

		$this->assign('yuanzhang',$yuanzhang);
		$this->assign('lingdao',$lingdao);
		$this->assign('zhuren',$zhuren);
		$this->assign('mishu',$mishu);
		$this->assign('laoshi',$laoshi);
		$this->assign('lunwenld',$lunwenld);
		$this->assign('lunwendb',$lunwendb);

		//dump($lingdao);

		$widget['jquery-ui'] = true;
		$this -> assign("widget", $widget);

		$config = D("UserConfig") -> get_config();
		$this -> assign("home_sort", $config['home_sort']);
		$this -> display();
	}
	public function jiagou() {
		$user=M('user');
		$yuanzhang=$user->where('dept_id = 30')->order('emp_no')->select();
		$lingdao=$user->where('rank_id = 2 ')->order('emp_no')->select();
		$ybzrtw=$user->where('dept_id = 40 or dept_id=39')->order('emp_no')->select();

		$zhuren=$user->where('dept_id = 24 ')->order('emp_no')->select();
		$mishu=$user->where('dept_id = 6')->order('emp_no')->select();
		$laoshi=$user->where('dept_id in (7,37,36)')->order('emp_no')->select();
		$lunwenld=$user->where('dept_id = 28')->order('emp_no')->select();
		$lunwendb=$user->where('dept_id = 29')->order('emp_no')->select();

		$this->assign('yuanzhang',$yuanzhang);
		$this->assign('lingdao',$lingdao);
		$this->assign('ybzrtw',$ybzrtw);
		$this->assign('zhuren',$zhuren);
		$this->assign('mishu',$mishu);
		$this->assign('laoshi',$laoshi);
		$this->assign('lunwenld',$lunwenld);
		$this->assign('lunwendb',$lunwendb);

		//dump($lingdao);

		$widget['jquery-ui'] = true;
		$this -> assign("widget", $widget);

		$config = D("UserConfig") -> get_config();
		$this -> assign("home_sort", $config['home_sort']);
		$this -> display();
	}
}
?>