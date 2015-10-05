<?php
/*---------------------------------------------------------------------------
 

 Copyright (c) 2015 http://www.thinkphp.com All rights reserved.

 Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )

 Author:  thinkphp.com

 Support: http://www.thinkphp.com
 -------------------------------------------------------------------------*/

class TaskAction extends CommonAction {
	protected $config = array('app_type' => 'common', 'action_auth' => array('test' => 'admin', 'let_me_do' => 'read', 'accept' => 'read', 'reject' => 'read', 'save_log' => 'read'));

	//过滤查询字段
	function _search_filter(&$map) {
		$map['is_del'] = array('eq', '0');
		if (!empty($_REQUEST['keyword']) && empty($map['64'])) {
			$map['name'] = array('like', "%" . $_POST['keyword'] . "%");
		}
	}

	public function index() {
		U('folder', array('fid' => 'all'), true, true);
	}

	public function folder() {
		D("Role")->get_auth('Task');
		$widget['date'] = true;
		$this -> assign("widget", $widget);
		$this -> assign('auth', $this -> config['auth']);
		$this -> assign('user_id', get_user_id());

		$where = $this -> _search();
		if (method_exists($this, '_search_filter')) {
			$this -> _search_filter($where);
		}

		$fid = $_GET['fid'];
		$this -> assign("fid", $fid);

		switch ($fid) {
			case 'all' :
				$this -> assign("folder_name", '所有任务');
				break;
			case 'todo' :
				$this -> assign("folder_name", '等待我接受的任务');

				$where_log['type'] = 1;
				$where_log['status'] = 0;
				$where_log['executor'] = get_user_id();
				$task_list = M("TaskLog") -> where($where_log) -> getField('task_id id,task_id');
				$where['id'] = array('in', $task_list);
				break;

			case 'dept' :
				$this -> assign("folder_name", '我们部门的任务');
				$auth = $this -> config['auth'];

				if ($auth['admin']) {
					$where_log['type'] = 2;
					$where_log['executor'] = get_dept_id();
					$task_list = M("TaskLog") -> where($where_log) -> getField('task_id id,task_id');
					$where['id'] = array('in', $task_list);
				} else {
					$where['_string'] = '1=2';
				}
				break;
			case 'no_assign' :
				$this -> assign("folder_name", '不知让谁处理的任务');

				$prefix = C('DB_PREFIX');
				$sql = "select id from {$prefix}task task where not exists (select * from {$prefix}task_log task_log where task.id=task_log.task_id)";
				$task_list = M() -> query($sql);
				$where['id'] = array('in', $task_list[0]);

				break;
			case 'no_finish' :
				$this -> assign("folder_name", '未完成的任务');

				$where_log['status'] = array('lt', 2);
				$task_list = M("TaskLog") -> where($where_log) -> getField('task_id id,task_id');
				$where['id'] = array('in', $task_list);

				break;
			case 'finished' :
				$this -> assign("folder_name", '已完成的任务');
				$where['status'] = array('eq', 3);

				break;
			case 'my_task' :
				$this -> assign("folder_name", '我发布的任务');
				$where['user_id'] = get_user_id();
				break;
			case 'my_assign' :
				$this -> assign("folder_name", '我指派的任务');

				$where_log['assigner'] = get_user_id();
				$task_list = M("TaskLog") -> where($where_log) -> getField('task_id id,task_id');
				$where['id'] = array('in', $task_list);

			default :
				break;
		}

		$model = D('Task');
		if (!empty($model)) {
			$this -> _list($model, $where);
		}
		$this -> display();
	}

	public function edit() {
		$widget['uploader'] = true;
		$widget['editor'] = true;
		$widget['date'] = true;
		$this -> assign("widget", $widget);

		$id = $_REQUEST['id'];
		$model = M("Task");
		$folder_id = $model -> where("id=$id") -> getField('folder');
		$this -> assign("auth", D("SystemFolder") -> get_folder_auth($folder_id));
		$this -> _edit();
	}

