<?php
/*---------------------------------------------------------------------------
   

  Copyright (c) 2015 http://www.thinkphp.com All rights reserved.                                             

  Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )  

  Author:  thinkphp.com                         

  Support: http://www.thinkphp.com               
 -------------------------------------------------------------------------*/

class NewsFolderAction extends SystemFolderAction {
	protected $config=array('app_type'=>'master');
	//过滤查询字段
	function _search_filter(&$map) {
		$map['name'] = array('like', "%" . $_POST['name'] . "%");
		$map['is_del'] = array('eq', '0');
	}

	function index() {
		if ($_GET['from'] == 'gong') {
			// cookie("current_node", 342);
	// 		cookie("top_menu", 340);
			cookie("fromtype", 'zhuan');
		}else {
			// cookie("current_node", 219);
// 			cookie("top_menu", 217);
			cookie("fromtype", 'gong');
		}
		
		$this -> assign("folder_name", "文件夹管理");
		$this ->_index();
	}
}
