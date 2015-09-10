<?php
/*---------------------------------------------------------------------------
   

  Copyright (c) 2015 http://www.thinkphp.com All rights reserved.                                             

  Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )  

  Author:  thinkphp.com                         

  Support: http://www.thinkphp.com               
 -------------------------------------------------------------------------*/

class IndexAction extends CommonAction {
	protected $config=array('app_type'=>'asst');
	// 框架首页

	public function index() {
		//$this->display();
		$this -> redirect("home/index");
	}
}
?>