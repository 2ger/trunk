<?php
/*---------------------------------------------------------------------------
   

  Copyright (c) 2015 http://www.thinkphp.com All rights reserved.                                             

  Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )  

  Author:  thinkphp.com                         

  Support: http://www.thinkphp.com               
 -------------------------------------------------------------------------*/

class DocViewModel extends ViewModel {
	public $viewFields=array(
		'Doc'=>array('*'),
		'SystemFolder'=>array('name'=>'folder_name','_on'=>'Doc.folder=SystemFolder.id')
		);
}
?>