	public function del($id) {
		$isdo = M('task_log')->where('task_id = '.$id)->max('status');
		if ($isdo >1) {
			$this -> assign('jumpUrl', get_return_url());
			$this -> success('任务已开始，无法删除！'.$isdo);
		}else {
			M('task')->where('id = '.$id)->delete();
			M('task_log')->where('task_id = '.$id)->delete();
			$this -> assign('jumpUrl', get_return_url());
			$this -> success('删除成功'.$isdo);
		}
	//	$this -> _del($id);
	}
	public function add() {
		$type=$_GET['type'];
		
		$this->name = M('task_type')->where('type='.$type)->getField('name');
		$position_id = M('task_type')->where('type='.$type)->getField('step1_position');
		$this->type = $type;
	
		$this -> user=M("user")->where('position_id = '.$position_id)->select();
		// dump($this -> user);
		
		 $touid = $_REQUEST['uid'];
		if (!empty($touid)) {
			$this -> user=M("user")->where('id = '.$touid)->select();
		} 
		$widget['uploader'] = true;
		$widget['editor'] = true;
		$widget['date'] = true;
		$this -> assign("widget", $widget);

		$fid = $_REQUEST['fid'];
		$type = D("SystemFolder") -> where("id=$fid") -> getField("folder");
		$this -> assign('folder', $fid);
		$this -> display();
	}
	
	
	public function deel(){
		$type=$_GET['type'];
		$logid=$_GET['logid'];
		// dump($type);
		if ($type == 5) {
			$data['status'] = 0;
		}if ($type == 3) {
			$data['status'] = 3;
		}
		$data['id'] = $logid;
		$data['score'] = $type;
		$data['done'] = 1;
		$result = M('task_log')->save($data);
		if ($result !== false) {
			$this -> success('评价成功');
		}else {
				$this -> success('评价失败');
			}
	}

