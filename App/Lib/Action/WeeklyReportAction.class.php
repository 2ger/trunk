<?php
/*---------------------------------------------------------------------------
 

 Copyright (c) 2015 http://www.thinkphp.com All rights reserved.

 Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )

 Author:  thinkphp.com

 Support: http://www.thinkphp.com
 -------------------------------------------------------------------------*/

class WeeklyReportAction extends CommonAction {
	protected $config = array('app_type' => 'common', 'action_auth' => array('share' => 'read', 'plan' => 'read', 'save_comment' => 'write', 'edit_comment' => 'write', 'reply_comment' => 'write', 'del_comment' => 'admin'));
	//过滤查询字段
	function _search_filter(&$map) {
		$map['is_del'] = array('eq', '0');
		if (!empty($_POST['content'])) {
			$where['content'] = array('like', '%' . $_POST['content'] . '%');
			$where['plan'] = array('like', '%' . $_POST['content'] . '%');
			$where['_logic'] = 'or';
			$map['_complex'] = $where;
		}
	}

	public function index() {
		$widget['date'] = true;
		$this -> assign("widget", $widget);
		$this -> assign('user_id', get_user_id());

		$auth = $this -> config['auth'];
		$this -> assign('auth', $auth);
		if ($auth['admin']) {
			$node = D("Dept");
			$dept_id = get_dept_id();
			$dept_name = get_dept_name();
			$menu = array();
			$dept_menu = $node -> field('id,pid,name') -> where("is_del=0") -> order('sort asc') -> select();
			$dept_tree = list_to_tree($dept_menu, $dept_id);
			$count = count($dept_tree);
			if (empty($count)) {
				/*获取部门列表*/
				$html = '';
				$html = $html . "<option value='{$dept_id}'>{$dept_name}</option>";
				$this -> assign('dept_list', $html);

				//*获取人员列表*/
				$rank_id = get_user_info(get_user_id(), 'rank_id');
				$where['rank_id'] = array('gt', $rank_id);

				$where['dept_id'] = array('eq', $dept_id);
				$emp_list = D("User") -> where($where) -> getField('id,name');
				$this -> assign('emp_list', $emp_list);
			} else {
				/*获取部门列表*/
				$this -> assign('dept_list', select_tree_menu($dept_tree));
				$dept_list = tree_to_list($dept_tree);
				$dept_list = rotate($dept_list);
				$dept_list = $dept_list['id'];

				/*获取人员列表*/
				$rank_id = get_user_info(get_user_id(), 'rank_id');
				$where['rank_id'] = array('gt', $rank_id);

				$where['dept_id'] = array('in', $dept_list);
				$where['is_submit'] = array('eq', 1);
				$where['_logic'] = 'or';

				$map['_complex'] = $where;
				$map['user_id'] = get_user_id();

				$emp_list = D("User") -> where($map) -> getField('id,name');
				$this -> assign('emp_list', $emp_list);
			}
		}

		$map = $this -> _search();
		if ($auth['admin']) {
			if (empty($map['dept_id'])) {
				if (!empty($dept_list)) {
					$map['dept_id'] = array('in', array_merge($dept_list, array($dept_id)));
				} else {
					$map['dept_id'] = array('eq', $dept_id);
				}
			}
		} else {
			$map['user_id'] = get_user_id();
		}

		if ( D("Role") -> check_duty('SHOW_LOG')) {
			$map = array();
			$map['is_del'] = array('eq', '0');
		}

		if (method_exists($this, '_search_filter')) {
			$this -> _search_filter($map);
		}

		$model = D("WeeklyReport");
		if (!empty($model)) {
			$this -> _list($model, $map);
		}
		$this -> display();
	}

