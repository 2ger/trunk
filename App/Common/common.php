<?php
/*---------------------------------------------------------------------------
 

 Copyright (c) 2015 http://www.thinkphp.com All rights reserved.

 Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )

 Author:  thinkphp.com

 Support: http://www.thinkphp.com
 -------------------------------------------------------------------------*/

function get_file_path($sid) {
	if (is_array($sid)) {
		$where['sid'] = array("in", array_filter($sid));
	} else {
		$where['sid'] = array('in', array_filter(explode(';', $sid)));
	}
	$list = M("File") -> where($where) -> getField('savename');
	return $list;
}

function get_task_log($task_id) {
	$list = M("TaskLog") -> where("task_id=$task_id") -> select();
	return $list;
}

function is_weixin() {
	if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
		return true;
	}
	return false;
}

function get_new_count() {

	$emp_no = get_emp_no();

	//获取未读邮件
	$data = array();

	$user_id = get_user_id();
	$where['user_id'] = $user_id;
	$where['is_del'] = array('eq', '0');
	$where['folder'] = array('eq', 1);
	$where['read'] = array('eq', '0');
	$new_mail_inbox = M("Mail") -> where($where) -> count();
	$data['bc-mail']['bc-mail-inbox'] = $new_mail_inbox;

	//获取未读邮件
	$where['user_id'] = $user_id;
	$where['is_del'] = array('eq', '0');
	$where['folder'] = array('gt', 6);
	$where['read'] = array('eq', '0');
	$new_mail_myfolder = M("Mail") -> where($where) -> count();
	$data['bc-mail']['bc-mail-myfolder'] = $new_mail_myfolder;

	//获取待裁决
	$where = array();
	$FlowLog = M("FlowLog");

	$where['emp_no'] = $emp_no;
	$where['_string'] = "result is null";
	$log_list = $FlowLog -> where($where) -> field('flow_id') -> select();

	$log_list = rotate($log_list);
	$new_confirm_count = 0;
	if (!empty($log_list)) {
		$map['id'] = array('in', $log_list['flow_id']);
		$new_confirm_count = M("Flow") -> where($map) -> count();
	}
	$data['bc-flow']['bc-flow-confirm'] = $new_confirm_count;

	//获取收到的流程
	$where = array();
	$where['emp_no'] = $emp_no;
	$where['step'] = 100;
	$where['is_read'] = 1;

	$log_list = M("FlowLog") -> where($where) -> field('flow_id') -> select();
	$log_list = rotate($log_list);
	$new_receive_count = 0;
	if (!empty($log_list)) {
		$map['id'] = array('in', $log_list['flow_id']);
		$new_receive_count = M("Flow") -> where($map) -> count();
	}
	$data['bc-flow']['bc-flow-receive'] = $new_receive_count;

	//获取最新通知
	$where = array();
	$where['is_del'] = array('eq', '0');
	$folder_list = D("SystemFolder") -> get_authed_folder(get_user_id(), "NoticeFolder");
	$where['folder'] = array('in', $folder_list);
	$where['create_time'] = array("egt", time() - 3600 * 24 * 30);
	$readed = array_filter(explode(",", get_user_config("readed_notice")));

	$where['id'] = array("not in", $readed);

	$new_notice_count = M('Notice') -> where($where) -> count();

	$data['bc-notice']['bc-notice-new'] = $new_notice_count;

	//获取待办事项
	$where = array();
	$where['user_id'] = $user_id;
	$where['status'] = array("in", "1,2");
	$new_todo_count = M("Todo") -> where($where) -> count();
	$data['bc-personal']['bc-personal-todo'] = $new_todo_count;

	//获取日程事项
	$where = array();
	$where['user_id'] = $user_id;
	$where['start_date'] = array("elt", date("Y-m-d"));
	$where['end_date'] = array("egt", date("Y-m-d"));
	$new_schedule_count = M("Schedule") -> where($where) -> count();
	$data['bc-personal']['bc-personal-schedule'] = $new_schedule_count;

	//获取最新消息
	$model = M("Message");
	$where = array();
	$where['owner_id'] = $user_id;
	$where['receiver_id'] = $user_id;
	$where['is_read'] = array('eq', '0');
	$new_message_count = M("Message") -> where($where) -> count();
	$data['bc-message']['bc-message-new'] = $new_message_count;

	//等我接受的任务
	$where = array();
	$where_log['type'] = 1;
	$where_log['status'] = 0;
	$where_log['executor'] = get_user_id();
	$task_list = M("TaskLog") -> where($where_log) -> getField('task_id id,task_id');

	$where['id'] = array('in', $task_list);

	$task_todo_count = M("Task") -> where($where) -> count();
	$data['bc-task']['task_todo_count'] = $task_todo_count;

	//我部门任务
	$where = array();
	$auth = D("Role") -> get_auth("Task");
	if ($auth['admin']) {
		$where_log['type'] = 2;
		$where_log['executor'] = get_dept_id();
		$task_list = M("TaskLog") -> where($where_log) -> getField('task_id id,task_id');
		$where['id'] = array('in', $task_list);
	} else {
		$where['_string'] = '1=2';
	}

	$task_dept_count = M("Task") -> where($where) -> count();
	$data['bc-task']['task_dept_count'] = $task_dept_count;

	return $data;
}

function is_mobile($mobile) {
	return preg_match("/^(?:13\d|14\d|15\d|18[0123456789])-?\d{5}(\d{3}|\*{3})$/", $mobile);
}

function is_email($email) {
	return strlen($email) > 6 && preg_match("/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/", $email);
}

/**
 * 发送HTTP请求方法，目前只支持CURL发送请求
 * @param  string $url    请求URL
 * @param  array  $params 请求参数
 * @param  string $method 请求方法GET/POST
 * @return array  $data   响应数据
 */
function http($url, $params, $method = 'GET', $header = array(), $multi = false) {
	$opts = array(CURLOPT_TIMEOUT => 30, CURLOPT_RETURNTRANSFER => 1, CURLOPT_SSL_VERIFYPEER => false, CURLOPT_SSL_VERIFYHOST => false, CURLOPT_HTTPHEADER => $header);

	/* 根据请求类型设置特定参数 */
	switch(strtoupper($method)) {
		case 'GET' :
			$opts[CURLOPT_URL] = $url . '?' . str_replace("&amp;", "&", http_build_query($params));
			break;
		case 'POST' :
			//判断是否传输文件
			//$params = $multi ? $params : http_build_query($params);
			$opts[CURLOPT_URL] = $url;
			$opts[CURLOPT_POST] = 1;
			$opts[CURLOPT_POSTFIELDS] = $params;
			break;
		default :
			throw new Exception('不支持的请求方式！');
	}

	/* 初始化并执行curl请求 */
	$ch = curl_init();
	curl_setopt_array($ch, $opts);
	$data = curl_exec($ch);
	$error = curl_error($ch);
	curl_close($ch);
	if ($error)
		throw new Exception('请求发生错误：' . $error);
	return $data;
}

/**
 * 不转义中文字符和\/的 json 编码方法
 * @param array $arr 待编码数组
 * @return string
 */
function jsencode($arr) {
	$str = str_replace("\\/", "/", json_encode($arr));
	$search = "#\\\u([0-9a-f]+)#ie";

	if (strpos(strtoupper(PHP_OS), 'WIN') === false) {
		$replace = "iconv('UCS-2BE', 'UTF-8', pack('H4', '\\1'))";
		//LINUX
	} else {
		$replace = "iconv('UCS-2', 'UTF-8', pack('H4', '\\1'))";
		//WINDOWS
	}

	return preg_replace($search, $replace, $str);
}

// 数据保存到文件
function data2file($filename, $arr = '') {
	if (is_array($arr)) {
		$con = var_export($arr, true);
		$con = "<?php\nreturn $con;\n?>";
	} else {
		$con = $arr;
		$con = "<?php\n $con;\n?>";
	}
	write_file($filename, $con);
}