	public function read() {
        
        $id = $_REQUEST['id'];
		$UID=get_user_id();
		$this->UID=get_user_id();
	    $type = D("task") -> where("id=".$id) -> getField("user_id");

		$widget['jquery-ui'] = true;
		$widget['editor'] = true;
		$widget['date'] = true;
		$this -> assign("widget", $widget);
		$this -> assign('auth', $this -> config['auth']);

		$this->now = mktime();
		
		$this -> assign('task_id', $id);
		$model = M("Task");
		$vo = $model -> find($id);
		$this -> assign('vo', $vo);
		
		$step = M('task_log')->where('task_id= ' .$id)->max('step');
		$a = M('task_log')->where('step =1 and task_id= ' .$id)->getField('assigner');
		$b = M('task_log')->where('step =1 and task_id= ' .$id)->getField('executor');
		
		
		$types_abab = array("107","301","302","303","304","310","311","312","313","319","342","371");
		if (in_array($vo['type'], $types_abab)) { // abab式
		//if ($vo['type'] == '107') { // abab式
			$this->style = '
				<style>
					.widget-toolbar,#working,#finish{display:none !important}
					#forword{display:block!important}
				</style>
				';
					$this -> zxnr = '说明';
				if ($step ==1) { //第一步
					$this -> user=M("user")->where('id = '.$a)->select();
					$this -> status_name = 'forword';
					$this -> tj = '完成';
				}else if ($step ==2) {
					$this -> user=M("user")->where('id = '.$b)->select();
					$this -> status_name = 'forword';
					$this -> tj = '下一步';
				}else if ($step ==3) {
					$this -> status_name = 'finish';
					$this->style = '
						<style>
							.widget-toolbar,#working,#forword{display:none !important}
							#finish{display:block!important}
						</style>
						';
					$this -> tj = '完成';
				}
				
		}
		
		$types_abc = array("1", "201","106","314","345","334","8","102","1022");
		if (in_array($vo['type'], $types_abc)) { // abc式
	//	if ($vo['type'] == '106') { // abc式
			$this->style = '
				<style>
					.widget-toolbar,#working,#finish{display:none !important}
					#forword{display:block!important}
				</style>
				';
					$this -> zxnr = '说明';
				if ($step ==1) { //第一步
					
					$this -> user=M("user")->where('id = '.$a)->select();
					if($vo['type'] =='1' || $vo['type'] =='201'|| $vo['type'] =='102'|| $vo['type'] =='1022'){
						$this -> forwordto = '要通知的老师';
						if ($vo['type'] =='102'|| $vo['type'] =='1022') {
								$this->style = '
									<style>
										.widget-toolbar,#working,#finish,.limit_time{display:none !important}
										#forword{display:block!important}
									</style>
									';
							//	$this -> user=M("user")->select(); //所有人
						}
					}
					if($vo['type'] == 8 ){
						$this->style = '
							<style>
								.widget-toolbar,.limit_time,#working,#finish{display:none !important}
								#forword{display:block!important}
							</style>
							';
						$this -> user=M("user")->where('position_id = 16')->select();
					}
					$this -> status_name = 'forword';
					$this -> tj = '完成';
				}else if ($step ==2){
					$this -> status_name = 'finish';
					$this->style = '
						<style>
							.widget-toolbar,#working,#forword{display:none !important}
							#finish{display:block!important}
						</style>
						';
					$this -> tj = '完成';
				}
				
		}
		$types_aba = array("105","307","308","309","316","317","318","320","321","322","323","324","325","326","327","328","329","330","331","332","333","335","336","337","338","339","340","341","343","344","345","346","347","348","349","350","351","352","353","354","355","356","357","358","359","360","361","362","363","364","365","366","367","368","369","370","372","373","375","376","377","378","379","380","381","382","383","384","385","386","387","388","389","390","391","392","393","394","3711");
		if (in_array($vo['type'], $types_aba)) { // aba式
			$this->style = '
				<style>
					.widget-toolbar,#working,#finish{display:none !important}
					#forword{display:block!important}
				</style>
				';
					$this -> zxnr = '说明';
				if ($step ==1) { //第一步
					
					$this -> user=M("user")->where('id = '.$a)->select();
					$this -> status_name = 'forword';
					$this -> tj = '完成';
				}else if ($step ==2) {
					$this -> status_name = 'finish';
					$this->style = '
						<style>
							.widget-toolbar,#working,#forword{display:none !important}
							#finish{display:block!important}
						</style>
						';
					$this -> tj = '完成';
				}
		}
		// 第二步为转交的任务
		$forword_types = array( "74", "75", "76", "2074", "2075", "2076", "8", "208", "105", "106");
		if (in_array($vo['type'], $forword_types) and $step ==1)
		{
					$this->style = '
						<style>
							.widget-toolbar,#working,#finish{display:none !important}
							#forword{display:block!important}
						</style>
						';
							$this -> zxnr = '下发说明';
					$this -> user=M("user")->where('id = '.$a)->select();
					$this -> status_name = 'forword';
					$this -> tj = '下一步';
		}
		//教学大岗 、计划、  总结
		$types_abac = array("5",'205','2052',"6",'206','2062','9','209','2092');
		if (in_array($vo['type'], $types_abac)) { // abac式
			$this->style = '
				<style>
					.widget-toolbar,#working,#finish{display:none !important}
					#forword,#limit_time{display:block!important}
				</style>
				';
					$this -> zxnr = '说明';
				if ($step ==1) { //第一步
					$this->style = '
						<style>
							.widget-toolbar,.limit_time,#working,#finish{display:none !important}
							#forword{display:block!important}
						</style>
						';
					$this -> forwordto = '传给';
					$this -> user=M("user")->where('id = '.$a)->select();
					$this -> status_name = 'forword';
					$this -> tj = '下一步';
				}else if ($step ==2) { //第一步
					$this->style = '
						<style>
							.widget-toolbar,.limit_time,#working,#finish{display:none !important}
							#forword{display:block!important}
						</style>
						';
					$this -> forwordto = '传给分管';
					$this -> user=M("user")->where('id = 74')->select();// 苏龙
					$this -> status_name = 'forword';
					$this -> tj = '下一步';
				}else if ($step ==3){
					$this -> status_name = 'finish';
					$this->style = '
						<style>
							.widget-toolbar,#working,#forword{display:none !important}
							#finish{display:block!important}
						</style>
						';
					$this -> tj = '通过';
				}
				
		}
		
		
		
		// 第二步为 完成 的任务   /// 还需添加 哪种type 且第几步 为完成的情况
		$forword_types1 = array("2", "104", "103", "395", "396", "397", "401", "402", "403", "404", "405", "406", "407", "408", "409", "410", "411", "412", "413");
		$forword_types2 = array("1", "201", "74", "75", "76", "2074", "2075", "2076", "8", "208", "105", "106");
		if ((in_array($vo['type'], $forword_types1)  and $step ==1) or	(in_array($vo['type'], $forword_types2)  and $step ==2) )
		{
				
			$this->style = '
				<style>
					.widget-toolbar,#working,#forword{display:none !important}
					#finish{display:block!important}
				</style>
				';
					$this -> zxnr = '说明';
			$this -> user=M("user")->where('id = '.$a)->select();
			$this -> status_name = 'finish';
			$this -> tj = '完成';
		}
		//	dump($step);

		$where_log['task_id'] = array('eq', $id);
		$task_log = M("TaskLog") -> where($where_log) -> select();
		$this -> assign('task_log', $task_log);


       
		if (empty($vo['executor'])) {
			$this -> assign('no_assign', 1);
		} else {

		}

		$where_accept['status'] = 0;
		$where_accept['task_id'] = $id;
		$where_accept['type'] = 1;
		$where_accept['executor'] = array('eq', get_user_id());
		$task_accept = M("TaskLog") -> where($where_accept) -> find();

		if ($task_accept) {
			$this -> assign('is_accept', 1);
			$this -> assign('task_log_id', $task_accept['id']);
		}

		if ($this -> config['auth']['admin']) {
			$where_dept_accept['status'] = 0;
			$where_dept_accept['task_id'] = $id;
			$where_dept_accept['type'] = 2;
			$where_dept_accept['executor'] = array('eq', get_dept_id());
			$task_dept_accept = M("TaskLog") -> where($where_dept_accept) -> find();
			if ($task_dept_accept) {
				$this -> assign('is_accept', 1);
				$this -> assign('task_log_id', $task_dept_accept['id']);
			}
		}

		$where_working['status'] = array('in', '1,2');
		$where_working['task_id'] = $id;
		$where_working['transactor'] = array('eq', get_user_id());
		$task_working = M("TaskLog") -> where($where_working) -> find();
		
		// 获得上一步的id
		$last_log = M("TaskLog") -> where('task_id = '.$id.' and transactor = '.$task_working['assigner'])->order('id desc') -> find(); 
		$this->last_log_id = $last_log['id'];
		
		if ($task_working) {
			$this -> assign('is_working', 1);
			$this -> assign('task_working', $task_working);

		}
		$this -> display();
	}
	public function readSimple() {
        
        $id = $_REQUEST['id'];
		$UID=get_user_id();
	    $type = D("task") -> where("id=".$id) -> getField("user_id");

	   if($assigner==$UID)
		{
	   	 $this->ty="发起人";
	   }

		$widget['jquery-ui'] = true;
		$widget['editor'] = true;
		$widget['date'] = true;
		$this -> assign("widget", $widget);
		$this -> assign('auth', $this -> config['auth']);

		
		$this -> assign('task_id', $id);
		$model = M("Task");
		$vo = $model -> find($id);
		$this -> assign('vo', $vo);

		$where_log['task_id'] = array('eq', $id);
		$task_log = M("TaskLog") -> where($where_log) -> select();
		$this -> assign('task_log', $task_log);

		if (empty($vo['executor'])) {
			$this -> assign('no_assign', 1);
		} else {

		}

		$where_accept['status'] = 0;
		$where_accept['task_id'] = $id;
		$where_accept['type'] = 1;
		$where_accept['executor'] = array('eq', get_user_id());
		$task_accept = M("TaskLog") -> where($where_accept) -> find();

		if ($task_accept) {
			$this -> assign('is_accept', 1);
			$this -> assign('task_log_id', $task_accept['id']);
		}

		if ($this -> config['auth']['admin']) {
			$where_dept_accept['status'] = 0;
			$where_dept_accept['task_id'] = $id;
			$where_dept_accept['type'] = 2;
			$where_dept_accept['executor'] = array('eq', get_dept_id());
			$task_dept_accept = M("TaskLog") -> where($where_dept_accept) -> find();
			if ($task_dept_accept) {
				$this -> assign('is_accept', 1);
				$this -> assign('task_log_id', $task_dept_accept['id']);
			}
		}

		$where_working['status'] = array('in', '1,2');
		$where_working['task_id'] = $id;
		$where_working['transactor'] = array('eq', get_user_id());
		$task_working = M("TaskLog") -> where($where_working) -> find();

		if ($task_working) {
			$this -> assign('is_working', 1);
			$this -> assign('task_working', $task_working);

		}
		$this -> display();
	}
	function let_me_do($task_id) {
		if (IS_POST) {
			M("Task") -> where("id=$task_id") -> setField('executor', get_user_name() . "|" . get_user_id());
			M("Task") -> where("id=$task_id") -> setField('status', 1);

			$data['task_id'] = I(task_id);
			$data['executor'] = get_user_id();
			$data['executor_name'] = get_user_name();
			$data['transactor'] = get_user_id();
			$data['transactor_name'] = get_user_name();
			$data['status'] = 1;
			
			$task_id=I(task_id);
			$list = M("TaskLog") -> add($data);
			if ($list != false) {
				// $this->_add_to_schedule($task_id);
				$return['info'] = '接受成功';
				$return['status'] = 1;
				$this -> ajaxReturn($return);
			} else {
				$this -> error('提交成功');
			}
		}
	}

