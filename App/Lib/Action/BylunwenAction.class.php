<?php
/*---------------------------------------------------------------------------
 
 Copyright (c) 2015 http://www.thinkphp.com All rights reserved.

 Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )

 Author:  thinkphp.com

 Support: http://www.thinkphp.com
 -------------------------------------------------------------------------*/

class BylunwenAction extends CommonAction {
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
	$this->position_id=get_position_id();
	$this->user_rank=get_user_rank();
		
		
	//begin  审查学生资格  流程图
	$flow1=M('flow')->where('type = 58')->limit(1)->order('id desc')->select();
	if (!empty($flow1)) {
		$this->step1 =1;//第一步
		$this->flowid= $flow1[0]['id'];
		if($flow1[0]['step'] ==40) {
			$this->step2 =1;	//第二步， 完成
		}else{
			$this->step2 =0;	//第二步， 完成
		}
	} // end
	
	//begin  教师指导资格  流程图
	$flow2=M('flow')->where('type = 59')->limit(1)->order('id desc')->select();
	if (!empty($flow2)) {
		$this->step21 =1;//第一步
		$this->flowid2= $flow2[0]['id'];
		if($flow2[0]['step'] ==40) {
			$this->step22 =1;	//第二步， 完成
		}else{
			$this->step22 =0;	//第二步， 完成
		}
	} // end
	
	
		$this -> display();
	}
	
		public function shenbao() {



		$widget['jquery-ui'] = true;
		$this -> assign("widget", $widget);

		$config = D("UserConfig") -> get_config();
		$this -> assign("home_sort", $config['home_sort']);
		
		
	//begin  申报课题  流程图
	$flow1=M('flow')->where('type = 60')->limit(1)->order('id desc')->select();
	if (!empty($flow1)) {
		$this->flow1step1 =1;//第一步
		$this->flow1id= $flow1[0]['id'];
		if($flow1[0]['step'] ==40) {
			$this->flow1step2 =1;	//第二步， 完成
		}else{
			$this->flow1step2 =0;	//第二步， 完成
		}
	} // end
	
	//begin  任务书  流程图
	$flow2=M('flow')->where('type = 61')->limit(1)->order('id desc')->select();
	if (!empty($flow2)) {
		$this->flow2step1 =1;//第一步
		$this->flow2id= $flow2[0]['id'];
		
		$this->flow2step2=M('flow_log')->where('step = 21 and flow_id = '.$this->flow2id)->limit(1)->order('id desc,result desc')->getField("result");//getField("status")  
		//第二步， 是1则第一个人审核通过完成
		
		if($flow2[0]['step'] ==40) {
			$this->flow2step3 =1;	//第3步， 完成
		}else{
			$this->flow2step3 =0;	//第3步， 完成
		}
	}
	 // end
	
	//begin  开题报告  流程图
	$flow3=M('flow')->where('type = 62')->limit(1)->order('id desc')->select();
	if (!empty($flow3)) {
		$this->flow3step1 =1;//第一步
		$this->flow3id= $flow3[0]['id'];
		if($flow3[0]['step'] ==40) {
			$this->flow3step2 =1;	//第二步， 完成
		}else{
			$this->flow3step2 =0;	//第二步， 完成
		}
	} // end
	
	//begin  中期检查  流程图
	$flow4=M('flow')->where('type = 63')->limit(1)->order('id desc')->select();
	if (!empty($flow4)) {
		$this->flow4step1 =1;//第一步
		$this->flow4id= $flow4[0]['id'];
		if($flow4[0]['step'] ==40) {
			$this->flow4step2 =1;	//第二步， 完成
		}else{
			$this->flow4step2 =0;	//第二步， 完成
		}
	} // end
	
	//begin  申报答辩  流程图
	$flow5=M('flow')->where('type = 64')->limit(1)->order('id desc')->select();
	if (!empty($flow5)) {
		$this->flow5step1 =1;//第一步
		$this->flow5id= $flow5[0]['id'];

		$this->flow5step2=M('flow_log')->where('step = 21 and flow_id = '.$this->flow5id)->limit(1)->order('id desc,result desc')->getField("result");//getField("status")  //第二步， 是1则第一个人审核通过完成
		
		if($flow5[0]['step'] ==40) {
			$this->flow5step3 =1;	//第三步， 完成
		}else{
			$this->flow5step3 =0;	//第三步， 完成
		}
	} // end

	$where_flow['type'] = array("in","60,61,62,63,64");
	$this->flow=M('flow')->where($where_flow)->limit(6)->order('id desc')->select();
	
	//订教材  颜色判断
	if ($this->flow2step1) {
		$this->btn1 ="btn-success";

		if ($this->flow2step2) {
			$this->btn2 ="btn-success";
			if ($this->flow2step3) {
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
	
	
	
		//订教材  颜色判断
	if ($this->flow5step1) {
		$this->btn21 ="btn-success";
//第二步开始
		if ($this->flow5step2) {
			$this->btn22 ="btn-success";
//第三步开始
			if ($this->flow5step3) {
				$this->btn23 ="btn-success";
			}else {
				$this->btn23 ="btn-danger";
			}
//第三步结束

		}
		
		else {
			$this->btn22 ="btn-danger";
		}
		//第二步开始
	}
	
	else {
		$this->btn21 ="btn-danger";
	}

	

	
	
		$this -> display();
	}
	
	public function dabian() {
		$widget['jquery-ui'] = true;
		$this -> assign("widget", $widget);
	$this->position_id=get_position_id();
	$this->user_rank=get_user_rank();

		$config = D("UserConfig") -> get_config();
		$this -> assign("home_sort", $config['home_sort']);
		
//begin 评阅
$flow6=M('task')->where('type = "232"')->select();
if (!empty($flow6)) {
	$this->flow6step1 =1;//第一步
	$this->flow6id =$flow6[0]['id'];
}else{
	$this->flow6step2 =0;//第2步
}
$flow65=M('flow')->where('type = 65')->limit(1)->order('id desc')->select();
if (!empty($flow65) && !empty($flow6)) {
	$this->flow6step2 =1;//第2步
	$this->flow65id =$flow65[0]['id'];
}
if($flow65[0]['step'] ==40) {
	$this->flow6step3 =1;	//第三步， 完成
}else if($flow65[0]['status'] == ""){
	$this->flow6step3 =0;	//第三步
}
// end
	
//begin 上报答辩总分
$flow66=M('flow')->where('type = 66')->limit(1)->order('id desc')->select();
if (!empty($flow66)) {
	$this->flow7step1 =1;
	$this->flow66id =$flow66[0]['id'];
}
if($flow66[0]['step'] ==40) {
	$this->flow7step2 =1;
}else if($flow66[0]['status'] == NULL){
	$this->flow7step2 =0;	
}
// end
		//订教材  颜色判断
	if ($this->position_id) {
		$this->btn1 ="btn-success";

		if ($this->flow6step2) {
			$this->btn2 ="btn-success";
			if ($this->flow6step3) {
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
	
	$where_flow['type'] = array("in","65,66");
	$this->flow=M('flow')->where($where_flow)->limit(6)->order('id desc')->select();
	
		$this -> display();
	}
	
	public function youyi() {
		$widget['jquery-ui'] = true;
		$this -> assign("widget", $widget);
	$this->position_id=get_position_id();
	$this->user_rank=get_user_rank();

		
	$this->flow=M('flow')->where('type = 90 ')->limit(6)->order('id desc')->select();
		
	//begin  评优异  流程图
	$flow1=M('flow')->where('type = 90 ')->limit(1)->order('id desc')->select();//and user_id='.get_user_id()
	if (!empty($flow1)) {
		$this->step1 =1;//第一步
		$this->flowid= $flow1[0]['id'];
		if($flow1[0]['step'] ==40) {
			$this->step2 =1;	//第二步， 完成
		}else{
			$this->step2 =0;	//第二步， 完成
		}
	} // end

	
	
		$this -> display();
	}

/**
*申报课题
*/
		public function shenbaokt() {



		$widget['jquery-ui'] = true;
		$this -> assign("widget", $widget);

		$config = D("UserConfig") -> get_config();
		$this -> assign("home_sort", $config['home_sort']);
		
		
	$where_flow['type'] = array("in","60");
	$this->flow=M('flow')->where($where_flow)->limit(6)->order('id desc')->select();
		
	//begin  申报课题  流程图
	$flow1=M('flow')->where('type = 60')->limit(1)->order('id desc')->select();
	if (!empty($flow1)) {
		$this->flow1step1 =1;//第一步
		$this->flow1id= $flow1[0]['id'];
		if($flow1[0]['step'] ==40) {
			$this->flow1step2 =1;	//第二步， 完成
		}else{
			$this->flow1step2 =0;	//第二步， 完成
		}
	} // end

	//订教材  颜色判断
	if ($this->flow2step1) {
		$this->btn1 ="btn-success";

		if ($this->flow2step2) {
			$this->btn2 ="btn-success";
			if ($this->flow2step3) {
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
	
	
	
		//订教材  颜色判断
	if ($this->flow5step1) {
		$this->btn21 ="btn-success";
//第二步开始
		if ($this->flow5step2) {
			$this->btn22 ="btn-success";
//第三步开始
			if ($this->flow5step3) {
				$this->btn23 ="btn-success";
			}else {
				$this->btn23 ="btn-danger";
			}
//第三步结束

		}
		
		else {
			$this->btn22 ="btn-danger";
		}
		//第二步开始
	}
	
	else {
		$this->btn21 ="btn-danger";
	}
	
		$this -> display();
	}

/**
*填任务书
*/
	public function tianrws() {
		$widget['jquery-ui'] = true;
		$this -> assign("widget", $widget);

		$config = D("UserConfig") -> get_config();
		$this -> assign("home_sort", $config['home_sort']);
		
		
	$where_flow['type'] = array("in","61");
	$this->flow=M('flow')->where($where_flow)->limit(6)->order('id desc')->select();
	
	//begin  任务书  流程图
	$flow2=M('flow')->where('type = 61')->limit(1)->order('id desc')->select();
	if (!empty($flow2)) {
		$this->flow2step1 =1;//第一步
		$this->flow2id= $flow2[0]['id'];
		
		$this->flow2step2=M('flow_log')->where('step = 21 and flow_id = '.$this->flow2id)->limit(1)->order('id desc,result desc')->getField("result");//getField("status")  
		//第二步， 是1则第一个人审核通过完成
		
		if($flow2[0]['step'] ==40) {
			$this->flow2step3 =1;	//第3步， 完成
		}else{
			$this->flow2step3 =0;	//第3步， 完成
		}
	}// end

	//订教材  颜色判断
	if ($this->flow2step1) {
		$this->btn1 ="btn-success";

		if ($this->flow2step2) {
			$this->btn2 ="btn-success";
			if ($this->flow2step3) {
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
	
	
	
		//订教材  颜色判断
	if ($this->flow5step1) {
		$this->btn21 ="btn-success";
//第二步开始
		if ($this->flow5step2) {
			$this->btn22 ="btn-success";
//第三步开始
			if ($this->flow5step3) {
				$this->btn23 ="btn-success";
			}else {
				$this->btn23 ="btn-danger";
			}
//第三步结束

		}
		
		else {
			$this->btn22 ="btn-danger";
		}
		//第二步开始
	}
	
	else {
		$this->btn21 ="btn-danger";
	}
		$this -> display();
	}

/**
*开题报告
*/
	public function kaitibg() {
		$widget['jquery-ui'] = true;
		$this -> assign("widget", $widget);

		$config = D("UserConfig") -> get_config();
		$this -> assign("home_sort", $config['home_sort']);
		
		
	$where_flow['type'] = array("in","62");
	$this->flow=M('flow')->where($where_flow)->limit(6)->order('id desc')->select();
	
	//begin  开题报告  流程图
	$flow3=M('flow')->where('type = 62')->limit(1)->order('id desc')->select();
	if (!empty($flow3)) {
		$this->flow3step1 =1;//第一步
		$this->flow3id= $flow3[0]['id'];
		if($flow3[0]['step'] ==40) {
			$this->flow3step2 =1;	//第二步， 完成
		}else{
			$this->flow3step2 =0;	//第二步， 完成
		}
	} // end

	//订教材  颜色判断
	if ($this->flow2step1) {
		$this->btn1 ="btn-success";

		if ($this->flow2step2) {
			$this->btn2 ="btn-success";
			if ($this->flow2step3) {
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
	
	
	
		//订教材  颜色判断
	if ($this->flow5step1) {
		$this->btn21 ="btn-success";
//第二步开始
		if ($this->flow5step2) {
			$this->btn22 ="btn-success";
//第三步开始
			if ($this->flow5step3) {
				$this->btn23 ="btn-success";
			}else {
				$this->btn23 ="btn-danger";
			}
//第三步结束

		}
		
		else {
			$this->btn22 ="btn-danger";
		}
		//第二步开始
	}
	
	else {
		$this->btn21 ="btn-danger";
	}
		$this -> display();
	}

	/**
*中期检查
*/
	public function zhongqijc() {
		$widget['jquery-ui'] = true;
		$this -> assign("widget", $widget);

		$config = D("UserConfig") -> get_config();
		$this -> assign("home_sort", $config['home_sort']);
		
		
	$where_flow['type'] = array("in","63");
	$this->flow=M('flow')->where($where_flow)->limit(6)->order('id desc')->select();
	
	//begin  中期检查  流程图
	$flow4=M('flow')->where('type = 63')->limit(1)->order('id desc')->select();
	if (!empty($flow4)) {
		$this->flow4step1 =1;//第一步
		$this->flow4id= $flow4[0]['id'];
		if($flow4[0]['step'] ==40) {
			$this->flow4step2 =1;	//第二步， 完成
		}else{
			$this->flow4step2 =0;	//第二步， 完成
		}
	} // end

	//订教材  颜色判断
	if ($this->flow2step1) {
		$this->btn1 ="btn-success";

		if ($this->flow2step2) {
			$this->btn2 ="btn-success";
			if ($this->flow2step3) {
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
	
	
	
		//订教材  颜色判断
	if ($this->flow5step1) {
		$this->btn21 ="btn-success";
//第二步开始
		if ($this->flow5step2) {
			$this->btn22 ="btn-success";
//第三步开始
			if ($this->flow5step3) {
				$this->btn23 ="btn-success";
			}else {
				$this->btn23 ="btn-danger";
			}
//第三步结束

		}
		
		else {
			$this->btn22 ="btn-danger";
		}
		//第二步开始
	}
	
	else {
		$this->btn21 ="btn-danger";
	}
		$this -> display();
	}
	

/**
*申报答辩
*/
	public function shenbaodb(){
		//echo "asdfasdf";
		//die();
		$widget['jquery-ui'] = true;
		$this -> assign("widget", $widget);

		$config = D("UserConfig") -> get_config();
		$this -> assign("home_sort", $config['home_sort']);
	
	
	$where_flow['type'] = array("in","64");
	$this->flow=M('flow')->where($where_flow)->limit(6)->order('id desc')->select();
	
	//begin  申报答辩  流程图
	$flow5=M('flow')->where('type = 64')->limit(1)->order('id desc')->select();
	if (!empty($flow5)) {
		$this->flow5step1 =1;//第一步
		$this->flow5id= $flow5[0]['id'];

		$this->flow5step2=M('flow_log')->where('step = 21 and flow_id = '.$this->flow5id)->limit(1)->order('id desc,result desc')->getField("result");//getField("status")  //第二步， 是1则第一个人审核通过完成
		
		if($flow5[0]['step'] ==40) {
			$this->flow5step3 =1;	//第三步， 完成
		}else{
			$this->flow5step3 =0;	//第三步， 完成
		}
	} // end

	//订教材  颜色判断
	if ($this->flow2step1) {
		$this->btn1 ="btn-success";

		if ($this->flow2step2) {
			$this->btn2 ="btn-success";
			if ($this->flow2step3) {
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
	
	
	
		//订教材  颜色判断
	if ($this->flow5step1) {
		$this->btn21 ="btn-success";
//第二步开始
		if ($this->flow5step2) {
			$this->btn22 ="btn-success";
//第三步开始
			if ($this->flow5step3) {
				$this->btn23 ="btn-success";
			}else {
				$this->btn23 ="btn-danger";
			}
//第三步结束

		}
		
		else {
			$this->btn22 ="btn-danger";
		}
		//第二步开始
	}
	
	else {
		$this->btn21 ="btn-danger";
	}
		$this -> display();
	}


	public function flow() {
		$widget['jquery-ui'] = true;
		$this -> assign("widget", $widget);

		$config = D("UserConfig") -> get_config();
		$this -> assign("home_sort", $config['home_sort']);
		$this -> display();
	}

}
?>