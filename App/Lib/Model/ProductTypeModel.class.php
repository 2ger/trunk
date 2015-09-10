<?php
/*---------------------------------------------------------------------------
   

  Copyright (c) 2015 http://www.thinkphp.com All rights reserved.                                             

  Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )  

  Author:  thinkphp.com                         

  Support: http://www.thinkphp.com               
 -------------------------------------------------------------------------*/


class ProductTypeModel extends CommonModel {
	// 自动验证设置
	protected $_validate	 =	 array(
		array('name','require','名称必须',1),
		array('short','require','简称必须',1),
		);
}
?>