/**
 * 系统加密方法
 * @param string $data 要加密的字符串
 * @param string $key  加密密钥
 * @param int $expire  过期时间 单位 秒
 * @return string
 * @author winky
 */

function encrypt($data, $key = '', $expire = 0) {
	$key = md5(empty($key) ? C('DATA_AUTH_KEY') : $key);
	$data = base64_encode($data);
	$x = 0;
	$len = strlen($data);
	$l = strlen($key);
	$char = '';

	for ($i = 0; $i < $len; $i++) {
		if ($x == $l)
			$x = 0;
		$char .= substr($key, $x, 1);
		$x++;
	}

	$str = sprintf('%010d', $expire ? $expire + time() : 0);

	for ($i = 0; $i < $len; $i++) {
		$str .= chr(ord(substr($data, $i, 1)) + (ord(substr($char, $i, 1))) % 256);
	}
	return str_replace(array('+', '/', '='), array('-', '_', ''), base64_encode($str));
}

/**
 * 系统解密方法
 * @param  string $data 要解密的字符串 （必须是encrypt方法加密的字符串）
 * @param  string $key  加密密钥
 * @return string
 * @author winky
 */
function decrypt($data, $key = '') {
	$key = md5(empty($key) ? C('DATA_AUTH_KEY') : $key);
	$data = str_replace(array('-', '_'), array('+', '/'), $data);
	$mod4 = strlen($data) % 4;
	if ($mod4) {
		$data .= substr('====', $mod4);
	}
	$data = base64_decode($data);
	$expire = substr($data, 0, 10);
	$data = substr($data, 10);

	if ($expire > 0 && $expire < time()) {
		return '';
	}
	$x = 0;
	$len = strlen($data);
	$l = strlen($key);
	$char = $str = '';

	for ($i = 0; $i < $len; $i++) {
		if ($x == $l)
			$x = 0;
		$char .= substr($key, $x, 1);
		$x++;
	}

	for ($i = 0; $i < $len; $i++) {
		if (ord(substr($data, $i, 1)) < ord(substr($char, $i, 1))) {
			$str .= chr((ord(substr($data, $i, 1)) + 256) - ord(substr($char, $i, 1)));
		} else {
			$str .= chr(ord(substr($data, $i, 1)) - ord(substr($char, $i, 1)));
		}
	}
	return base64_decode($str);
}

function upload_filter($val) {
	$allow_type = array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'dwg', 'rar', 'zip', '7z', 'pdf', 'txt', 'rtf', 'jpg', 'jpeg', 'png', 'tip', 'psd');
	if (in_array($val, $allow_type)) {
		return true;
	} else {
		return false;
	}
}

function get_save_path() {
	$app_path = __APP__;
	$save_path = C('SAVE_PATH');
	$app_path = str_replace("/index.php?s=", "", $app_path);
	$app_path = str_replace("/index.php", "", $app_path);
	return C('SAVE_PATH');
}

function get_save_url() {
	$app_path = __APP__;
	$save_path = C('SAVE_PATH');
	$app_path = str_replace("/index.php?s=", "", $app_path);
	$app_path = str_replace("/index.php", "", $app_path);
	return $app_path . "/" . $save_path;
}

function _encode($arr) {
	$na = array();
	foreach ($arr as $k => $value) {
		$na[_urlencode($k)] = _urlencode($value);
	}
	return addcslashes(urldecode(json_encode($na)), "\r\n");
}

function _urlencode($elem) {
	if (is_array($elem)) {
		foreach ($elem as $k => $v) {
			$na[_urlencode($k)] = _urlencode($v);
		}
		return $na;
	}
	return urlencode($elem);
}

function get_img_info($img) {
	$img_info = getimagesize($img);
	if ($img_info !== false) {
		$img_type = strtolower(substr(image_type_to_extension($img_info[2]), 1));
		$info = array("width" => $img_info[0], "height" => $img_info[1], "type" => $img_type, "mime" => $img_info['mime'], );
		return $info;
	} else {
		return false;
	}
}

function get_return_url() {//$level = null
	// if (empty($level)) {
// 		$return_url = cookie('return_url');
// 	} else {
// 		$return_url = cookie('return_url_' . $level);
// 	}
	$node = cookie('current_node');
	$model = M("node");
	$where['id'] = array('eq', $node);
	$url = $model -> where($where) -> getField('url');

	$return_url = U($url);

	// dump($return_url);
	// echo __URL__;
	return $return_url;
}

function get_system_config($code) {
	$model = M("SystemConfig");
	$where['code'] = array('eq', $code);
	$count = $model -> where($where) -> count();
	if ($count > 1) {
		return $model -> where($where) -> getfield("val,name");
	} else {
		return $model -> where($where) -> getfield("val");
	}
}

function get_user_config($field) {
	$model = M("UserConfig");
	$user_id = get_user_id();
	$where['id'] = array('eq', $user_id);
	$result = $model -> where($where) -> getfield($field);
	if (empty($result)) {
		return get_system_config(strtoupper($field));
	} else {
		return $result;
	}
}

function get_user_info($id, $field) {
	$model = D("UserView");
	$where['id'] = array('eq', $id);
	$result = $model -> where($where) -> getfield($field);
	//dump($field);
	return $result;
}

function get_user_id() {
	$user_id = session(C('USER_AUTH_KEY'));
	return isset($user_id) ? $user_id : 0;
}

function get_position_id($id) {
	$position = M('user')->where('id='.get_user_id())->getfield('position_id');
	return $position;
}
function get_user_rank() {
	$user_rank = M('user')->where('id='.get_user_id())->getfield('rank_id');
	return $user_rank;
}
function get_rank_name($id) {
	if (empty($id)) {
		$id = $user_rank = M('user')->where('id='.get_user_id())->getfield('rank_id');
	}
	$result = M("Rank") -> find($id);
	return $result['name'];
}
function get_user_tel($uid) {
	if (empty($uid)) {
		$uid = get_user_id();
	}
	$tel = $user_rank = M('user')->where('id='.$uid)->getfield('mobile_tel');
	if (empty($tel)) {
		$tel = '未填写电话';
	}
	return $tel;
}
function get_emp_no() {
	$emp_no = session("emp_no");
	return isset($emp_no) ? $emp_no : 0;
}

function get_user_name() {
	$user_name = session('user_name');
	return isset($user_name) ? $user_name : 0;
}

function get_dept_id() {
	return session('dept_id');
}

function get_dept_name() {
	$result = M("Dept") -> find(session("dept_id"));
	return $result['name'];
}
function get_module($str) {
	$arr_str = explode("/", $str);
	return $arr_str[0];
}

function get_bc_class($str) {
	$arr_str = explode(" ", $str);
	foreach ($arr_str as $val) {
		if (strpos($val, "bc-") !== false) {
			return $val;
		}
	}
}

function toDate($time, $format = 'Y-m-d H:i:s') {
	if (empty($time)) {
		return '';
	}
	$format = str_replace('#', ':', $format);
	return date($format, $time);
}

function date_to_int($date) {
	$date = explode("-", $date);
	$time = explode(":", "00:00");
	$time = mktime($time[0], $time[1], 0, $date[1], $date[2], $date[0]);
	return $time;
}

function fix_time($time) {
	return substr($time, 0, 5);
}

function del_folder($dir) {
	//打开文件目录
	$dh = opendir($dir);
	//循环读取文件
	while ($file = readdir($dh)) {
		if ($file != '.' && $file != '..') {
			$fullpath = $dir . '/' . $file;

			//判断是否为目录
			if (!is_dir($fullpath)) {
				//echo $fullpath."已被删除<br>";
				//如果不是,删除该文件
				if (!unlink($fullpath)) {
				}
			} else {
				//如果是目录,递归本身删除下级目录
				del_folder($fullpath);
			}
		}
	}
	//关闭目录
	closedir($dh);
	//删除目录

	if (rmdir($dir)) {
		return true;
	} else {
		return false;
	}
}

