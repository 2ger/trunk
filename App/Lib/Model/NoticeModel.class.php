<?php
/*---------------------------------------------------------------------------
   

  Copyright (c) 2015 http://www.thinkphp.com All rights reserved.                                             

  Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )  

  Author:  thinkphp.com                         

  Support: http://www.thinkphp.com               
 -------------------------------------------------------------------------*/

class NoticeModel extends CommonModel {
	// 自动验证设置
	protected $_validate	 =	 array(
		array('name','require','标题必须',1),
		array('content','require','内容必须'),
		);
       
	function _before_insert(&$data,$options){
        $sql = "SELECT CONCAT(year(now()),'-',LPAD(count(*)+1,4,0)) notice_no FROM `".$this->tablePrefix."notice` WHERE 1 and year(FROM_UNIXTIME(create_time))>=year(now())";     
        $rs = $this->db->query($sql);
        if($rs){
            $data['notice_no']=$rs[0]['notice_no'];    
        }else{
            $data['notice_no']=date('Y')."-0001"; 
        }
	}
}	
?>