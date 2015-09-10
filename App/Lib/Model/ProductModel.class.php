<?php
/*---------------------------------------------------------------------------
 

 Copyright (c) 2015 http://www.thinkphp.com All rights reserved.

 Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )

 Author:  thinkphp.com

 Support: http://www.thinkphp.com
 -------------------------------------------------------------------------*/

class ProductModel extends CommonModel {
	// 自动验证设置
	protected $_validate = array('name', 'require', '标题必须', 1);
	// 自动填充设置

}
?>