function filter_search_field($v1) {
	if ($v1 == "keyword")
		return true;
	$prefix = substr($v1, 0, 3);
	$arr_key = array("be_", "en_", "eq_", "li_", "lt_", "gt_", "bt_");
	if (in_array($prefix, $arr_key)) {
		return true;
	} else {
		return false;
	}
}

function filter_flow_field($val) {
	if (strpos($val, "flow_field_") !== false) {
		return true;
	} else {
		return false;
	}
}

function get_cell_location($col, $row, $col_offset = 0, $row_offset = 0) {
	if (!is_numeric($col)) {
		$col = ord($col) - 65;
	}
	$location = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
	$col = $col + $col_offset;
	$row = $row + $row_offset;
	return $location[$col] . $row;
}

function get_model_fields($model) {
	$arr_field = array();
	if (isset($model -> viewFields)) {
		foreach ($model->viewFields as $key => $val) {
			unset($val['_on']);
			unset($val['_type']);
			if (!empty($val[0]) && ($val[0] == "*")) {
				$model = M($key);
				$fields = $model -> getDbFields();
				$arr_field = array_merge($arr_field, array_values($fields));
			} else {
				$arr_field = array_merge($arr_field, array_values($val));
			}
		}
	} else {
		$arr_field = $model -> getDbFields();
	}
	return $arr_field;
}

function show_step_type($step) {
	if ($step >= 20 && $step < 30) {
		return "审批";
	}
	if ($step >= 30) {
		return "协商";
	}
}

function show_result($result) {
	if ($result == 1) {
		return "同意";
	}
	if ($result == 0) {//0
		return "否决";
	}
	if ($result == 2) {
		return "退回";
	}
	if ($result == 3) {
		return "待审批";
	}
}

function show_step($step) {
	if ($step == 40) {
		return "通过";
	}
	if ($step > 30) {
		return "协商中";
	}
	if ($step == 30) {
		return "待协商";
	}
	if ($step > 20) {
		return "审批中";
	}
	if ($step == 20) {
		return "待审批";
	}
	if ($step == 10) {
		return "临时保管";
	}
	if ($step == 0) {
		return "否决";
	}
}

function IP($ip = '', $file = 'UTFWry.dat') {
	$_ip = array();
	if (isset($_ip[$ip])) {
		return $_ip[$ip];
	} else {
		import("ORG.Net.IpLocation");
		$iplocation = new IpLocation($file);
		$location = $iplocation -> getlocation($ip);
		$_ip[$ip] = $location['country'] . $location['area'];
	}
	return $_ip[$ip];
}

function sort_by($array, $keyname = null, $sortby = 'asc') {
	$myarray = $inarray = array();
	# First store the keyvalues in a seperate array
	foreach ($array as $i => $befree) {
		$myarray[$i] = $array[$i][$keyname];
	}
	# Sort the new array by
	switch ($sortby) {
		case 'asc' :
			# Sort an array and maintain index association...
			asort($myarray);
			break;
		case 'desc' :
		case 'arsort' :
			# Sort an array in reverse order and maintain index association
			arsort($myarray);
			break;
		case 'natcasesor' :
			# Sort an array using a case insensitive "natural order" algorithm
			natcasesort($myarray);
			break;
	}
	# Rebuild the old array
	foreach ($myarray as $key => $befree) {
		$inarray[] = $array[$key];
	}
	return $inarray;
}

function fix_array_key($list, $key) {
	$arr = null;
	foreach ($list as $val) {
		$arr[$val[$key]] = $val;
	}
	return $arr;
}

function fill_option($list, $data) {
	$html = "";
	foreach ($list as $key => $val) {
		if (is_array($val)) {
			$id = $val['id'];
			$name = $val['name'];
			if ($id == $data) {
				$selected = "selected";
			} else {
				$selected = "";
			}
			$html = $html . "<option value='{$id}' $selected>{$name}</option>";
		} else {
			if ($key == $data) {
				$selected = "selected";
			} else {
				$selected = "";
			}
			$html = $html . "<option value='{$key}' $selected>{$val}</option>";
		}
	}
	echo $html;
}

/**
 +----------------------------------------------------------
 * 产生随机字串，可用来自动生成密码
 * 默认长度6位 字母和数字混合 支持中文
 +----------------------------------------------------------
 * @param string $len 长度
 * @param string $type 字串类型
 * 0 字母 1 数字 其它 混合
 * @param string $addChars 额外字符
 +----------------------------------------------------------
 * @return string
 +----------------------------------------------------------
 */
function rand_string($len = 6, $type = '', $addChars = '') {
	$str = '';
	switch ($type) {
		case 0 :
			$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz' . $addChars;
			break;
		case 1 :
			$chars = str_repeat('0123456789', 3);
			break;
		case 2 :
			$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' . $addChars;
			break;
		case 3 :
			$chars = 'abcdefghijklmnopqrstuvwxyz' . $addChars;
			break;
		default :
			// 默认去掉了容易混淆的字符oOLl和数字01，要添加请使用addChars参数
			$chars = 'ABCDEFGHIJKMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789' . $addChars;
			break;
	}
	if ($len > 10) {//位数过长重复字符串一定次数
		$chars = $type == 1 ? str_repeat($chars, $len) : str_repeat($chars, 5);
	}
	if ($type != 4) {
		$chars = str_shuffle($chars);
		$str = substr($chars, 0, $len);
	} else {
		// 中文随机字
		for ($i = 0; $i < $len; $i++) {
			$str .= msubstr($chars, floor(mt_rand(0, mb_strlen($chars, 'utf-8') - 1)), 1);
		}
	}
	return $str;
}

function list_to_tree($list, $root = 0, $pk = 'id', $pid = 'pid', $child = '_child') {
	// 创建Tree
	$tree = array();
	if (is_array($list)) {
		// 创建基于主键的数组引用
		$refer = array();
		foreach ($list as $key => $data) {
			$refer[$data[$pk]] = &$list[$key];
		}
		foreach ($list as $key => $data) {
			// 判断是否存在parent
			$parentId = 0;
			if (isset($data[$pid])) {
				$parentId = $data[$pid];
			}
			if ((string)$root == $parentId) {
				$tree[] = &$list[$key];
			} else {
				if (isset($refer[$parentId])) {
					$parent = &$refer[$parentId];
					$parent[$child][] = &$list[$key];
				}
			}
		}
	}
	return $tree;
}

function tree_to_list($tree, $level = 0, $pk = 'id', $pid = 'pid', $child = '_child') {
	$list = array();
	if (is_array($tree)) {
		foreach ($tree as $val) {
			$val['level'] = $level;
			if (isset($val['_child'])) {
				$child = $val['_child'];
				if (is_array($child)) {
					unset($val['_child']);
					$list[] = $val;
					$list = array_merge($list, tree_to_list($child, $level + 1));
				}
			} else {
				$list[] = $val;
			}
		}
		return $list;
	}
}

function left_menu($tree, $level = 0) {
	$level++;
	$html = "";
	if (is_array($tree)) {
		$html = "<ul class=\"tree_menu\">\r\n";
		foreach ($tree as $val) {
			if (isset($val["name"])) {
				$title = $val["name"];
				if (!empty($val["url"])) {
					$url = U($val['url']);
				} else {
					$url = "#";
				}
				$id = $val["id"];
				if (empty($val["id"])) {
					$id = $val["name"];
				}
				if (isset($val['_child'])) {
					$html = $html . "<li>\r\n<a node=\"$id\" href=\"" . "$url\"><i class=\"fa fa-angle-right level$level\"></i><span>$title</span></a>\r\n";
					$html = $html . left_menu($val['_child'], $level);
					$html = $html . "</li>\r\n";
				} else {
					$html = $html . "<li>\r\n<a  node=\"$id\" href=\"" . "$url\"><i class=\"fa fa-angle-right level$level\"></i><span>$title</span></a>\r\n</li>\r\n";
				}
			}
		}
		$html = $html . "</ul>\r\n";
	}
	return $html;
}