	function accept() {
		if (IS_POST) {
			$task_log_id = I('task_log_id');
			$data['id'] = $task_log_id;
			$data['transactor'] = get_user_id();
			$data['transactor_name'] = get_user_name();
			$data['status'] = 1;
			$list = M("TaskLog") -> save($data);

			$task_id = M("TaskLog") -> where("id=$task_log_id") -> getField('task_id');
			$task_type = M("TaskLog") -> where("id=$task_log_id") -> getField('task_type');
			M("Task") -> where("id=$task_id") -> setField('status', 1);

			if ($list != false) {
				if ($task_type == "101" or $task_type == "102") {
					 $this->_add_to_schedule($task_id);
				}
				
				$return['info'] = '接受成功';
				$return['status'] = 1;
				$this -> ajaxReturn($return);
			} else {
				$this -> error('提交成功');
			}
		}
	}
	
	function save2(){
		$model = D('task');
		if (false === $model -> create()) {
			$this -> error($model -> getError());
		}
		/*保存当前数据对象 */
		$list = $model -> add();
		if ($list !== false) {//保存成功
			$this -> assign('jumpUrl', get_return_url());
			$this -> success('新增成功');
		} else {
			$this -> error('新增失败!');
			//失败提示
		}
	}
	function reject() {
		$widget['editor'] = true;
		$this -> assign("widget", $widget);
		if (IS_POST) {
			$model = D("TaskLog");
			if (false === $model -> create()) {
				$this -> error($model -> getError());
			}
			$model -> transactor = get_user_id();
			$model -> transactor_name = get_user_name();
			$model -> finish_time = toDate(time());
			$list = $model -> save();
			if ($list !== false) {
				$this -> success('提交成功');
			} else {
				$this -> success('提交失败');
			}
		}

		$task_id = I('task_id');
		$where_log1['type'] = 2;
		$where_log1['executor'] = get_user_id();
		$where_log1['task_id'] = $task_id;
		$task_log1 = M("TaskLog") -> where($where_log1) -> find();

		if ($task_list1) {
			$this -> assign('task_log', $task_log1);
		} else {
			$where_log2['type'] = 1;
			$where_log2['executor'] = get_dept_id();
			$where_log2['task_id'] = $task_id;
			$task_log2 = M("TaskLog") -> where($where_log2) -> find();

			if ($task_log2) {
				$this -> assign('task_log', $task_log2);
			}
		}
		$this -> display();
	}

