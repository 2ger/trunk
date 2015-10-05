<?php
/*---------------------------------------------------------------------------
 

 Copyright (c) 2015 http://www.thinkphp.com All rights reserved.

 Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )

 Author:  thinkphp.com

 Support: http://www.thinkphp.com
 -------------------------------------------------------------------------*/

class TeachingAction extends CommonAction {
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
		$config = D("UserConfig") -> get_config();
		$this -> assign("home_sort", $config['home_sort']);
		$this -> display();
	}
	public function jiaocai() {

	$emp_no = get_emp_no();
	$uid = get_user_id();
	$this->position_id=get_position_id();
	$this->user_rank=get_user_rank();
	
	//订教材  流程图
	$task=M('task')->where('type = "1"' )->order('id desc')->select();
	if (!empty($task)) {
		$this->isfa =1;//第一步
		
		$this->taskId= $task[0]['id'];
		$taskId= $task[0]['id'];
		
		$this->iszhuan=task_step_status($taskId,1);//2
		$this->iswan=task_step_status($taskId,2);//3
	}


    //领教材
	$flow=M('task')->where('type ="2"')->order('id desc')->select();
	if (!empty($flow)) {
		$this->lisfa =1;//第一步
		$this->taskId2= $flow[0]['id'];
		$taskId2= $flow[0]['id'];
		$this->liswan=task_step_status($taskId2,1);
	}
		//填写教材
		$flow=M("flow");
		$data['type']=79;
		$data['user_id']=get_user_id();
		$show=$flow->where($data)->order('id desc')->getField('id');
		if(empty($show)){ // 没有数据
			$this->tian =0;
		}else{ //有数据
			$this->tian =1;
			$this->jiaoid =$show;
		}
		
		//订教材  颜色判断
		if ($this->isfa) {
			$this->btn1 ="btn-success";

			if ($this->iszhuan) {
				$this->btn2 ="btn-success";
				if ($this->iswan) {
					$this->btn3 ="btn-success";
				}else {
					$this->btn3 ="btn-danger";
				}
			}else {
				$this->btn2 ="btn-danger";
			}
		}else {
			$this->btn1 ="btn-danger";
		}

	
		//领教材  颜色判断
		if ($this->lisfa) {
			$this->btn21 ="btn-success";
			if ($this->liswan) {
				$this->btn22 ="btn-success";
			}else {
				$this->btn22 ="btn-danger";
			}
		}else {
			$this->btn21 ="btn-danger";
		}
	
	

			// 教材
			$task_type = "1,2"; //任务类型
			$flow_type = "79"; //流程类型
			$this->todo = task_todo($task_type).flow_todo($flow_type);// 未完成
			$this->doing = task_ing($task_type).flow_ing($flow_type);// 等待中
			$this->done = task_done($task_type).flow_done($flow_type);// 已完成
	
	

			//________________专业 begin
			//订教材  流程图
			$task=M('task')->where('type = "201"' )->order('id desc')->select();
			if (!empty($task)) {
				$this->isfa20 =1;//第一步
		
				$this->taskId20= $task[0]['id'];
				$taskId20= $task[0]['id'];
		
				$this->iszhuan20=task_step_status($taskId20,1);//2
				$this->iswan20=task_step_status($taskId20,2);//3
			}
			//订教材  颜色判断
			if ($this->isfa20) {
				$this->btn201 ="btn-success";

				if ($this->iszhuan20) {
					$this->btn202 ="btn-success";
					if ($this->iswan20) {
						$this->btn203 ="btn-success";
					}else {
						$this->btn203 ="btn-danger";
					}
				}else {
					$this->btn202 ="btn-danger";
				}
			}else {
				$this->btn201 ="btn-danger";
			}
		    //领教材
			$flow=M('task')->where('type ="202"')->order('id desc')->select();
			if (!empty($flow)) {
				$this->lisfa20 =1;//第一步
				$this->taskId202= $flow[0]['id'];
				$taskId202= $flow[0]['id'];
				$this->liswan20=task_step_status($taskId202,1);
				dump($this->liswan2020);
			}
			//领教材  颜色判断
			if ($this->lisfa20) {
				$this->btn2021 ="btn-success";
				if ($this->liswan20) {
					$this->btn2022 ="btn-success";
				}else {
					$this->btn2022 ="btn-danger";
				}
			}else {
				$this->btn2021 ="btn-danger";
			}
	
				//填写教材
				$flow=M("flow");
				$data['type']=79;
				$data['user_id']=get_user_id();
				$show=$flow->where($data)->order('id desc')->getField('id');
				if(empty($show)){ // 没有数据
					$this->tian20 =0;
				}else{ //有数据
					$this->tian20 =1;
					$this->jiaoid20 =$show;
				}

				// 教材
				$task_type20 = "201,202"; //任务类型
				$flow_type20 = "79"; //流程类型
				$this->todo20 = task_todo($task_type20).flow_todo($flow_type20);// 未完成
				$this->doing20 = task_ing($task_type20).flow_ing($flow_type20);// 等待中
				$this->done20 = task_done($task_type20).flow_done($flow_type20);// 已完成	

			//________________专业 end		
    $this->display();
	}
	public function jiaoxuedagang() {

	$emp_no = get_emp_no();
	$uid = get_user_id();
	$this->position_id=get_position_id();
	$this->user_rank=get_user_rank();


	$flow=M('task')->where('type = "5" ')->order('id desc')->select();
	if (!empty($flow)) {
		$this->isfa =1;//第一步
		$this->taskId =$flow[0]['id'];//第一步
	   $this->lc=task_step_status($this->taskId,1);
	   $this->zr=task_step_status($this->taskId,2);
	   $this->js=task_step_status($this->taskId,3);
	   }


		// 颜色判断
	if ($this->isfa) {
		$this->btn1 ="btn-success";//第二步开始
		if ($this->lc) {
			$this->btn2 ="btn-success";//第三步开始
			if ($this->zr) {
				$this->btn3 ="btn-success";

				//第四步开始
              	if ($this->js) {
				$this->btn4 ="btn-success";
			}else {
				$this->btn4 ="btn-danger";
			}//第四步结束

			}else {
				$this->btn3 ="btn-danger";
			}//第三步结束

		}
		
		else {
			$this->btn2 ="btn-danger";
		}
		//第二步开始
	}
	
	else {
		$this->btn1 ="btn-danger";
	}

	// 综合类 －－－－－－ 
		$flow=M('task')->where('type = "2052" ')->order('id desc')->select();
		if (!empty($flow)) {
			$this->isfa202 =1;//第一步
			$this->taskId202 =$flow[0]['id'];//第一步
	 	   $this->lc202=task_step_status($this->taskId202,1);
	 	   $this->zr202=task_step_status($this->taskId202,2);
	 	   $this->js202=task_step_status($this->taskId202,3);
		   }

			// 颜色判断
		if ($this->isfa202) {
			$this->btn2201 ="btn-success";//第二步开始
			if ($this->lc202) {
				$this->btn2202 ="btn-success";//第三步开始
				if ($this->zr202) {
					$this->btn2203 ="btn-success";

					//第四步开始
	              	if ($this->js202) {
					$this->btn2204 ="btn-success";
				}else {
					$this->btn2204 ="btn-danger";
				}//第四步结束

				}else {
					$this->btn2203 ="btn-danger";
				}//第三步结束

			}

			else {
				$this->btn2202 ="btn-danger";
			}
			//第二步开始
		}

		else {
			$this->btn2201 ="btn-danger";
		}

// 教学大纲
$task_type = "5,2052"; //任务类型
$flow_type = "55"; //流程类型
$this->todo = task_todo($task_type).flow_todo($flow_type);// 未完成
$this->doing = task_ing($task_type).flow_ing($flow_type);// 等待中
$this->done = task_done($task_type).flow_done($flow_type);// 已完成

// 专业 －－－－－－ 
	$flow=M('task')->where('type = "205" ')->order('id desc')->select();
	if (!empty($flow)) {
		$this->isfa20 =1;//第一步
		$this->taskId20 =$flow[0]['id'];//第一步
 	   $this->lc20=task_step_status($this->taskId20,1);
 	   $this->zr20=task_step_status($this->taskId20,2);
 	   $this->js20=task_step_status($this->taskId20,3);
	   }

		// 颜色判断
	if ($this->isfa20) {
		$this->btn201 ="btn-success";//第二步开始
		if ($this->lc20) {
			$this->btn202 ="btn-success";//第三步开始
			if ($this->zr20) {
				$this->btn203 ="btn-success";

				//第四步开始
              	if ($this->js20) {
				$this->btn204 ="btn-success";
			}else {
				$this->btn204 ="btn-danger";
			}//第四步结束

			}else {
				$this->btn203 ="btn-danger";
			}//第三步结束

		}
		
		else {
			$this->btn202 ="btn-danger";
		}
		//第二步开始
	}
	
	else {
		$this->btn201 ="btn-danger";
	}



// 教学大纲
$task_type20 = "205"; //任务类型
$flow_type20 = "82"; //流程类型
$this->todo20 = task_todo($task_type20).flow_todo($flow_type20);// 未完成
$this->doing20 = task_ing($task_type20).flow_ing($flow_type20);// 等待中
$this->done20 = task_done($task_type20).flow_done($flow_type20);// 已完成

    $this->display();
	}
	
	public function jiaoxuejihua() {
	
	$emp_no = get_emp_no();
    $flow=M('flow')->select();
	$emp_no = get_emp_no();
	$uid = get_user_id();
	$this->position_id=get_position_id();
	$this->user_rank=get_user_rank();

	
	$flow=M('task')->where('type = "6" ')->order('id desc')->select();
	if (!empty($flow)) {
		$this->isfa =1;//第一步
		$this->taskId =$flow[0]['id'];//第一步
 	   $this->lc=task_step_status($this->taskId,1);
 	   $this->zr=task_step_status($this->taskId,2);
 	   $this->js=task_step_status($this->taskId,3);
	
	}
// 颜色判断
	if ($this->isfa) {
		$this->btn1 ="btn-success";//第二步开始
		if ($this->lc) {
			$this->btn2 ="btn-success";//第三步开始
			if ($this->zr) {
				$this->btn3 ="btn-success";

				//第四步开始
              	if ($this->js) {
				$this->btn4 ="btn-success";
			}else {
				$this->btn4 ="btn-danger";
			}//第四步结束

			}else {
				$this->btn3 ="btn-danger";
			}//第三步结束

		}
		
		else {
			$this->btn2 ="btn-danger";
		}//第二步开始
	}
	
	else {
		$this->btn1 ="btn-danger";
	}

	// 综合类 教学计划
	$flow=M('task')->where('type = "2062" ')->order('id desc')->select();
	if (!empty($flow)) {
		$this->isfa202 =1;//第一步
		$this->taskId202 =$flow[0]['id'];//第一步
  	   $this->lc202=task_step_status($this->taskId202,1);
  	   $this->zr202=task_step_status($this->taskId202,2);
  	   $this->js202=task_step_status($this->taskId202,3);
	}
	//  颜色判断
	if ($this->isfa202) {
		$this->btn2201 ="btn-success";//第二步开始
		if ($this->lc202) {
			$this->btn2202 ="btn-success";//第三步开始
			if ($this->zr202) {
				$this->btn2203 ="btn-success";
              	if ($this->js202) {
				$this->btn2204 ="btn-success";
			}else {
				$this->btn2204 ="btn-danger";
			}//第四步结束
			}else {
				$this->btn2203 ="btn-danger";
			}//第三步结束
		}else {
			$this->btn2202 ="btn-danger";
		}//第二步开始
	}else {
		$this->btn2201 ="btn-danger";
	}
	
	   // 教学计划
	   $task_type = "6,2062"; //任务类型
	   $flow_type = "50"; //流程类型
	   $this->todo = task_todo($task_type).flow_todo($flow_type);// 未完成
	   $this->doing = task_ing($task_type).flow_ing($flow_type);// 等待中
	   $this->done = task_done($task_type).flow_done($flow_type);// 已完成

	// 专业教学计划
	$flow=M('task')->where('type = "206" ')->order('id desc')->select();
	if (!empty($flow)) {
		$this->isfa20 =1;//第一步
		$this->taskId20 =$flow[0]['id'];//第一步
  	   $this->lc20=task_step_status($this->taskId20,1);
  	   $this->zr20=task_step_status($this->taskId20,2);
  	   $this->js20=task_step_status($this->taskId20,3);
	}
	//  颜色判断
	if ($this->isfa20) {
		$this->btn201 ="btn-success";//第二步开始
		if ($this->lc20) {
			$this->btn202 ="btn-success";//第三步开始
			if ($this->zr20) {
				$this->btn203 ="btn-success";
              	if ($this->js20) {
				$this->btn204 ="btn-success";
			}else {
				$this->btn204 ="btn-danger";
			}//第四步结束
			}else {
				$this->btn203 ="btn-danger";
			}//第三步结束
		}else {
			$this->btn202 ="btn-danger";
		}//第二步开始
	}else {
		$this->btn201 ="btn-danger";
	}
	   // 教学计划
	   $task_type20 = "206"; //任务类型
	   $flow_type20 = "80"; //流程类型
	   $this->todo20 = task_todo($task_type20).flow_todo($flow_type20);// 未完成
	   $this->doing20 = task_ing($task_type20).flow_ing($flow_type20);// 等待中
	   $this->done20 = task_done($task_type20).flow_done($flow_type20);// 已完成
	   
	   
	   
    $this->display();
	}


	public function kechengbiao() {


		if ($_GET['from'] == 'gong') {
			// cookie("current_node", 342);
	// 		cookie("top_menu", 340);
			cookie("fromtype", 'zhuan');
		}else {
			// cookie("current_node", 219);
// 			cookie("top_menu", 217);
			cookie("fromtype", 'gong');
		}
		// dump($_GET['from']);
		$sy= "SELECT *FROM onethink_document_syllabus GROUP BY course ";
		$member = M() -> query($sy);
    
        $this->assign('member',$member);
		
		$teacher = M('user') ->select();
        $this->assign('teacher',$teacher);
	

		$task=M('task');
		$taskgt=$task->where(' executor like "%'.get_user_name().'%"')->limit(50)->select();
		
		// 课程表
		$task_type = "0"; //任务类型
		$flow_type = "69,70"; //流程类型
		$this->todo = task_todo($task_type).flow_todo($flow_type);// 未完成
		$this->doing = task_ing($task_type).flow_ing($flow_type);// 等待中
		$this->done = task_done($task_type).flow_done($flow_type);// 已完成
		
		
		$this->assign('taskgt',$taskgt);
    $this->display();
	}

		public function allkechengbiao() {
			$this->type =I('type');
			$this->two =I('two');
			if ($this->type ==1) {
				$this->text ='当前课程表：公共体育';
			}else if ($this->type ==2) {
				$this->text ='当前课程表：体育专业';
			} else if ($this->two ==1) {
				$this->text ='当前课程表：A1';
			} else if ($this->two ==2) {
				$this->text ='当前课程表：A2';
			} else if ($this->two ==3) {
				$this->text ='当前课程表：A3';
			} else{
				$this->text ='当前课程表：全部课程';
			}
		if ($_GET['from'] == 'gong') {
			cookie("current_node", 342);
			cookie("top_menu", 340);
			cookie("fromtype", 'zhuan');
		}else {
			cookie("current_node", 219);
			cookie("top_menu", 217);
			cookie("fromtype", 'gong');
		}
		$sy= "SELECT *FROM onethink_document_syllabus GROUP BY course ";
		$member = M() -> query($sy);
    
        $this->assign('member',$member);
		
		$teacher = M('user')->order('name') ->select();
        $this->assign('teacher',$teacher);
	
	// 操作课程
   	 $syllabus          = M('document_syllabus');
   	 $data['week']      = $_POST['week'];
     $data['action'] 	= $_POST['action'];
   	 $data['uid']       = $_POST['uid'];

   	 $data['one']       = $_POST['one'];
   	 $data['course']    = $_POST['course'];
   	 $data['teacher']   = $_POST['teacher'];

    $data['wfs']       = $_POST['wfs'];
   	 $data['period']    = $_POST['period'];
   	 $data['place']     = $_POST['place'];
   	 $data['type']      = $_POST['type'];
   	 $data['two']       = $_POST['two'];
		   
     $syllabus->uid 	= $_POST['uid'];// 这节课的id， 非用户id
   	 $syllabus->course  = $_POST['course'];
   	 $syllabus->teacher = $_POST['teacher'];
   	 $syllabus->wfs     = $_POST['wfs'];
   	 $syllabus->period  = $_POST['period'];
   	 $syllabus->place   = $_POST['palce'];
   	 $syllabus->type     = $_POST['type'];
   	 $syllabus->two     = $_POST['two'];

   	 //添加
   	if($data['action']==1)
   	{
           $syllabus->data($data)->add();
   	}
    //修改
   	else if($data['action']==2)
   	{
        $syllabus->where('id='.$data['uid'])->save();
   	}
       //删除
       else	if($data['action']==3)
   	{
        $syllabus->where('id='.$data['uid'])->delete(); 
   	}
//   	$this->success('操作成功', Cookie('__forward__'));
	
	

    $this->display();
	}

	public function shijuan() {
		
	$emp_no = get_emp_no();
     
	$emp_no = get_emp_no();
	$uid = get_user_id();
	$this->position_id=get_position_id();
	$this->user_rank=get_user_rank();


	//出试卷
	$task=M('task')->where('type = "8"')->order('id desc')->select();
	if (!empty($task)) {
		$this->isfa =1;//第一步
		
		$this->taskId= $task[0]['id'];
		$taskId= $task[0]['id'];

		$this->iszhuan=task_step_status($taskId,1);
	    $this->iswan=task_step_status($taskId,2);
	}	
	//老师提交成绩
	$flow_cj=M('flow')->where('type=76  and user_id='.get_user_id())->select();
	$jslist2=M('flow')->where('type = "76" and confirm like "%'.$emp_no.'%"')->order('id desc')->select();// 自己是审批人

		   if(!empty($flow_cj) or !empty($jslist2)){
			   if (!empty($flow_cj)) {
				   $this->idaa = $flow_cj[0]['id'];
			   }else {
			   		 $this->idaa = $jslist2[0]['id'];
			   }

		$this->flowid=$this->idaa;
		$this->tj=1;
		$this->jxms=flow_step_status($this->idaa,1);
	}



	 
	// 试卷
	$task_type = "8"; //任务类型
	$flow_type = "76"; //流程类型
	$this->todo = task_todo($task_type).flow_todo($flow_type);// 未完成
	$this->doing = task_ing($task_type).flow_ing($flow_type);// 等待中
	$this->done = task_done($task_type).flow_done($flow_type);// 已完成


		//出试卷  颜色判断
	if ($this->isfa) {
		$this->btn1 ="btn-success";

		if ($this->iszhuan) {
			$this->btn2 ="btn-success";
			if ($this->iswan) {
				$this->btn3 ="btn-success";
			}else {
				$this->btn3 ="btn-danger";
			}
		}else {
			$this->btn2 ="btn-danger";
		}
	}else {
		$this->btn1 ="btn-danger";
	}

		//提交成绩  颜色判断
	if ($this->tj) {
		$this->btn21 ="btn-success";

		if ($this->jxms) {
			$this->btn22 ="btn-success";
		
		}else {
			$this->btn22 ="btn-danger";
		}
	}else {
		$this->btn21 ="btn-danger";
	}


	// 专业 ＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
	$task=M('task')->where('type = "208"')->order('id desc')->select();
	if (!empty($task)) {
		$this->isfa20 =1;//第一步
		
		$this->taskId20= $task[0]['id'];
		$taskId20= $task[0]['id'];

		$this->iszhuan20=task_step_status($taskId20,1);
	    $this->iswan20=task_step_status($taskId20,2);
	}

	//老师提交数据
	$flow_cj20=M('flow')->where('type=88  and user_id='.get_user_id())->select();
	$jslist202=M('flow')->where('type = "88" and confirm like "%'.$emp_no.'%"')->order('id desc')->select();// 自己是审批人

	if(!empty($flow_cj20) or !empty($jslist202)){
			   if (!empty($flow_cj20)) {
				   $this->idaa20 = $flow_cj20[0]['id'];
			   }else {
			   		 $this->idaa20 = $jslist202[0]['id'];
			   }
		$this->flowid20=$this->idaa20;
		$this->tj20=1;
		$this->jxms20=flow_step_status($this->tj20,1);
	}

	 
	// 试卷
	$task_type20 = "208"; //任务类型
	$flow_type20 = "88"; //流程类型
	$this->todo20 = task_todo($task_type20).flow_todo($flow_type20);// 未完成
	$this->doing20 = task_ing($task_type20).flow_ing($flow_type20);// 等待中
	$this->done20 = task_done($task_type20).flow_done($flow_type20);// 已完成


		//出试卷  颜色判断
	if ($this->isfa20) {
		$this->btn201 ="btn-success";

		if ($this->iszhuan20) {
			$this->btn202 ="btn-success";
			if ($this->iswan20) {
				$this->btn203 ="btn-success";
			}else {
				$this->btn203 ="btn-danger";
			}
		}else {
			$this->btn202 ="btn-danger";
		}
	}else {
		$this->btn201 ="btn-danger";
	}

		//提交成绩  颜色判断
	if ($this->tj20) {
		$this->btn2021 ="btn-success";

		if ($this->jxms) {
			$this->btn2022 ="btn-success";
		
		}else {
			$this->btn2022 ="btn-danger";
		}
	}else {
		$this->btn2021 ="btn-danger";
	}
	
        $this->display();
	}
	
	public function jiaoan() {

    $flow=M('flow')->select();
	$emp_no = get_emp_no();
	$uid = get_user_id();
		
		//教案
		$flow=M("flow");
		$data['type']=68;
		$data['jiaoan']='';
		$data['user_id']=get_user_id();
		$show=$flow->where($data)->order('id desc')->find();
		$this->flowId = $show['id'];
		if(!empty($show)){ // 没有数据
			$this->isfa =1;
		}
		if ($show['step'] == 40) {
			$this->iswan =1;
		}
		//提交成绩  颜色判断
	if ($this->isfa) {
		$this->btn21 ="btn-success";
		if ($this->iswan) {
			$this->btn22 ="btn-success";
		}else {
			$this->btn22 ="btn-danger";
		}
	}else {
		$this->btn21 ="btn-danger";
	}

	//综合教案
		$flow2=M("flow");
		$data2['type']=68;
		$data2['jiaoan']='100';
		$data2['user_id']=get_user_id();
		$show2=$flow2->where($data2)->order('id desc')->find();
		$this->flowId22 = $show2['id'];
		if(!empty($show2)){ // 没有数据
			$this->isfa22 =1;
		}
		if ($show2['step'] == 40) {
			$this->iswan22 =1;
		}
		//提交成绩  颜色判断
	if ($this->isfa22) {
		$this->btn2212 ="btn-success";
		if ($this->iswan22) {
			$this->btn2222 ="btn-success";
		}else {
			$this->btn2222 ="btn-danger";
		}
	}else {
		$this->btn2212 ="btn-danger";
	}
	
	
	// 教案
	$task_type = "0"; //任务类型
	$flow_type = "68"; //流程类型
	$this->todo = task_todo($task_type).flow_todo($flow_type);// 未完成
	$this->doing = task_ing($task_type).flow_ing($flow_type);// 等待中
	$this->done = task_done($task_type).flow_done($flow_type);// 已完成
	
	
	
	// 教案 专业
	$flow2=M("flow");
	$data2['type']=85;
	$data2['jiaoan']='';
	$data2['user_id']=get_user_id();
	$show2=$flow2->where($data2)->order('id desc')->find();
	$this->flowId2 = $show2['id'];
	if(!empty($show2)){ // 没有数据
		$this->isfa2 =1;
	}
	if ($show2['step'] == 40) {
		$this->iswan2 =1;
	}
	//提交成绩  颜色判断
if ($this->isfa2) {
	$this->btn212 ="btn-success";
	if ($this->iswan2) {
		$this->btn222 ="btn-success";
	}else {
		$this->btn222 ="btn-danger";
	}
}else {
	$this->btn212 ="btn-danger";
}
	$task_type20 = "0"; //任务类型
	$flow_type20 = "85"; //流程类型
	$this->todo20 = task_todo($task_type20).flow_todo($flow_type20);// 未完成
	$this->doing20 = task_ing($task_type20).flow_ing($flow_type20);// 等待中
	$this->done20 = task_done($task_type20).flow_done($flow_type20);// 已完成
	
    $this->display();
	}
	
	


	public function pingjiaopingxue() {


    $flow=M('flow')->select();
	$emp_no = get_emp_no();
	$uid = get_user_id();
	$this->position_id=get_position_id();
	$this->user_rank=get_user_rank();
	
	//自评  流程图
	$flow=M('task')->where('type = "74"')->order('id desc')->select();
	$taskId= $flow[0]['id'];
	$this->taskId= $taskId;
	if (!empty($flow)) {
		$this->isfa =1;//第一步
		$this->iszhuan=task_step_status($taskId,1);//2

       $lzxflow = M('flow') ->where(' type = 54') -> select();
       $lzid= $lzxflow[0]['id'];
	   $this->lzidlog = $lzid;
		if(!empty($lzxflow))
		{
				$this->zptplc=1;
				$this->lz=flow_step_status($lzid,1);
				$this->ms=flow_step_status($lzid,2);
		}
	}

	//听课  流程图
	$zpflow=M('task')->where('type = "75"')->order('id desc')->select();
	if (!empty($zpflow)) {
		$this->zpisfa =1;//第一步
		$this->zptaskId= $zpflow[0]['id'];
		$zptaskId= $zpflow[0]['id'];
		$this->tkp=task_step_status($zptaskId,1);//2
		//流程
			$flowtk = M('flow')->where('type = 51')->find();
			 $flowtkid=$flowtk["id"];
			 $this->flowtkid=$flowtkid;
			if($flowtk['id']!=null){
				$this->lztb=1;
				$this->ktb=flow_step_status($flowtkid,1);//2
			}
		}

	
		//学生评教  流程图
	$pjflow=M('task')->where('type = "76"')->order('id desc')->select();

	if (!empty($pjflow)) {
	
		$this->pjisfa =1;//第一步
		$this->pjtaskId= $pjflow[0]['id'];
		$pjtaskFrom= $pjflow[0]['user_id'];//发起人id
		$pjtaskId= $pjflow[0]['id'];
		
		$this->pjjw=task_step_status($pjtaskId,1);//2
		$this->fdy=task_step_status($pjtaskId,2);//3
	}

	// 评教评学
	$task_type = "74,75,76"; //任务类型
	$flow_type = "54,51"; //流程类型
	$this->todo = task_todo($task_type).flow_todo($flow_type);// 未完成
	$this->doing = task_ing($task_type).flow_ing($flow_type);// 等待中
	$this->done = task_done($task_type).flow_done($flow_type);// 已完成

		//订教材  颜色判断
	if ($this->isfa) {
		$this->btn1 ="btn-success";//第二步开始
		if ($this->iszhuan) {
			$this->btn2 ="btn-success";//第三步开始
			if ($this->zptplc) {
				$this->btn3 ="btn-success";

				//第四步开始
              	if ($this->lz) {
				$this->btn4 ="btn-success";

               //第五步开始
              	if ($this->ms) {
				$this->btn5 ="btn-success";
			}else {
				$this->btn5 ="btn-danger";
			}//第五步结束

			}else {
				$this->btn4 ="btn-danger";
			}//第四步结束

			}else {
				$this->btn3 ="btn-danger";
			}//第三步结束

		}
		
		else {
			$this->btn2 ="btn-danger";
		}
		//第二步开始
	}
	
	else {
		$this->btn1 ="btn-danger";
	}

		//听课表  颜色判断
	if ($this->zpisfa) {
		$this->btn21 ="btn-success";//第二步开始
		if ($this->tkp) {
			$this->btn22 ="btn-success";//第三步开始
			if ($this->lztb) {
				$this->btn23 ="btn-success";//第四步开始
              	if ($this->ktb) {
				$this->btn24 ="btn-success";
			}else {
				$this->btn24 ="btn-danger";
			}//第四步结束

			}else {
				$this->btn23 ="btn-danger";
			}//第三步结束

		}
		
		else {
			$this->btn22 ="btn-danger";
		}
		//第二步开始
	}
	
	else {
		$this->btn21 ="btn-danger";
	}

		
		//听课表  颜色判断
	if ($this->pjisfa) {
		$this->btn31 ="btn-success";//第二步开始
		if ($this->pjjw) {
			$this->btn32 ="btn-success";//第三步开始
			if ($this->fdy) {
				$this->btn33 ="btn-success";
			}else {
				$this->btn33 ="btn-danger";
			}//第三步结束

		}
		
		else {
			$this->btn32 ="btn-danger";
		}
		//第二步开始
	}
	
	else {
		$this->btn31 ="btn-danger";
	}

	// 专业 －－－－－－－－－－－－－－－－－
	//自评  流程图
	$flow=M('task')->where('type = "2074"')->order('id desc')->select();
	$taskId20= $flow[0]['id'];
	$this->taskId20= $taskId20;
	if (!empty($flow)) {
		$this->isfa20 =1;//第一步
		$this->iszhuan20=task_step_status($taskId20,1);//2

       $lz20xflow = M('flow') ->where(' type = 54') -> select();
       $lz20id= $lz20xflow[0]['id'];
	   $this->lz20idlog = $lz20id;
		if(!empty($lz20xflow))
		{
				$this->zptplc20=1;
				$this->lz20=flow_step_status($lz20id,1);
				$this->ms20=flow_step_status($lz20id,2);
		}
	}

	//听课  流程图
	$zpflow=M('task')->where('type = "2075"')->order('id desc')->select();
	if (!empty($zpflow)) {
		$this->zpisfa20 =1;//第一步
		$this->zptaskId20= $zpflow[0]['id'];
		$zptaskId20= $zpflow[0]['id'];
		$this->tkp20=task_step_status($zptaskId20,1);//2
		//流程
			$flowtk = M('flow')->where('type = 51')->find();
			 $flowtkid20=$flowtk["id"];
			 $this->flowtkid20=$flowtkid20;
			if($flowtk['id']!=null){
				$this->lz20tb=1;
				$this->ktb20=flow_step_status($flowtkid20,1);//2
			}
		}

	
		//学生评教  流程图
	$pjflow=M('task')->where('type = "2076"')->order('id desc')->select();

	if (!empty($pjflow)) {
	
		$this->pjisfa20 =1;//第一步
		$this->pjtaskId2020= $pjflow[0]['id'];
		$pjtaskFrom= $pjflow[0]['user_id'];//发起人id
		$pjtaskId2020= $pjflow[0]['id'];
		
		$this->pjjw20=task_step_status($pjtaskId2020,1);//2
		$this->fdy20=task_step_status($pjtaskId2020,2);//3
	}

	// 评教评学
	$task_type = "2074,2075,2076"; //任务类型
	$flow_type = "54,51"; //流程类型
	$this->todo = task_todo($task_type).flow_todo($flow_type);// 未完成
	$this->doing = task_ing($task_type).flow_ing($flow_type);// 等待中
	$this->done = task_done($task_type).flow_done($flow_type);// 已完成



		//订教材  颜色判断
	if ($this->isfa20) {
		$this->btn201 ="btn-success";//第二步开始
		if ($this->iszhuan20) {
			$this->btn202 ="btn-success";//第三步开始
			if ($this->zptplc20) {
				$this->btn203 ="btn-success";
				//第四步开始
              	if ($this->lz20) {
				$this->btn204 ="btn-success";

               //第五步开始
              	if ($this->ms20) {
				$this->btn205 ="btn-success";
			}else {
				$this->btn205 ="btn-danger";
			}//第五步结束

			}else {
				$this->btn204 ="btn-danger";
			}//第四步结束

			}else {
				$this->btn203 ="btn-danger";
			}//第三步结束
		}
		else {
			$this->btn202 ="btn-danger";
		}//第二步开始
	}
	
	else {
		$this->btn201 ="btn-danger";
	}

		//听课表  颜色判断
	if ($this->zpisfa20) {
		$this->btn2021 ="btn-success";//第二步开始
		if ($this->tkp20) {
			$this->btn2022 ="btn-success";//第三步开始
			if ($this->lz20tb) {
				$this->btn2023 ="btn-success";//第四步开始
              	if ($this->ktb20) {
				$this->btn2024 ="btn-success";

               
     
			}else {
				$this->btn2024 ="btn-danger";
			}//第四步结束

			}else {
				$this->btn2023 ="btn-danger";
			}//第三步结束
		}
		
		else {
			$this->btn2022 ="btn-danger";
		}//第二步开始
	}
	
	else {
		$this->btn2021 ="btn-danger";
	}



		
		//听课表  颜色判断
	if ($this->pjisfa20) {
		$this->btn2031 ="btn-success";//第二步开始
		if ($this->pjjw20) {
			$this->btn2032 ="btn-success";//第三步开始
			if ($this->fdy20) {
				$this->btn2033 ="btn-success";
			}else {
				$this->btn2033 ="btn-danger";
			}//第三步结束
		}
		else {
			$this->btn2032 ="btn-danger";
		}
		//第二步开始
	}
	
	else {
		$this->btn2031 ="btn-danger";
	}
	
    $this->display();
	}
	public function rcpyfn()
	{
		$this->display();
	}
	public function jiaoxuezongjie()
	{
		
	$emp_no = get_emp_no();
    $flow=M('flow')->select();
	$emp_no = get_emp_no();
	$uid = get_user_id();
	$this->position_id=get_position_id();
	$this->user_rank=get_user_rank();

	$task=M('task')->where('type = "9" ')->order('id desc')->select();
	if (!empty($task)) {
		//dump($flow);
		$this->isfa =1;//第一步
		$this->taskId= $task[0]['id'];
		$taskId= $task[0]['id'];

	   $this->lc=task_step_status($this->taskId,1);
	   $this->zr=task_step_status($this->taskId,2);
	   $this->js=task_step_status($this->taskId,3);
	}

	//订教材  颜色判断
	if ($this->isfa) {
		$this->btn1 ="btn-success";//第二步开始
		if ($this->lc) {
			$this->btn2 ="btn-success";//第三步开始
			if ($this->zr) {
				$this->btn3 ="btn-success";

				//第四步开始
              	if ($this->js) {
				$this->btn4 ="btn-success";
			}else {
				$this->btn4 ="btn-danger";
			}//第四步结束

			}else {
				$this->btn3 ="btn-danger";
			}//第三步结束

		}
		
		else {
			$this->btn2 ="btn-danger";
		}
		//第二步开始
	}
	
	else {
		$this->btn1 ="btn-danger";
	}

	// 综合类  总结
	$task=M('task')->where('type = "2092" ')->order('id desc')->select();
	if (!empty($task)) {
		//dump($flow);
		$this->isfa202 =1;//第一步
		$this->taskId202= $task[0]['id'];
		$taskId202= $task[0]['id'];

   	   $this->lc202=task_step_status($this->taskId202,1);
   	   $this->zr202=task_step_status($this->taskId202,2);
   	   $this->js202=task_step_status($this->taskId202,3);
	}


		//订教材  颜色判断
	if ($this->isfa202) {
		$this->btn2201 ="btn-success";//第二步开始
		if ($this->lc202) {
			$this->btn2202 ="btn-success";//第三步开始
			if ($this->zr202) {
				$this->btn2203 ="btn-success";

				//第四步开始
              	if ($this->js202) {
				$this->btn2204 ="btn-success";
			}else {
				$this->btn2204 ="btn-danger";
			}//第四步结束

			}else {
				$this->btn2203 ="btn-danger";
			}//第三步结束

		}
		
		else {
			$this->btn2202 ="btn-danger";
		}
		//第二步开始
	}
	
	else {
		$this->btn2201 ="btn-danger";
	}
	
	// 教学总结
	$task_type = "9,2092"; //任务类型
	$flow_type = "77"; //流程类型
	$this->todo = task_todo($task_type).flow_todo($flow_type);// 未完成
	$this->doing = task_ing($task_type).flow_ing($flow_type);// 等待中
	$this->done = task_done($task_type).flow_done($flow_type);// 已完成
	
	// 专业
	$task=M('task')->where('type = "209" ')->order('id desc')->select();
	if (!empty($task)) {
		//dump($flow);
		$this->isfa20 =1;//第一步
		$this->taskId20= $task[0]['id'];
		$taskId20= $task[0]['id'];

   	   $this->lc20=task_step_status($this->taskId20,1);
   	   $this->zr20=task_step_status($this->taskId20,2);
   	   $this->js20=task_step_status($this->taskId20,3);
	}


		//订教材  颜色判断
	if ($this->isfa20) {
		$this->btn201 ="btn-success";//第二步开始
		if ($this->lc20) {
			$this->btn202 ="btn-success";//第三步开始
			if ($this->zr20) {
				$this->btn203 ="btn-success";

				//第四步开始
              	if ($this->js20) {
				$this->btn204 ="btn-success";
			}else {
				$this->btn204 ="btn-danger";
			}//第四步结束

			}else {
				$this->btn203 ="btn-danger";
			}//第三步结束

		}
		
		else {
			$this->btn202 ="btn-danger";
		}
		//第二步开始
	}
	
	else {
		$this->btn201 ="btn-danger";
	}

	// 教学总结
	$task_type20 = "209"; //任务类型
	$flow_type20 = "89"; //流程类型
	$this->todo20 = task_todo($task_type20).flow_todo($flow_type20);// 未完成
	$this->doing20 = task_ing($task_type20).flow_ing($flow_type20);// 等待中
	$this->done20 = task_done($task_type20).flow_done($flow_type20);// 已完成
	
    $this->display();
	
	}


}
?>