function select_tree_menu($tree) {
	$html = "";
	if (is_array($tree)) {
		$list = tree_to_list($tree);
		foreach ($list as $val) {
			$html = $html . "<option value='{$val['id']}'>" . str_pad("", $val['level'] * 3, "│") . "├─" . "{$val['name']}</option>";
		}
	}
	return $html;
}

function popup_tree_menu($tree, $level = 0) {
	$level++;
	$html = "";
	if (is_array($tree)) {
		$html = "<ul class=\"tree_menu\">\r\n";
		foreach ($tree as $val) {
			if (isset($val["name"])) {
				$title = $val["name"];
				$id = $val["id"];
				if (empty($val["id"])) {
					$id = $val["name"];
				}
				if (!empty($val["is_del"])) {
					$del_class = "is_del";
				} else {
					$del_class = "";
				}
				if (isset($val['_child'])) {
					$html = $html . "<li>\r\n<a class=\"$del_class\" node=\"$id\" ><i class=\"fa fa-angle-right level$level\"></i><span>$title</span></a>\r\n";
					$html = $html . popup_tree_menu($val['_child'], $level);
					$html = $html . "</li>\r\n";
				} else {
					$html = $html . "<li>\r\n<a class=\"$del_class\" node=\"$id\" ><i class=\"fa fa-angle-right level$level\"></i><span>$title</span></a>\r\n</li>\r\n";
				}
			}
		}
		$html = $html . "</ul>\r\n";
	}
	return $html;
}

function sub_tree_menu($tree, $level = 0) {
	$level++;
	$html = "";
	if (is_array($tree)) {
		$html = "<ul class=\"tree_menu\">\r\n";
		foreach ($tree as $val) {
			if (isset($val["name"])) {
				$title = $val["name"];
				$id = $val["id"];
				if (empty($val["id"])) {
					$id = $val["name"];
				}
				if (isset($val['_child'])) {
					$html = $html . "<li>\r\n<a node=\"$id\"><i class=\"fa fa-angle-right level$level\"></i><span>$title</span></a>\r\n";
					$html = $html . sub_tree_menu($val['_child'], $level);
					$html = $html . "</li>\r\n";
				} else {
					$html = $html . "<li>\r\n<a  node=\"$id\" ><i class=\"fa fa-angle-right level$level\"></i><span>$title</span></a>\r\n</li>\r\n";
				}
			}
		}
		$html = $html . "</ul>\r\n";
	}
	return $html;
}

function dropdown_menu($tree, $level = 0) {
	$level++;
	$html = "";
	if (is_array($tree)) {
		foreach ($tree as $val) {
			if (isset($val["name"])) {
				$title = $val["name"];
				$id = $val["id"];
				if (empty($val["id"])) {
					$id = $val["name"];
				}
				if (isset($val['_child'])) {
					$html = $html . "<li id=\"$id\" class=\"level$level\"><a>$title</a>\r\n";
					$html = $html . dropdown_menu($val['_child'], $level);
					$html = $html . "</li>\r\n";
				} else {
					$html = $html . "<li  id=\"$id\"  class=\"level$level\">\r\n<a>$title</a>\r\n</li>\r\n";
				}
			}
		}
	}
	return $html;
}

function f_encode($str) {
	$str = base64_encode($str);
	$str = rand_string(10) . $str . rand_string(10);
	$str = str_replace("+", "-", $str);
	$str = str_replace("/", "_", $str);
	$str = str_replace("==", "*", $str);
	return $str;
}

function f_decode($str) {
	$str = str_replace("-", "+", $str);
	$str = str_replace("_", "/", $str);
	$str = str_replace("*", "==", $str);
	$str = substr($str, 10, strlen($str) - 20);
	$str = base64_decode($str);
	return $str;
}

function u_str_pad($cnt, $str) {
	$tmp = '';
	for ($i = 1; $i <= $cnt; $i++) {
		$tmp = $tmp . $str;
	}
	return $tmp;
}

function show_contact($str, $mode = "show") {
	$tmp = '';

	if (!empty($str)) {
		$contacts = array_filter(explode(';', $str));
		if (count($contacts) > 1) {
			foreach ($contacts as $contact) {
				$arr = explode('|', $contact);
				$name = htmlspecialchars(rtrim($arr[0]));
				$email = htmlspecialchars(rtrim($arr[1]));
				if ($mode == "edit") {
					$tmp = $tmp . "<span data=\"$email\"><nobr><b  title=\"$email\">$name</b><a class=\"del\" title=\"删除\"><i class=\"fa fa-times\"></i></a></nobr></span>";
				} else {
					$tmp = $tmp . "<a email=\"$email\" title=\"$email\" >$name;</a>&nbsp;";
				}
			}
		} else {
			$arr = explode('|', $contacts[0]);
			$name = htmlspecialchars(rtrim($arr[0]));
			$email = htmlspecialchars(rtrim($arr[1]));
			$tmp = "";
			if ($mode == "edit") {
				$tmp = $tmp . "<span data=\"$email\"><nobr><b  title=\"$email\">$name</b><a class=\"del\" title=\"删除\"><i class=\"fa fa-times\"></i></a></nobr></span>";
			} else {
				$tmp = $tmp . "<a email=\"$email\" title=\"$email\" >$name</a>";
			}
		}
	}
	return $tmp;
}

function show_recent($str) {
	$contacts = explode(';', $str);
	if (count($contacts) > 2) {
		foreach ($contacts as $contact) {
			if (strlen($contact) > 6) {
				$arr = explode('|', $contact);
				$name = rtrim($arr[0]);
				$email = rtrim($arr[1]);
				$tmp = $tmp . "<li><span title=\"$email\">$name</span></li>";
			}
		}
	} else {
		$arr = explode('|', $contacts[0]);
		$name = rtrim($arr[0]);
		$email = rtrim($arr[1]);
		$tmp = "";
		$tmp = $tmp . "<li><span title=\"$email\">$name</span></li>";
	}
	return $tmp;
}

function not_dept($val) {
	if (strrchr($val, "dept@group")) {
		return false;
	} else {
		return true;
	}
}

// 自动转换字符集 支持数组转换
function auto_charset($fContents, $from, $to) {
	$from = strtoupper($from) == 'UTF8' ? 'utf-8' : $from;
	$to = strtoupper($to) == 'UTF8' ? 'utf-8' : $to;
	if (strtoupper($from) === strtoupper($to) || empty($fContents) || (is_scalar($fContents) && !is_string($fContents))) {
		//如果编码相同或者非字符串标量则不转换
		return $fContents;
	}
	if (is_string($fContents)) {
		if (function_exists('mb_convert_encoding')) {
			return mb_convert_encoding($fContents, $to, $from);
		} elseif (function_exists('iconv')) {
			return iconv($from, $to, $fContents);
		} else {
			return $fContents;
		}
	} elseif (is_array($fContents)) {
		foreach ($fContents as $key => $val) {
			$_key = auto_charset($key, $from, $to);
			$fContents[$_key] = auto_charset($val, $from, $to);
			if ($key != $_key)
				unset($fContents[$key]);
		}
		return $fContents;
	} else {
		return $fContents;
	}
}

function getExt($filename) {
	$pathinfo = pathinfo($filename);
	return $pathinfo['extension'];
}

function del_html($str) {
	$str = trim($str);
	$str = preg_replace("/<[^>]*>/i", "", $str);
	$str = ereg_replace("\t", "", $str);
	$str = ereg_replace("\r\n", "", $str);
	$str = ereg_replace("\r", "", $str);
	$str = ereg_replace("\n", "", $str);
	$str = ereg_replace("&nbsp;", "", $str);
	$str = ereg_replace(" ", "", $str);
	$str = ereg_replace("{br}", "<br/>", $str);
	$str = ereg_replace("{}", "&nbsp;", $str);
	return $str;
}

