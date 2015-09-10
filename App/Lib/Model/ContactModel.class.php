<?php
/*---------------------------------------------------------------------------
   

  Copyright (c) 2015 http://www.thinkphp.com All rights reserved.                                             

  Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )  

  Author:  thinkphp.com                         

  Support: http://www.thinkphp.com               
 -------------------------------------------------------------------------*/


class ContactModel extends CommonModel {
	// 自动验证设置
	protected $_validate	 =	 array(
		array('name','require','姓名必须！',1),
		array('email','email','邮箱格式错误！',2),
		);
}
?>