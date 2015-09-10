<?php
/*---------------------------------------------------------------------------
   

  Copyright (c) 2015 http://www.thinkphp.com All rights reserved.                                             

  Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )  

  Author:  thinkphp.com                         

  Support: http://www.thinkphp.com               
 -------------------------------------------------------------------------*/

class FlowViewModel extends ViewModel {
	public $viewFields=array(
		'Flow'=>array('*'),
		'FlowType'=>array('name'=>'type_name','_on'=>'FlowType.id=Flow.type')
		);
}
?>