function getfilecounts($ff) {
	$dir = './' . $ff;
	$handle = opendir($dir);
	$i = 0;
	while (false !== $file = (readdir($handle))) {
		if ($file !== '.' && $file != '..') {
			$i++;
		}
	}
	closedir($handle);
	return $i;
}

function show_refer($emp_list) {
	$arr_emp_no = array_filter(explode('|', $emp_list));
	if (count($arr_emp_no) > 1) {
		$model = D("UserView");
		foreach ($arr_emp_no as $emp_no) {
			$where['emp_no'] = array('eq', substr($emp_no, 4));
			$emp = $model -> where($where) -> find();
			$emp_no = $emp['emp_no'];
			$user_name = $emp['name'];
			$position_name = $emp['position_name'];
			$str .= "<span data=\"$emp_no\" id=\"$emp_no\"><nobr><b title=\"$user_name/$position_name\">$user_name/$position_name</b></nobr><b>;&nbsp;</b></span>";
		}
		return $str;
	} else {
		return "";
	}
}

function show_file($add_file) {
	$files = array_filter(explode(';', $add_file));
	foreach ($files as $file) {
		if (strlen($file) > 1) {
			$model = M("File");
			$where['sid'] = array('eq', $file);
			$File = $model -> where($where) -> field("id,name,size,extension") -> find();
			echo '<div class="attach_file" style="background-image:url(__PUBLIC__/ico/ico_' . strtolower($File['extension']) . '.jpg); background-repeat:no-repeat;"><a target="_blank" href="__URL__/down/attach_id/' . f_encode($File['id']) . '">' . $File['name'] . ' (' . reunit($File['size']) . ')' . '</a>';
			echo '</div>';
		}
	}
}

function reunit($size) {
	$unit = " B";
	if ($size > 1024) {
		$size = $size / 1024;
		$unit = " KB";
	}
	if ($size > 1024) {
		$size = $size / 1024;
		$unit = " MB";
	}
	if ($size > 1024) {
		$size = $size / 1024;
		$unit = " GB";
	}
	return round($size, 2) . $unit;
}

function rotate($a) {
	$b = array();
	if (is_array($a)) {
		foreach ($a as $val) {
			foreach ($val as $k => $v) {
				$b[$k][] = $v;
			}
		}
	}
	return $b;
}

function utf_strlen($string) {
	return count(mb_str_split($string));
}

function utf_str_sub($string, $cnt) {
	$charlist = mb_str_split($string);
	$new = array_chunk($charlist, $cnt);
	return implode($new[0]);
}

function get_letter($string) {
	$charlist = mb_str_split($string);
	return implode(array_map("getfirstchar", $charlist));
}

function mb_str_split($string) {
	// Split at all position not after the start: ^
	// and not before the end: $
	return preg_split('/(?<!^)(?!$)/u', $string);
}

function getfirstchar($s0) {
	$fchar = ord(substr($s0, 0, 1));
	if (($fchar >= ord("a") and $fchar <= ord("z")) or ($fchar >= ord("A") and $fchar <= ord("Z")))
		return strtoupper(chr($fchar));
	$s = iconv("UTF-8", "GBK", $s0);
	$asc = ord($s{0}) * 256 + ord($s{1}) - 65536;
	if ($asc >= -20319 and $asc <= -20284)
		return "A";
	if ($asc >= -20283 and $asc <= -19776)
		return "B";
	if ($asc >= -19775 and $asc <= -19219)
		return "C";
	if ($asc >= -19218 and $asc <= -18711)
		return "D";
	if ($asc >= -18710 and $asc <= -18527)
		return "E";
	if ($asc >= -18526 and $asc <= -18240)
		return "F";
	if ($asc >= -18239 and $asc <= -17923)
		return "G";
	if ($asc >= -17922 and $asc <= -17418)
		return "H";
	if ($asc >= -17417 and $asc <= -16475)
		return "J";
	if ($asc >= -16474 and $asc <= -16213)
		return "K";
	if ($asc >= -16212 and $asc <= -15641)
		return "L";
	if ($asc >= -15640 and $asc <= -15166)
		return "M";
	if ($asc >= -15165 and $asc <= -14923)
		return "N";
	if ($asc >= -14922 and $asc <= -14915)
		return "O";
	if ($asc >= -14914 and $asc <= -14631)
		return "P";
	if ($asc >= -14630 and $asc <= -14150)
		return "Q";
	if ($asc >= -14149 and $asc <= -14091)
		return "R";
	if ($asc >= -14090 and $asc <= -13319)
		return "S";
	if ($asc >= -13318 and $asc <= -12839)
		return "T";
	if ($asc >= -12838 and $asc <= -12557)
		return "W";
	if ($asc >= -12556 and $asc <= -11848)
		return "X";
	if ($asc >= -11847 and $asc <= -11056)
		return "Y";
	if ($asc >= -11055 and $asc <= -10247)
		return "Z";
	return null;
}

function get_folder_name($id) {

	if ($id == 1) {
		return "收件箱";
	}
	if ($id == 2) {
		return "已发送";
	}
	if ($id == 3) {
		return "草稿箱";
	}
	if ($id == 4) {
		return "已删除";
	}
	if ($id == 5) {
		return "垃圾邮件";
	}

	$model = D("UserFolder");
	$result = $model -> where("id=$id") -> getField("name");
	if ($result) {
		return $result;
	} else {
		return null;
	}
}

function mail_org_string($vo) {
	$count = 0;
	if (!empty($vo['sender_check']) && $count < 1) {
		$count++;
		if ($vo["sender_option"] == 1) {
			$str1 = "包含";
		} else {
			$str1 = "不包含";
		}
		$str2 = $vo['sender_key'];

		$str3 = get_folder_name($vo["to"]);

		$html = "发件人" . $str1 . " " . $str2 . " 则 : 移动到 " . $str3;
	};

	if (!empty($vo['domain_check']) && $count < 1) {
		$count++;
		if ($vo["domain_option"] == 1) {
			$str1 = "包含";
		} else {
			$str1 = "不包含";
		}
		$str2 = $vo['domain_key'];

		$str3 = get_folder_name($vo["to"]);

		$html = "发件域" . $str1 . " " . $str2 . " 则 : 移动到 " . $str3;
	};

	if (!empty($vo['recever_check']) && $count < 1) {
		$count++;
		if ($vo["recever_option"] == 1) {
			$str1 = "包含";
		} else {
			$str1 = "不包含";
		}
		$str2 = $vo['recever_key'];

		$str3 = get_folder_name($vo["to"]);

		$html = "收件人" . $str1 . " " . $str2 . " 则 : 移动到 " . $str3;
	};

	if (!empty($vo['title_check']) && $count < 1) {
		$count++;
		if ($vo["title_option"] == 1) {
			$str1 = "包含";
		} else {
			$str1 = "不包含";
		}
		$str2 = $vo['title_key'];

		$str3 = get_folder_name($vo["to"]);

		$html = "标题中" . $str1 . " " . $str2 . " 则 : 移动到 " . $str3;
	};
	if ($count > 1) {
		$html .= " 等";
	}
	return $html;
}

function status($status) {
	if ($status == 0) {
		return "启用";
	}
	if ($status == 1) {
		return "禁用";
	}
}

function crm_status($status) {
	if ($status == 0) {
		return "未审核";
	}
	if ($status == 1) {
		return "通过";
	}
	if ($status == 2) {
		return "拒绝";
	}
}

function todo_status($status) {
	if ($status == 1) {
		return "尚未进行";
	}
	if ($status == 2) {
		return "正在进行";
	}
	if ($status == 3) {
		return "完成";
	}
}