	public function add() {

		$data['is_submit'] = 0;
		$id = D("WeeklyReport") -> add($data);
		$this -> assign('id', $id);

		$widget['date'] = true;
		$widget['uploader'] = true;
		$widget['editor'] = true;
		$this -> assign("widget", $widget);

		$date_1 = date('Y-m-d', strtotime('0 day'));
		$date_2 = date('Y-m-d', strtotime('-1 day'));
		$date_3 = date('Y-m-d', strtotime('-2 day'));
		$work_date_list = array($date_1 => $date_1, $date_2 => $date_2, $date_3 => $date_3);
		$this -> assign('work_date_list', $work_date_list);

		$where_last['user_id'] = array('eq', get_user_id());
		$where_last['is_submit'] = array('eq', 1);
		$last_report = M("WeeklyReport") -> where($where_last) -> order('id desc') -> find();
		$this -> assign('last_report', $last_report);

		$where_detail['pid'] = $last_report['id'];
		$where_detail['type'] = array('eq', 1);
		$last_report_detail = M("WeeklyReportDetail") -> where($where_detail) -> select();
		$this -> assign('last_report_detail', $last_report_detail);

		$this -> display();
	}

	public function read($id) {

		$this -> assign('id', $id);
		$this -> assign('auth', $this -> config['auth']);

		$widget['date'] = true;
		$widget['uploader'] = true;
		$widget['editor'] = true;
		$this -> assign("widget", $widget);

		$date_1 = date('Y-m-d', strtotime('0 day'));
		$date_2 = date('Y-m-d', strtotime('-1 day'));
		$date_3 = date('Y-m-d', strtotime('-2 day'));
		$work_date_list = array($date_1 => $date_1, $date_2 => $date_2, $date_3 => $date_3);
		$this -> assign('work_date_list', $work_date_list);

		$where_last['id'] = array('eq', $id);
		$last_report = M("WeeklyReport") -> where($where_last) -> order('id desc') -> find();
		$this -> assign('last_report', $last_report);

		$where_detail['pid'] = $last_report['id'];
		$where_detail['type'] = array('eq', 1);
		$last_report_detail = M("WeeklyReportDetail") -> where($where_detail) -> select();

		foreach ($last_report_detail as $key => $val) {
			$last_report_detail[$key]['item'] = explode('|||', $val['item']);
			$last_report_detail[$key]['start_time'] = explode('|||', $val['start_time']);
			$last_report_detail[$key]['end_time'] = explode('|||', $val['end_time']);
			$last_report_detail[$key]['status'] = explode('|||', $val['status']);
		}

		$this -> assign('last_report_detail', $last_report_detail);

		$where_plan['pid'] = $last_report['id'];
		$where_plan['type'] = array('eq', 2);
		$last_report_plan = M("WeeklyReportDetail") -> where($where_plan) -> select();
		$this -> assign('last_report_plan', $last_report_plan);
		//dump($last_report_plan);

		$where_comment['doc_id'] = array('eq', $id);
		$where_comment['is_del'] = array('eq', 0);
		$comment = M("WeeklyReportComment") -> where($where_comment) -> select();
		$this -> assign('comment', $comment);

		$this -> display();
	}

	public function edit($id) {

		$this -> assign('id', $id);

		$widget['date'] = true;
		$widget['uploader'] = true;
		$widget['editor'] = true;
		$this -> assign("widget", $widget);

		$date_1 = date('Y-m-d', strtotime('0 day'));
		$date_2 = date('Y-m-d', strtotime('-1 day'));
		$date_3 = date('Y-m-d', strtotime('-2 day'));
		$work_date_list = array($date_1 => $date_1, $date_2 => $date_2, $date_3 => $date_3);
		$this -> assign('work_date_list', $work_date_list);

		$where_last['id'] = array('eq', $id);
		$last_report = M("WeeklyReport") -> where($where_last) -> order('id desc') -> find();
		$this -> assign('last_report', $last_report);

		$where_detail['pid'] = $last_report['id'];
		$where_detail['type'] = array('eq', 1);
		$last_report_detail = M("WeeklyReportDetail") -> where($where_detail) -> select();
		$this -> assign('last_report_detail', $last_report_detail);

		$where_plan['pid'] = $last_report['id'];
		$where_plan['type'] = array('eq', 2);
		$last_report_plan = M("WeeklyReportDetail") -> where($where_plan) -> select();
		$this -> assign('last_report_plan', $last_report_plan);
		//dump($last_report_plan);

		$this -> display();
	}

