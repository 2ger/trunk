<?php
/*---------------------------------------------------------------------------
   

  Copyright (c) 2015 http://www.thinkphp.com All rights reserved.                                             

  Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )  

  Author:  thinkphp.com                         

  Support: http://www.thinkphp.com               
 -------------------------------------------------------------------------*/


class NoticeViewModel extends ViewModel {
	public $viewFields=array(
		'Notice'=>array('*'),
		'SystemFolder'=>array('name'=>'folder_name','_on'=>'Notice.folder=SystemFolder.id')
		);
}
?>