function mb_unserialize($serial_str) {
	$out = preg_replace('!s:(\d+):"(.*?)";!se', "'s:'.strlen('$2').':\"$2\";'", $serial_str);
	return unserialize($out);
}

function get_sid() {
	return md5(bin2hex(time()) . rand_string());
}

function get_position_name($id) {
	$data = D('UserView') -> find($id);
	//dump($data);
	return $data['position_name'];
}

function get_emp_pic($id) {
	$data = M("User") -> where("id=$id") -> getField("pic");
	if (empty($data)) {
		$data = get_save_path() . "emp_pic/no_avatar.jpg";
	}
	return $data;
}

function task_status($status) {
	if ($status == 0) {
		return "等待接受";
	}
	if ($status == 1) {
		return "已接受";
	}
	if ($status == 2) {
		return "进行中";
	}
	if ($status == 3) {
		return "已完成";
	}
	if ($status == 4) {
		return "已下发";
	}
	if ($status == 5) {
		return "不接受";
	}
}

function task_log_status($status) {
	if ($status == 0) {
		return "等待接受";
	}
	if ($status == 1) {
		return "已接受";
	}
	if ($status == 2) {
		return "进行中";
	}
	if ($status == 3) {
		return "已完成";
	}
	if ($status == 4) {
		return "已下发";
	}
	if ($status == 5) {
		return "不接受";
	}
}

function finish_rate($rate) {
	if ($rate == 0) {
		return "任务未开始执行";
	}
	if ($rate > 0 and $rate < 100) {
		return "任务已完成$rate%";
	}
	if ($rate == 100) {
		return "任务已完成";
	}
}

function is_submit($val) {
	if ($val == 0) {
		return "临时保管";
	}
	if ($val == 1) {
		return "已提交";
	}
}
function get_task_name($id){
	$task = M("Task") -> where("id = $id") ->  getField('name');
	return $task;
}

function task_todo($task_type){ //我的待办任务
	$uid=get_user_id();
	$str = "";
			$where['type'] = array('in', $task_type);
			$task_todo_list = M("Task") -> where($where) ->  getField('id name,id');
			
			$where_log['type'] = 1;
			$where_log['status'] = array("in","0,1,2,5"); // 未完成
			$where_log['executor'] = $uid;
			$where_log['task_id'] = array('in', $task_todo_list);
			$task_list = M("TaskLog") -> where($where_log)->order('id desc') -> select();
			$count = M("TaskLog") -> where($where_log) -> count();
			for ($i=0; $i < $count; $i++) { 
				$str = $str."
					<li> <a href=".__APP__."/task/read?id=".$task_list[$i]['task_id']." title=>【".$task_list[$i]['executor_name']."】 ".get_task_name($task_list[$i]['task_id'])."  ".task_log_status($task_list[$i]['status'])." ".$task_list[$i]['finish_time']." </a></li>";
			}

			return $str;
}
function task_ing($task_type){ //我发起的任务，所有log
	$uid=get_user_id();
	$str = "";
			$where['type'] = array('in', $task_type);
			$task_todo_list = M("Task") -> where($where) ->  getField('id name,id');
			
			$where_log['type'] = 1;
			$where_log['status'] = array("in","0,1,2,5"); // 未完成
			$where_log['assigner'] = $uid;
			$where_log['task_id'] = array('in', $task_todo_list);
			$task_list = M("TaskLog") -> where($where_log)->order('id desc') -> select();
			$count = M("TaskLog") -> where($where_log) -> count();
			for ($i=0; $i < $count; $i++) { 
				$str = $str."
					<li> <a href=".__APP__."/task/read?id=".$task_list[$i]['task_id']." title=>【".$task_list[$i]['executor_name']."】 ".get_task_name($task_list[$i]['task_id'])."  ".task_log_status($task_list[$i]['status'])." ".$task_list[$i]['finish_time']." </a></li>";
			}

			return $str;
}
function task_done($task_type){ //我完成的任务，发起的且完成的，所有log
	$uid=get_user_id();
	$str = "";
			$where['type'] = array('in', $task_type);
			$task_todo_list = M("Task") -> where($where) ->  getField('id name,id');
			
			$where_log['type'] = 1;
			$where_log['status'] = array("in","3,4");
			$where_log['assigner|executor|transactor'] = $uid;
			$where_log['task_id'] = array('in', $task_todo_list);
			$task_list = M("TaskLog") -> where($where_log)->order('id desc') -> select();
			$count = M("TaskLog") -> where($where_log) -> count();
			for ($i=0; $i < $count; $i++) { 
				$str = $str."
					<li> <a href=".__APP__."/task/read?id=".$task_list[$i]['task_id']." title=>【".$task_list[$i]['executor_name']."】 ".get_task_name($task_list[$i]['task_id'])."  ".task_log_status($task_list[$i]['status'])." ".$task_list[$i]['finish_time']." </a></li>";
			}

			return $str;
}
function flow_todo($flow_type){ //我的待办流程
	$uid=get_user_id();
	$str = "";
			$where['type'] = array('in', $flow_type);
			$flow_todo_list = M("Flow") -> where($where) ->  getField('id name,id');
			
			
			$where_log['result'] = array("in","3"); // 未完成
			$where_log['user_id'] = $uid;
		//	$where_log['flow_id'] = array('in', $flow_todo_list);
			$flow_list = M("FlowLog") -> where($where_log)->order('id desc') -> select();
			$count = M("FlowLog") -> where($where_log) -> count();
			for ($i=0; $i < $count; $i++) { 
				$flow = M("Flow") -> where('id='.$flow_list[$i]['flow_id']) -> find();
				$str = $str."
					<li> <a href=".__APP__."/flow/read?id=".$flow_list[$i]['flow_id']." title=>【".$flow_list[$i]['user_name']."】 ".$flow['name']."  ".show_result($flow_list[$i]['result'])." </a></li>";
			}

			return $str;
}

function flow_ing($flow_type){ //我发起的流程
	$uid=get_user_id();
	$str = "";
			$where['type'] = array('in', $flow_type);
			$where['step'] = array("not in","40,0");
			$where['user_id'] = $uid;
			$flow_list = M("Flow") -> where($where)->order('id desc') ->  select();
			$count =  M("Flow") -> where($where)  -> count();
			
			for ($i=0; $i < $count; $i++) { 
				$flow = M("Flow") -> where('id='.$flow_list[$i]['flow_id']) -> find();
				$str = $str."
					<li> <a href=".__APP__."/flow/read?id=".$flow_list[$i]['id']." title=>【".$flow_list[$i]['user_name']."】 ".$flow_list[$i]['name']."  ".show_step($flow_list[$i]['step'])." </a></li>";
			}
			return $str;
}
function flow_done($flow_type){ //我发起的流程,已被审批的
	$uid=get_user_id();
	$str = "";
			$where['type'] = array('in', $flow_type);
			$where['step'] = array("in","40,0");
			$where['user_id'] = $uid;
			$flow_list = M("Flow") -> where($where)->order('id desc') ->  select();
			$count =  M("Flow") -> where($where)  -> count();
			
			for ($i=0; $i < $count; $i++) { 
				$flow = M("Flow") -> where('id='.$flow_list[$i]['flow_id']) -> find();
				$str = $str."
					<li> <a href=".__APP__."/flow/read?id=".$flow_list[$i]['id']." title=>【".$flow_list[$i]['user_name']."】 ".$flow_list[$i]['name']."  ".show_step($flow_list[$i]['step'])." </a></li>";
			}
			return $str;
}