	function plan() {
		$user_id = get_user_id();
		$leader_id = get_leader_id($user_id);

		$where_last['user_id'] = array('eq', $leader_id);
		$where_last['is_submit'] = array('eq', 1);
		$last_report = M("WeeklyReport") -> where($where_last) -> order('id desc') -> find();
		$this -> assign('last_report', $last_report);

		$where_detail['pid'] = $last_report['id'];
		$where_detail['type'] = array('eq', 1);
		$last_report_detail = M("WeeklyReportDetail") -> where($where_detail) -> select();
		$this -> assign('last_report_detail', $last_report_detail);

		$where_plan['pid'] = $last_report['id'];
		$where_plan['type'] = array('eq', 2);
		$last_report_plan = M("WeeklyReportDetail") -> where($where_plan) -> select();
		$this -> assign('last_report_plan', $last_report_plan);

		$this -> display();
	}

	function upload() {
		$this -> _upload();
	}

	function down() {
		$this -> _down();
	}

	/** 插入新新数据  **/
	protected function _insert() {
		$model = D("WeeklyReport");
		if (false === $model -> create()) {
			$this -> error($model -> getError());
		}
		if (in_array('user_id', $model -> getDbFields())) {
			$model -> user_id = get_user_id();
		};
		if (in_array('user_name', $model -> getDbFields())) {
			$model -> user_name = get_user_name();
		};
		if (in_array('dept_id', $model -> getDbFields())) {
			$model -> dept_id = get_dept_id();
		};
		if (in_array('dept_name', $model -> getDbFields())) {
			$model -> dept_name = get_dept_name();
		};
		$model -> create_time = time();
		/*保存当前数据对象 */
		$list = $model -> add();
		if ($list !== false) {//保存成功
			$this -> assign('jumpUrl', get_return_url());
			$this -> success('新增成功!');
		} else {
			$this -> error('新增失败!');
			//失败提示
		}
	}

	/** 插入新新数据  **/
	protected function _update() {
		$model = D("WeeklyReport");
		if (false === $model -> create()) {
			$this -> error($model -> getError());
		}
		if (in_array('user_id', $model -> getDbFields())) {
			$model -> user_id = get_user_id();
		};
		if (in_array('user_name', $model -> getDbFields())) {
			$model -> user_name = get_user_name();
		};
		if (in_array('dept_id', $model -> getDbFields())) {
			$model -> dept_id = get_dept_id();
		};
		if (in_array('dept_name', $model -> getDbFields())) {
			$model -> dept_name = get_dept_name();
		};
		$model -> create_time = time();
		/*保存当前数据对象 */
		$list = $model -> save();
		if ($list !== false) {//保存成功
			$this -> assign('jumpUrl', get_return_url());
			$this -> success('保存成功!');
		} else {
			$this -> error('保存失败!');
			//失败提示
		}
	}

	function add_comment() {
		$this -> display();
	}

	function edit_comment() {
		$widget['editor'] = true;
		$widget['uploader'] = true;
		$this -> assign("widget", $widget);

		$comment_id = $_REQUEST['comment_id'];
		$xid = M("WeeklyReportComment") -> where("id=$comment_id") -> getField("xid");
		$this -> _edit("WeeklyReportComment", $comment_id);
	}

	function reply_comment() {
		$this -> edit_comment();
	}

	function save_comment() {
		$model = D('WeeklyReportComment');
		if (false === $model -> create()) {
			$this -> error($model -> getError());
		}
		$opmode = $_POST["opmode"];
		switch($opmode) {
			case "add" :
				$list = $model -> add();
				break;
			case "edit" :
				$list = $model -> save();
				break;
			case "del" :
				$this -> _del($name);
				break;
			default :
				$this -> error("非法操作");
		}

		if ($list !== false) {//保存成功
			$this -> assign('jumpUrl', get_return_url());
			$this -> success('操作成功!');
		} else {
			$this -> error('新增失败!');
			//失败提示
		}
	}

	function del_comment() {
		$comment_id = $_REQUEST['comment_id'];
		$this -> _del($comment_id, "WeeklyReportComment");
	}

}
