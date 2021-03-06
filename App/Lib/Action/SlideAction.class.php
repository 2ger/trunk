<?php
/*---------------------------------------------------------------------------
   

  Copyright (c) 2015 http://www.thinkphp.com All rights reserved.                                             

  Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )  

  Author:  thinkphp.com                         

  Support: http://www.thinkphp.com               
 -------------------------------------------------------------------------*/


class SlideAction extends CommonAction {
	protected $config=array('app_type'=>'personal');
	//过滤查询字段
	function _search_filter(&$map) {
		$map['name'] = array('like', "%" . $_POST['keyword'] . "%");
		$map['is_del']=0;
	}

	public function index() {
				
		$list = M("Slide") -> where($where) -> order('sort asc') -> select();
		$this -> assign("list",$list);

		$this -> display();	
	}

	public function upload() {
		$this->_upload();
	}

	function read() {
		$model = M('Slide');
		$id = $_REQUEST['id'];
		$list = $_REQUEST['list'];
		$this -> assign("list", $list);
		$list = array_filter(explode("|", $list));
		array_pop($list);
		$current = array_search($id, $list);
		if ($current !== false) {
			$next = $list[$current + 1];
			$prev = $list[$current - 1];
		}
		$this -> assign('next', $next);
		$this -> assign('prev', $prev);

		$where['id'] = $id;
		$where['user_id'] = get_user_id();
		$vo = $model -> where($where) -> find();
		$this -> assign('vo', $vo);
		$this -> display();
	}

	public function down() {
		$this->_down();
	}

	function del() {
		$id = $_REQUEST['id'];
		$where['id'] = $id;
		$result = M("Slide") -> where($where) -> delete();
		if ($result !== false) {//保存成功
			$this -> assign('jumpUrl', get_return_url());
			$this -> success('删除成功!');
		} else {
			//失败提示
			$this -> error('删除失败!');
		}
	}

	public function add() {
		$widget['jquery-ui'] = true;			
		$widget['date'] = true;					
		$widget['uploader'] = true;
		$widget['editor'] = true;
		$this -> assign("widget", $widget);		
		$this -> display();
	}

	public function edit() {
					
								
		$widget['uploader'] = true;
		$widget['editor'] = true;
		$this -> assign("widget", $widget);			

		
		$id = $_REQUEST['id'];
		$model = M('Slide');
		
		$where['id'] = $id;
		$vo = $model -> where($where) -> find();
		
		$this -> assign('vo', $vo);
		$this -> display();
	}

	public function set_sort() {
		$node = $_REQUEST['node'];
		$priority = $_REQUEST['priority'];
		$sort = $_REQUEST['sort'];

		$model = M("Slide");
		// 实例化User对象		
		foreach ($node as $key => $val) {
			$data = array('sort' => $sort[$key]);
			$where['id'] = $val;
			$model -> where($where) -> setField($data);
		}
	}

	public function mark_status() {
		$id = $_REQUEST['id'];
		$val = $_REQUEST['val'];
		if ($val == 3) {
			$field = 'end_date';
			$date = date("Y-m-d");
			$model = M("Slide");
			$where['id'] = $id;
			$where['user_id'] = array('eq', get_user_id());
			$list = $model -> where($where) -> setField($field, $date);
		}
		$field = 'status';
		$result = $this -> _set_field($id, $field, $val);
		if ($result !== false) {//保存成功
			$this -> assign('jumpUrl', get_return_url());
			$this -> success('操作成功!');
		} else {
			//失败提示
			$this -> error('操作失败!');
		}
	}

	function json() {
		header("Cache-Control: no-cache, must-revalidate");
		header("Content-Type:text/html; charset=utf-8");
		$user_id = get_user_id();
		$start_date = $_REQUEST["start_date"];
		$end_date = $_REQUEST["end_date"];

		$where['user_id'] = $user_id;
		$where['start_date'] = array( array('gt', $start_date), array('lt', $end_date));
		$list = M("Slide") -> where($where) -> order('start_date,priority desc') -> select();
		exit(json_encode($list));
	}

}
?>