function task_log_deel($itemid){
	$uid=get_user_id();
	$log =M('task_log')->find($itemid);
	if($log['score'] == 3){
		$str = '通过';
	}else if($log['score'] == 5){
		$str = '退回';
	}else{
		$str = '<a type="button" class="btn-xs btn btn-success" href="__APP__/task/deel/type/3/logid/'.$itemid.'">通过</a>
				<a type="button" class=" btn-xs btn btn-danger" href="__APP__/task/deel/type/5/logid/'.$itemid.'">退回</a>';
	}
	return $str;
}
//--------------------------------------------------------------------
//  流程任务
//--------------------------------------------------------------------
function task_step_status($task_id,$step){
	 $uid=get_user_id();
	 $ids = M('task_log')->where("task_id=".$task_id." and step =".$step)->getField('id name,id'); //select();
	 
	//情况一 自己已转，或已完成  有
	$row1 = M('task_log')->where("task_id=".$task_id."  and status in (3,4)  and executor=".$uid." and step=".$step)->select(); 
	//情况二 全部已转，或已完成 无 
	$row2 = M('task_log')->where("task_id=".$task_id."  and status in (0,1,2)  and step=".$step)->select(); 
	//情况三 自己是被转给的  有
	$row3 = M('task_log')->where("task_id=".$task_id."  and  step=".(int) ($step+1)."  and executor=".$uid)->select(); 
	//情况四 自己分配的完已完成 
	$row4 = M('task_log')->where("task_id=".$task_id."   and step=".$step." and assigner=".$uid)->avg('status'); 
	//情况五 自己是被转给的, 且已完成  有！
	$row5 = M('task_log')->where("task_id=".$task_id."  and status in (3,4)   and step=".(int) ($step+1)." and executor=".$uid)->select(); 
	//情况六 所有已完成  无
	$row6 = M('task_log')->where("task_id=".$task_id."  and status in (0,1,2)  ")->select(); 
	//情况七 不选已完成， 但进度为100％
	$row7 = M('task_log')->where("task_id=".$task_id."  and status =2 and finish_rate = 100  and executor=".$uid." and step=".$step)->select(); 
	
		if (!empty($ids) AND ( !empty($row1) or !empty($row7) or !empty($row3) or !empty($row5) or empty($row6) or ($row4>2) or empty($row2) ) ){ // 
			$result =1;
		}
	
	//dump($row2);
	return $result;
}
function flow_step_status($flow_id,$step){
	$step = '2'.$step;
	//情况一 自己已发
	$row = M('flow_log')->where("flow_id=".$flow_id."  and result in (0,1) and step=".(int) $step)->select(); 
	//情况二  别人发，自己审批
//	$row = M('flow_log')->where("flow_id=".$flow_id."  and result in (0,1) and step=".(int) $step)->select(); 
	
	if (!empty($row)) {
		$result =1;
	}
	
	return $result;
}
function left_menu_status($typeid,$uid){
	$where['type'] = $typeid;
	if(!empty($uid)){
		$where['user_id'] = $uid;
	}
		$taskName = M('taskType')->where('type = "'.$typeid.'"')->getField('name');
		$task = M('task')->where($where)->order('id desc')->find();
	
		if(!empty($task)){
			$color = ' style="background-color:#1ab840!important;color:#fff!important" ';
		}else{
			$color = '';//style="background-color:#d15a47!important;color:#fff!important"
		}
		$result ='<a '.$color.' href="'.U("grzhongxin/myjob").'?id='.$uid.'&tasktype='.$typeid.'">
			<i class="fa fa-angle-right"></i><span class="menu-text">'.$taskName.' </span></a>';
	
//	dump($uid);
	return $result;
}
function show_bottons_status($type,$typeid,$uid){
	$where['type'] = $typeid;
	if(!empty($uid)){
		$where['user_id'] = $uid;
	}
	if($type == 'flow'){
		$flowName = M('flowType')->where('id = '.$typeid)->getField('name');
		$flow = M('flow')->where($where)->order('id desc')->find();
		if($flow['step'] == 40){
			$color = 'success';
		}else if($flow['step'] >0){
			$color = 'danger';
		}
		$result ='<a href="'.U("flow/add").'/type/'.$typeid.'" class="btn btn-'.$color.'"> '.$flowName.'</a>';
		
	}else if($type == 'task'){
		$taskName = M('taskType')->where('type = "'.$typeid.'"')->getField('name');
		$task = M('task')->where($where)->order('id desc')->find();
	
		if(!empty($task)){
			$color = 'success';
		}else{
			$color = 'danger';
		}
		$result ='<a href="'.U("task/add").'/type/'.$typeid.'" class="btn btn-'.$color.'"> '.$taskName.'</a>';
	}else{
		$result ='<a href="#" class="btn btn-info">参数错误</a>';
	}
	//dump($typeid);
	return $result;
}
function flow_bottons($type){ //无用
	$step = 5;
	$bottons =M('step')->where('task_type = '.$type)->select();
	$task = M('task')->where('type = '.$type)->order('id desc')->find();
	if(!empty($task)){
		$url =U("task/read").'/id/'.$task['id'];
	}else{
		$url =U("task/add").'/type/'.$type;
	}
	for ($i=0; $i < count($bottons); $i++) { 
		$str=$str.'
			<a href="'.$url.'" class="btn btn-default"> '.$bottons[$i][name].'</a>';
		if ($i < count($bottons) -1) {
			$str=$str.'<i class="fa fa-arrow-right"></i>';
		}
	}
	//dump(count($bottons));
	return $str;
}
//--------------------------------------------------------------------
//  发送邮件
//--------------------------------------------------------------------
function send_mail($email, $name, $title, $body) {

	$mail_account = C('ADMIN_MAIL_ACCOUNT');

	//header('Content-type:text/html;charset=utf-8');
	//vendor("Mail.class#send");
	import("@.ORG.Util.send");
	//从PHPMailer目录导入class.send.php类文件
	$mail = new PHPMailer(true);
	// the true param means it will throw exceptions on errors, which we need to catch
	$mail -> IsSMTP();
	// telling the class to use SMTP
	try {
		$mail -> Host = $mail_account['smtpsvr'];
		//"smtp.qq.com"; // SMTP server 部分邮箱不支持SMTP，QQ邮箱里要设置开启的
		$mail -> SMTPDebug = false;
		// 改为2可以开启调试
		$mail -> SMTPAuth = true;
		// enable SMTP authentication
		$mail -> Port = 25;
		// set the SMTP port for the GMAIL server
		$mail -> CharSet = "UTF-8";
		// 这里指定字符集！解决中文乱码问题
		$mail -> Encoding = "base64";
		$mail -> Username = $mail_account['mail_id'];
		// SMTP account username
		$mail -> Password = $mail_account['mail_pwd'];
		// SMTP account password
		$mail -> SetFrom($mail_account['email'], $mail_account['mail_name']);

		//发送者邮箱

		$mail -> AddReplyTo($mail_account['email'], $mail_account['mail_name']);
		//回复到这个邮箱
		$mail -> AddAddress($email, $name);
		$mail -> Subject = "=?UTF-8?B?" . base64_encode($title) . "?=";
		//嵌入式图片处理
		$mail -> MsgHTML($body);

		if ($mail -> Send()) {

		} else {
			$this -> error($name . '该用户未设置邮箱,暂时不能收到邮件,请通过其他方式告知,以免耽误任务进度');
		};
	} catch (phpmailerException $e) {
		//echo $e -> errorMessage();
		//Pretty error messages from PHPMailer
	} catch (Exception $e) {
		//echo $e -> getMessage();
		//Boring error messages from anything else!
	}
}

function get_leader_id() {
	return 1;
}
//通过ID获取标题内容
function get_flow_name($flowid) {
	$flow=M("flow")->where("id=".$flowid)->getField('name');
	return $flow;
}

function notice_read($id){
	$uid =get_user_id();
	$result = M('notice_sign')->where('notice_id='.$id.' and user_id='.$uid)->select();
	if (!empty($result)) {
		return '';//已读
	}else {
		return '<span class="badge badge-pink">新</span>';
	}
}
	

