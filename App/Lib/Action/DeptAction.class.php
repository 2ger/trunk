<?php
/*---------------------------------------------------------------------------
 

 Copyright (c) 2015 http://www.thinkphp.com All rights reserved.

 Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )

 Author:  thinkphp.com

 Support: http://www.thinkphp.com
 -------------------------------------------------------------------------*/

class DeptAction extends CommonAction {

	protected $config = array('app_type' => 'master');

	public function index(){
		
		$node = M("Dept");
		$menu = array();
		$menu = $node -> where($map) -> field('id,pid,name,is_del') -> order('sort asc') -> select();
		$tree = list_to_tree($menu);
		$this -> assign('menu', popup_tree_menu($tree));

		$model = M("Dept");
		$list = $model -> order('sort asc') -> getField('id,name');
		$this -> assign('dept_list', $list);

		$model = M("DeptGrade");
		$list = $model -> where('is_del=0') -> order('sort asc') -> getField('id,name');
		$this -> assign('dept_grade_list',$list);

		$this -> display();
	}

	public function del() {
		$id = $_POST['id'];
		$this -> _destory($id);

	}

	public function winpop() {
		$node = M("Dept");
		$menu = array();
		$menu = $node -> where('is_del=0') -> field('id,pid,name') -> order('sort asc') -> select();

		$tree = list_to_tree($menu);
		$this -> assign('menu', popup_tree_menu($tree));

		$this -> assign('pid', $pid);
		$this -> display();
	}

	public function winpop2() {
		$this -> winpop();
	}

}
?>