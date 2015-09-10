<?php
/*---------------------------------------------------------------------------
   

  Copyright (c) 2015 http://www.thinkphp.com All rights reserved.                                             

  Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )  

  Author:  thinkphp.com                         

  Support: http://www.thinkphp.com               
 -------------------------------------------------------------------------*/

class PushViewModel extends ViewModel {
	public $viewFields=array(
		'Push'=>array('*'),
		'User'=>array('name','openid','_on'=>'Push.user_id=User.id')
		);
}
?>