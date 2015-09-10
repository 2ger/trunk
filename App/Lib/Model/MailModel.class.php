<?php
/*---------------------------------------------------------------------------
   

  Copyright (c) 2015 http://www.thinkphp.com All rights reserved.                                             

  Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )  

  Author:  thinkphp.com                         

  Support: http://www.thinkphp.com               
 -------------------------------------------------------------------------*/


class MailModel extends CommonModel {
	// 自动验证设置
	protected $_validate = array( array('name', 'require', '标题必须！', 1), array('content', 'require', '内容必须'), );
}
?>