	public function save_log($id) {
		
		$model = D("TaskLog");
		if (false === $model -> create()) {
			$this -> error($model -> getError());
		}
		$model -> transactor = get_user_id();
		$model -> transactor_name = get_user_name();
		if ($status == 4) {
			$model -> finish_time = time();
			$model -> step =setInc('step');
		}
		if (I('finish_time') =='') {
			$model -> finish_time = time();
		}

		$list = $model -> save();
		
		$task_log_id = $id;
		$status = I('status');
		$task_id = M("TaskLog") -> where("id=$task_log_id") -> getField('task_id');

		if ($status == 2) {
			M("Task") -> where("id=$task_id") -> setField('status', 2);
		}
		$limit_time=I('limit_time');
		$task_type=I('task_type');
	
		if ($status == 4) {
			$task_id = I('task_id');
			$step = I('step')+1;
			$forword_executor = I('forword_executor');
			D('Task') -> forword($step,$task_id,$task_type, $forword_executor,$limit_time);
		}

		if ($status > 2) {
			$where_count['task_id'] = array('eq', $task_id);
			$total_count = M("TaskLog") -> where($where_count) -> count();

			$where_count['status'] = array('gt', 2);
			$finish_count = M("TaskLog") -> where($where_count) -> count();
			if ($total_count == $finish_count) {
				M("Task") -> where("id=$task_id") -> setField('status', 3);
				$user_id=M('Task')->where("id=$task_id")->getField('user_id');
				$this->_send_mail_finish($task_id,$user_id);				
			}
		}

		if ($list !== false) {
			$this -> assign('jumpUrl', get_return_url());
			$this -> success('提交成功!');
			//成功提示
		} else {
			$this -> error('提交失败!');
			//错误提示
		}
	}

