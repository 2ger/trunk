<?php
/*---------------------------------------------------------------------------
   

  Copyright (c) 2015 http://www.thinkphp.com All rights reserved.                                             

  Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )  

  Author:  thinkphp.com                         

  Support: http://www.thinkphp.com               
 -------------------------------------------------------------------------*/

class MonthlyReportCommentModel extends CommonModel {
	// 自动验证设置 
	function _after_insert($data,$options){
		$doc_id=$data["doc_id"];
		M("MonthlyReport")->where("id=$doc_id")->setField("update_time",time());
	}
}	
?>