function get_action_weekone($week, $one,$type){
   
	$User = M("user"); // 实例化User对象
	if (!empty($_GET['id'])) {
		$uid = $_GET['id'];
	}else {
		$uid  = get_user_id();
	}
    $nickname = $User->where('id='.$uid)->getField('name');
	//dump($nickname);
	//die(); 
		if($type!="")
		{
	$oneweek=M('document_syllabus')->where("week=$week and one='$one' and teacher= '".$nickname."' and type='$type' ")->select();
	$coun=M('document_syllabus')->where("week=$week and one='$one'  and teacher= '".$nickname."'  and type='$type' ")->count();
		}else
		{
		$oneweek=M('document_syllabus')->where("week=$week and one='$one' and teacher= '".$nickname."'  ")->select();
		$coun=M('document_syllabus')->where("week=$week and one='$one'  and teacher= '".$nickname."' ")->count();
		}
		$str ="";
	if($coun!=0)
	{
	for($i = 0; $i<$coun;$i++){
		$str=$str.$oneweek[$i]['course']." (".$oneweek[$i]['period'].")</b><br /><small>".$oneweek[$i]['wfs']." /".$oneweek[$i]['place']." </small><br />";
		// "<b>".$oneweek[$i]['teacher']." --".   课时   起止周：  地点：
	}
	}else
	{
		$str=$str. "<span week=$week one=$one  href='#a'  data-original-title=''>－－</span>";
	}
	return $str ;
	
}
//全体教师
function allget_action_weekone($week, $one,$type){

	$User = M("user"); // 实例化User对象
    $nickname = $User->where('id='. get_user_id())->getField('name');
 	if ($type !="") {
 		$string = "and type=$type";
 	}
	$two =$_GET['two'];
	//dump($two);
 	if ($two !="") {
 		$string = " and two='$two' ";
 	}
	if(get_user_id()!='102')
	{
	$oneweek=M('document_syllabus')->where("week=$week and one='$one' ".$string)->select();
	$coun=M('document_syllabus')->where("week=$week and one='$one' ".$string)->count();

	$str ="";
	if($coun!=0)
	{
		for($i = 0; $i<$coun;$i++){
			$num =$i+1;
			$str=$str." <b class='text-success'>".$num." ".$oneweek[$i]['teacher']." - ".$oneweek[$i]['course']." (".$oneweek[$i]['period']."课时)</b><br /><small>起止周：".$oneweek[$i]['wfs']." -地点：".$oneweek[$i]['place']." </small><br />";
		}
	}else{
			$str=$str. "<span week=$week one=$one  href='#a'  data-original-title=''>－－</span>";
	}
	return $str ;
	}else{
	   if($type!="")
		{
			$oneweek=M('document_syllabus')->where("week=$week and one='$one' ".$string)->select();
			$coun=M('document_syllabus')->where("week=$week and one='$one' ".$string)->count();
		}else{
		
			$oneweek=M('document_syllabus')->where("week=$week and one='$one'".$string)->select();
	
	$coun=M('document_syllabus')->where("week=$week and one='$one'".$string)->count();
		}
		$str ="";
	if($coun!=0)
	{
		for($i = 0; $i<$coun;$i++){
			$num =$i+1;
			$str=$str." <b><a week=$week one=$one  uid=".$oneweek[$i]['id']." href='#a' data-toggle='modal' data-original-title=''>".$num." ".$oneweek[$i]['teacher']." - ".$oneweek[$i]['course']." (".$oneweek[$i]['period']."课时)  </a></b><br /><small>起止周：".$oneweek[$i]['wfs']." - 地点：".$oneweek[$i]['place']." </small><br />";
		}
		$str=$str. "<a class='btn btn-success btn-xs' week=$week one=$one  href='#a' data-toggle='modal' data-original-title=''>添加课程</a>";
	}else
	{
		$str=$str. "<a class='btn btn-success btn-xs' week=$week one=$one  href='#a' data-toggle='modal' data-original-title=''>添加课程</a>";
	}
	return $str ;
	}
}
/**
 * 取得空闲老师列表
 */

function Free_teacher($week, $one){

	$Model =  new \Think\Model(); 
	$weekone=$Model->query("SELECT * from onethink_member AS u where u.uid!=(SELECT  uid from onethink_document_syllabus AS cx where cx.week=$week and cx.one=$one)");
	
	//dump(count($weekone));
	$str="";
	for($i=0;$i<(count($weekone));$i++)
	{
	$str =$str."<option value=".$weekone[$i]['uid'].">".$i.' - '.$weekone[$i]['nickname']."</option>";
	}
	return $str;
	//dump($oneweek);

}
//通过ID 用户姓名
function get_user_ssk($id) {
	$user=M("user")->where("id=".$id)->getField('name');
	return $user;
}

function jiao_an($type){
	$uid = get_user_id();
	$str = '<table class="table table-striped table-bordered table-condensed" style="margin:30px 20px; width:95%;clear:both;">';
	$n=0;
	$max=3;
	for($i=0;$i<=5;$i++){
		$str = $str."<tr>";
		for($n;$n<=$max;$n++){
			$status = M("flow")->where("type = $type and jiaoan = ".$n." and user_id=".$uid)->getField('step');
			$flowid = M("flow")->where("type = $type and jiaoan = ".$n." and user_id=".$uid)->getField('id');
			if ($status == 40) {
				$color="success";
				$url = "href='__APP__/flow/read?id=$flowid'";
			}else if($status == 20){
				$color="danger";
				$url = "href='__APP__/flow/edit?id=$flowid'";
			}else{
				$color="";
				$url = "href='__APP__/flow/add?type=$type&jiaoan=$n'";
			}
			$str = $str."<td class='".$color."'><a   ".$url.">第".$n."周</a></td>";
		}
		$str = $str."</tr>";
		$max  = $max+4;
	}
	$str = $str.'</tr></table>';
	return $str;
}

function get_photo($url,$filename='',$savefile='test/')   
{     
    $imgArr = array('gif','bmp','png','ico','jpg','jepg');  
  
    if(!$url) return false;  
    
    if(!$filename) {     
      $ext=strtolower(end(explode('.',$url)));     
     // if(!in_array($ext,$imgArr)) return false;  
      $filename=date("YmdHis").'.jpg';     
    }     
  
    if(!is_dir($savefile)) mkdir($savefile, 0777);  
    if(!is_readable($savefile)) chmod($savefile, 0777);  
      
    $filename = $savefile.$filename;  
  
    ob_start();     
    readfile($url);     
    $img = ob_get_contents();     
    ob_end_clean();     
    $size = strlen($img);     
    
    $fp2=@fopen($filename, "a");     
    fwrite($fp2,$img);     
    fclose($fp2);     
    
    return $filename;     
 } 
 function get_dept_sort($depid){
	 if (empty($depid)) {
	 	$depid = get_dept_id();
	 }
	 $sort = M("dept")->where("id=".$depid)->getField("sort");
	 return $sort;
 }
 
 function getToDoNum(){
	$task=M('task');
	$wherelog['executor'] =  get_user_id();
	$wherelog['status'] =  array('in','0,1');
	$task_ids =M('task_log')->where($wherelog)->getField("task_id id,task_id");
	$where['id'] =  array('in',$task_ids);
	$count1=$task->where($where)->count();
	

	$model = D('Flow');
	$user_id = get_user_id();
	$emp_no = get_emp_no();
	$FlowLog = M("FlowLog");
	$where['emp_no'] = $emp_no;
	$where['_string'] = "result is null";
	$log_list = $FlowLog -> where($where) -> field('flow_id') -> select();
	$log_list = rotate($log_list);
		$map['id'] = array('in', $log_list['flow_id']);
		$count2 = $model -> where($map) -> field("id,name,create_time") -> limit(6) -> count();
	
	//$count2=$flow->where('confirm like "%'.get_emp_no().'%" AND step != 40')->count();
	$result = $count1+$count2;
	return $result;
 }
?>