<?php
/*---------------------------------------------------------------------------
   

  Copyright (c) 2015 http://www.thinkphp.com All rights reserved.                                             

  Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )  

  Author:  thinkphp.com                         

  Support: http://www.thinkphp.com               
 -------------------------------------------------------------------------*/

class MailAccountViewModel extends ViewModel {
	public $viewFields=array(
		'MailAccount'=>array('*'),
		'User'=>array('_on'=>'MailAccount.id=User.id')
		);
}
?>