	function upload() {
		$this -> _upload();
	}

	function down() {
		$this -> _down();
	}

	private function _add_to_schedule($task_id){
		$info=M("Task") -> where("id=$task_id")->find();
		$data['name']=$info['name'];
		$data['content']=$info['content'];
		$data['start_time']=$info['expected_time'];//toDate(time())
		$data['end_time']= $info['expected_time'];
		$data['user_id']=get_user_id();
		$data['user_name']=get_user_name();
		$data['actor']='huiyi';
		$data['priority']=5;

		$list=M('Schedule')->add($data);
	}
	
	function _send_mail_finish($task_id,$executor) {
		$executor_info=M("User")->where("id=$executor")->find();
		
		$email=$executor_info['email'];
		$user_name=$executor_info['name'];
				
		$info = M("Task") -> where("id=$task_id") -> find();
		
		$transactor_name=M("TaskLog")->where("task_id=$task_id")->getField('id,transactor_name');
		
		$transactor_name=implode(",",$transactor_name);

		$title="您发布任务已完成：".$info['name'];
				
		$body="您好，{$user_name}，{$transactor_name} 完成了您发起的[{$info['name']}]任务</br>";
		$body.="任务主题：{$info['name']}</br>";
		$body.="任务时间：{$info['expected_time']}</br>";
		$body.="任务执行人：{$transactor_name}</br>";
		$body.="请及时检查任务执行情况，如有问题，请与[{$transactor_name}]进行沟通。</br>";
		$body.="任务完成后请对[任务执行人]表达我们的感谢。</br>";
	
		$body.="点击查看任务详情：http://". $_SERVER['SERVER_NAME'].U('Task/read','id='.$info['id'])."</br>";
		$body.="感谢有您！</br>";

		send_mail($email, $user_name, $title, $body);
	}
}
