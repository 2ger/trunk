<?php
/*---------------------------------------------------------------------------
   

  Copyright (c) 2015 http://www.thinkphp.com All rights reserved.                                             

  Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )  

  Author:  thinkphp.com                         

  Support: http://www.thinkphp.com               
 -------------------------------------------------------------------------*/

class FinanceViewModel extends ViewModel {
	public $viewFields=array(
		'Finance'=>array('*'),
		'FinanceAccount'=>array('name'=>'account_name','_on'=>'Finance.account_id=FinanceAccount.id')
		);
}
?>