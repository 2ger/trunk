<?php
/*---------------------------------------------------------------------------
   

  Copyright (c) 2015 http://www.thinkphp.com All rights reserved.                                             

  Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )  

  Author:  thinkphp.com                         

  Support: http://www.thinkphp.com               
 -------------------------------------------------------------------------*/

class ProductTypeViewModel extends ViewModel {
	public $viewFields=array(
		'ProductType'=>array('*'),
		'SystemTag'=>array('name'=>'tag_name','_on'=>'ProductType.tag=SystemTag.id')
		);
}
?>