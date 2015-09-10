<?php
/*---------------------------------------------------------------------------
   

  Copyright (c) 2015 http://www.thinkphp.com All rights reserved.                                             

  Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )  

  Author:  thinkphp.com                         

  Support: http://www.thinkphp.com               
 -------------------------------------------------------------------------*/

class XmkReportModel extends CommonModel {
	// 自动验证设置
	protected $_validate	 =	 array(
		//array('name','require','文件名必须',1),
		array('content','require','内容必须'),
		);
 
	function _after_insert($data,$options){
		$xid=$data["xid"];
		M("Xmk")->where("id=$xid")->setField("update_time",time());
	}
}	
?>