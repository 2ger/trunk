<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="utf-8" />
	<title><?php echo (($title)?($title):"smeoa"); ?></title>
	<meta name="description" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<!-- basic styles -->
	<link rel="stylesheet" href="__PUBLIC__/css/bootstrap.min.css"  />
	<!--[if lte IE 6]>
	    <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/bootstrap-ie6.css">
	    <![endif]-->
	    <!--[if lte IE 7]>
	    <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/ie.css">
	    <![endif]-->
			
	<link rel="stylesheet" href="__PUBLIC__/css/font-awesome.min.css" />

	<!--[if IE 7]>
	<link rel="stylesheet" href="__PUBLIC__/css/font-awesome-ie7.min.css" />
	<![endif]-->

	<!-- page specific plugin styles -->
	<link rel="stylesheet" href="__PUBLIC__/css/jquery-ui-1.10.3.full.min.css" />
	<link rel="stylesheet" href="__PUBLIC__/css/jquery.gritter.css" />
<?php if(!empty($widget["jquery-ui"])): ?><link rel="stylesheet" href="__PUBLIC__/css/jquery-ui-1.10.3.full.min.css" /><?php endif; ?>
<?php if(!empty($widget["date"])): ?><link rel="stylesheet" href="__PUBLIC__/css/datepicker.css" />
	<link rel="stylesheet" href="__PUBLIC__/css/bootstrap-datetimepicker.css" /><?php endif; ?>


	<!-- fonts -->
	<!-- ace styles -->
	<link rel="stylesheet" href="__PUBLIC__/css/uncompressed/ace.css" />
	<link rel="stylesheet" href="__PUBLIC__/css/uncompressed/ace-rtl.css" />
	<link rel="stylesheet" href="__PUBLIC__/css/uncompressed/ace-skins.css" />

	<!--[if lte IE 8]>
	<link rel="stylesheet" href="__PUBLIC__/css/uncompressed/ace-ie.css" />
	<![endif]-->

	<!-- inline styles related to this page -->
	<link rel="stylesheet" href="__PUBLIC__/css/style.css" />
	<!-- ace settings handler -->

	<script src="__PUBLIC__/js/ace-extra.min.js"></script>


		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="__PUBLIC__/v2/Content/css_public.css">
		<link rel="stylesheet" type="text/css" href="__PUBLIC__/v2/Content/leaddesktop.css">
		<!-- <link rel="stylesheet" type="text/css" href="__PUBLIC__/v2/Content/media-queries.css"> -->
		<link rel="stylesheet" type="text/css" href="__PUBLIC__/v2/Content/tahiti.css">
		<script src="__PUBLIC__/v2/Scripts/jquery.min.js" type="text/javascript">
</script>
		<script type="text/javascript" src="__PUBLIC__/v2/Scripts/jquery.easing.1.3.js">
</script>
		<script type="text/javascript" src="__PUBLIC__/v2/Scripts/lead.js">
</script>
		<link rel="stylesheet" href="__PUBLIC__/v2/Content/pure-min.css" type="text/css">


		<!-- <link rel="stylesheet" href="http://www.bootcss.com/p/buttons/css/buttons.css" type="text/css">
		 -->
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

	<!--[if lt IE 9]>
	<script src="__PUBLIC__/js/html5shiv.js"></script>
	<script src="__PUBLIC__/js/respond.min.js"></script>
	<![endif]-->
	<script type="text/javascript">
	var upload_url = "<?php echo U('upload');?>";
	var del_url = "<?php echo U('del_file');?>";
	var _hmt = _hmt || [];
	var app_path = "__ROOT__";
	(function() {
		var hm = document.createElement("script");
		hm.src = "//hm.baidu.com/hm.js?";//2a935166b0c9b73fef3c8bae58b95fe4
		var s = document.getElementsByTagName("script")[0];
		s.parentNode.insertBefore(hm, s);
	})();
</script>
<style type="text/css" media="screen">
.News,.Doc,.Node,.User,.Profile{max-width:1000px;margin:auto;}
.<?php echo ($fromtype); ?>{ 
	filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0\'/></filter></svg>#grayscale"); /* Firefox 3.5+ */ 
	-webkit-filter: grayscale(100%); /* chrome+ */ 
	filter: grayscale(100%); /* 未来浏览器 */ 
	filter: gray; /* ie6-8 */ 
	filter:progid:DXImageTransform.Microsoft.BasicImage(grayscale=1);/*ie6-9 */ 
}
.page-content{background-color:#eeeeee !important;}
.feimenu a.<?php echo ($top_menu2); ?>{ 
  background-color: #5bc0de !important;
}
</style>
</head>
<body>
	<div class="shade"></div>
	<div style="display:none">
		<nav class="navbar navbar-default " role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-6">
			<span class="sr-only">Toggle navigation</span>
			<i class="fa fa-bars fa-lg"></i>
      </button>
		  <div class="hidden-xs">&nbsp;</div>
         
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-collapse-6">
          <ul class="nav navbar-nav navbar-right">
				<?php if(is_array($top_menu)): foreach($top_menu as $key=>$top_menu_vo): ?><a class="btn btn-app app-nav btn-xs nav-app"  href="#" url="<?php echo U($top_menu_vo['url']);?>" node="<?php echo ($top_menu_vo["id"]); ?>" onclick="click_top_menu(this)" >
					<i class="<?php echo ($top_menu_vo["icon"]); ?> bigger-100"></i><?php echo ($top_menu_vo["name"]); ?>
					<?php $bc_class=""; $module_count=0; $icon_class=$top_menu_vo['icon']; if(strpos($icon_class,"bc-")!==false){ $bc_class=get_bc_class($icon_class); $module_count=array_sum($new_count[$bc_class]); if($module_count>99){ $module_count="99+"; } if($module_count==0){ $module_count=null; } } ?>
						<?php if(!empty($module_count)): ?><span class="badge badge-pink"><?php echo ($module_count); ?></span><?php endif; ?>					
				</a>&nbsp;&nbsp;<?php endforeach; endif; ?><a class="btn btn-app btn-xs btn-danger" style="margin-top:15px;margin-bottom:20px;margin-left:7px;margin-right:10px;" href="<?php echo U('login/logout');?>" ><i class="fa fa-sign-out bigger-100"></i>退出</a>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>
	</div>

<div id="header" class="hidden-print">
			<div class="logos">
				<div class="tdlogo">
					<img src="__PUBLIC__/v2/Images/logo.png" width="" height="80" >
				</div>
			</div>
			<div class="menus feimenu">	
				<a href="__APP__/home/index" node="301" onclick="click_top_menu(301,1)"  class="btn pa onselect top_menu301" >工作概览</a>
				<a href="__APP__/news/folder?fid=74&from=gong" node="313" onclick="click_top_menu(313,1)" class="btn pos_top top_menu313" >公共体育</a>
				<a href="__APP__/news/folder?fid=66&from=zhuan" node="321" onclick="click_top_menu(321,1)" class="btn pos_ty top_menu321" >体育专业</a>
				<a href="__APP__/jianshe/index" node="329" onclick="click_top_menu(329,1)"  class="btn pos_kx top_menu329" >科学研究</a>
				<a href="__APP__/kxjianshe/index" node="333" onclick="click_top_menu(333,1)" class="btn pos_xk top_menu333" >学科建设</a>
				<a href="__APP__/gzshenpi/index" node="334" onclick="click_top_menu(334,1)" class="btn pos_xz top_menu334" >行政管理</a>
				<a href="__APP__/grzhongxin/index" node="255" onclick="click_top_menu(255,1)" class="btn pos_gz top_menu255" >行政工作</a>
				<a href="__APP__/huiyi" node="351" onclick="click_top_menu(351,1)" class="btn pos_bg top_menu351" >会议</a>
			</div>
			<div class="user_head_ico">
				<img onerror="this.src='__PUBLIC__/v2/ico/3.png'" src="__PUBLIC__/people/<?php echo get_user_id();?>.jpg">
			<a href="<?php echo U('home/index');?>" style="    position: absolute;
    z-index: 2;
    top: 10%;
    right: -10px;
}">
					<span class="badge badge-pink"> <?php echo getToDoNum();?> </span>
			</a>
			</div>
			<div class="title_div">
				<div class="logo" style="background: none!important;">
					<table class="table table-bordered table-condensed" style="color:#fff">
					    <tr>
					        <td>编号</td>
					        <td><?php echo get_emp_no();?></td>
					    </tr>
					    <tr>
					        <td>职务</th>
					        <td><?php echo get_rank_name();?></td>
					    </tr>
					    <tr>
					        <td>电话  </td>
					        <td> <?php echo get_user_tel();?> </td>
					    </tr>
					</table>
				</div>
				<div class="username">
					<a href="<?php echo U('grzhongxin/index');?>" style="color:#fff"><?php echo (session('user_name')); ?></a>
					<!-- <?php echo get_dept_name();?> -->
					 |&nbsp;
					<a href="<?php echo U('login/logout');?>" style="color:#fff">退出</a>
				</div>
			</div>
		</div><!-- #header -->
		<div class="main-container" id="main-container">
			<div class="main-container-inner">
				<div class="sidebar" id="sidebar">	
					<!-- <div id="user_info" class="text-center hidden-xs"  >
						<span >当前用户：<?php echo (session('user_name')); ?></span>
					</div> -->
					<!-- <div id="nav_head" class="text-center"  onclick="toggle_left_menu()">
						<span class="menu-text"><?php echo ($top_menu_name); ?></span>
						<b id="left_menu_icon" class="fa fa-angle-down pull-right"></b>
					</div> -->
					<?php echo W('Nav',array('tree'=>$left_menu,'new_count'=>$new_count));?>
				</div>
				<div class="main-content">
					<div class="breadcrumbs hidden" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="fa fa-home home-icon"></i>
								<?php echo ($top_menu_name); ?>
							</li>
<!--						<li>
								<?php echo ($top_menu_name); ?>
							</li> -->
						</ul><!-- .breadcrumb -->
					</div>

					<div class="page-content  <?php echo (MODULE_NAME); ?>">
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
									
<style type="text/css" media="screen">
#sidebar{display:none;}
.main-content{margin-left:0;}
	.sidebars{ min-width: 190px;float: left;}
.sidebars li a .menu-text{ font-size:16px!important;}
</style>
<div class="sidebars">				
	<ul id="left_menu" class="nav nav-list">
		<li class="active open">
		<a node="<?php echo ($vo["id"]); ?>" href="<?php echo U('grzhongxin/index');?>?tasktype=<?php echo ($userlist['id']); ?>" >
		<i class="fa fa-angle-right"></i><span class="menu-text"><?php echo ($userlist['name']); ?>个人中心</span></a>
		</li>
		<?php if(is_array($leftMenu)): $i = 0; $__LIST__ = $leftMenu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
				<?php echo left_menu_status($vo['type'],$userlist['id']);?>
			<!--<a href="<?php echo U('grzhongxin/myjob');?>?id=<?php echo ($userlist['id']); ?>&tasktype=<?php echo ($vo["type"]); ?>">
			<i class="fa fa-angle-right"></i><span class="menu-text"><?php echo ($vo["name"]); ?> </span></a>-->
			</li><?php endforeach; endif; else: echo "" ;endif; ?>
	</ul>
</div>
<link rel="stylesheet" href="__PUBLIC__/css/style.css" />
				
<div id="content" style="height:1120px">
				
				<div class="blocks" style="left:0;  width: 100%;">
			<div class="block meeting">
            	<div class="main">
                	<div class="div_title no_select">个人信息
                    	<span>
                   		<a href="<?php echo U('task/add');?>?type=104&uid=<?php echo ($userlist['id']); ?>" class="btn btn-xs btn-success">给他/她发布任务</a>
                        </span>
                    </div>
				 <table class="pure-table pure-table-bordered" style="width: 90%;margin: 30px 20px;">
				     <thead>
				           <tr>
				               <th>头像</th>
                               <th>员工编号</th>
				               <th><?php echo ($userlist['emp_no']); ?></th>
				           </tr>
<style type="text/css" media="screen">
tr th{ text-align:center!important}
</style>
				       </thead>
				                  <tbody>     
                                
				                     <tr>
                                         <td class="" rowspan="3"><img width="100" onerror="this.src='__PUBLIC__/v2/ico/3.png'" src="__PUBLIC__/people/<?php echo ($userlist['id']); ?>.jpg">
										 <br /> <a href="<?php echo U('profile/index');?>" title="">修改个人信息</a> <br /> <a href="<?php echo U('profile/password');?>" title="">修改密码</a>
										 </td>
	                                      <td class="">姓名</td>
	                                      <td class=""><?php echo ($userlist['name']); ?></td>
									 </tr>   
									 <tr>
                                         <td class="">职务</td>
                                         <td class=""><?php echo (get_rank_name($userlist['rank_id'])); ?></td>
									 </tr>  
									 <tr>
                                         <td class="">电话</td>
                                         <td class=""><?php echo (($userlist['tel'])?($userlist['tel']):"未填写"); ?></td>
									 </tr>  
							</tbody></table> 
							
                  
                </div>               
            </div>
            <div class="block email">
            	<div class="main">
                	<div class="div_title no_select">教学工作</div>
                	<table class="pure-table pure-table-bordered" style="width: 90%;margin: 30px 20px;">
                    <tr>
    <td>专业</td>
    <td></td>
    <td>公体</td>
    <td></td>
  </tr>
  <tr>
    <td>教材</td>
    <td><?php if(is_array($data01)): $i = 0; $__LIST__ = $data01;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U('flow/read');?>?id=<?php echo ($vo["id"]); ?>"
><?php echo ($vo["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?></td>
    <td>教材</td>
    <td><?php if(is_array($data11)): $i = 0; $__LIST__ = $data11;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U('flow/read');?>?id=<?php echo ($vo["id"]); ?>"
><?php echo ($vo["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?></td>
  </tr>
  <tr>
    <td>计划</td>
    <td><?php if(is_array($data02)): $i = 0; $__LIST__ = $data02;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U('flow/read');?>?id=<?php echo ($vo["id"]); ?>"
><?php echo ($vo["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?></td>
    <td>计划</td>
    <td><?php if(is_array($data12)): $i = 0; $__LIST__ = $data12;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U('flow/read');?>?id=<?php echo ($vo["id"]); ?>"
><?php echo ($vo["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?></td>
  </tr>
  <tr>
    <td>试卷</td>
    <td><?php if(is_array($data03)): $i = 0; $__LIST__ = $data03;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U('flow/read');?>?id=<?php echo ($vo["id"]); ?>"
><?php echo ($vo["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?></td>
    <td>试卷</td>
    <td><?php if(is_array($data13)): $i = 0; $__LIST__ = $data13;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U('flow/read');?>?id=<?php echo ($vo["id"]); ?>"
><?php echo ($vo["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?></td>
  </tr>
  <tr>
    <td>大纲</td>
    <td><?php if(is_array($data04)): $i = 0; $__LIST__ = $data04;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U('flow/read');?>?id=<?php echo ($vo["id"]); ?>"
><?php echo ($vo["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?></td>
    <td>大纲</td>
    <td><?php if(is_array($data14)): $i = 0; $__LIST__ = $data14;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U('flow/read');?>?id=<?php echo ($vo["id"]); ?>"
><?php echo ($vo["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?></td>
  </tr>
  <tr>
    <td>教案</td>
    <td><?php if(is_array($data05)): $i = 0; $__LIST__ = $data05;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U('flow/read');?>?id=<?php echo ($vo["id"]); ?>"
><?php echo ($vo["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?></td>
    <td>教案</td>
    <td><?php if(is_array($data15)): $i = 0; $__LIST__ = $data15;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U('flow/read');?>?id=<?php echo ($vo["id"]); ?>"
><?php echo ($vo["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?></td>
  </tr>
  <tr>
    <td>总结</td>
    <td><?php if(is_array($data06)): $i = 0; $__LIST__ = $data06;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U('flow/read');?>?id=<?php echo ($vo["id"]); ?>"
><?php echo ($vo["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?></td>
    <td>总结</td>
    <td><?php if(is_array($data16)): $i = 0; $__LIST__ = $data16;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U('flow/read');?>?id=<?php echo ($vo["id"]); ?>"
><?php echo ($vo["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?></td>
  </tr>
                     </table>
                     
                </div>
            </div>

			
					
					
					
					<div class="block meeting" style="height:400px">
		            	<div class="main">
					        <div class="div_title no_select">异常指标</div>
							<ul>
                            <?php if(is_array($yichang)): $i = 0; $__LIST__ = $yichang;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>【<?php echo (get_user_ssk($vo["user_id"])); ?>】<font color="#000000"><?php echo ($vo["name"]); ?></font> &nbsp;<?php echo ($vo["start_time"]); ?>
								</li><?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
							<!-- <iframe src="<?php echo U('schedule/index');?>" id="8" name="40" frameBorder=0 scrolling=no height=400 width="100%"></iframe> -->
						
						</div>
					           
					</div> <!-- end block -->
					
					
					
					
					
					<div class="block email" style="height:400px">
					            	<div class="main" >
					                	<div class="div_title no_select">课程表</div>
          
                       <table  class="table table-striped table-bordered table-condensed" style="margin:30px 20px; width:95%;clear:both;width" id="mytable">
					                        <thead>
					                          <tr>
					                            <th class="">
					                              时间
					                            </th>
					                            <th>
					                              星期一
					                            </th>
					                            <th>
					                              星期二
					                            </th>
					                            <th class="hidden-phone">
					                             星期三
					                            </th>
					                            <th class="hidden-phone">
					                             星期四
					                            </th>
					                            <th class="hidden-phone">
					                              星期五
					                            </th>
					                          </tr>
					                        </thead>
					                        <tbody>
					                          <tr class="">
					                            <td>
					                              1-2节
					                            </td>
					                            <td>
					                              <?php echo get_action_weekone(1,"1");?>
					                            </td>
					                            <td class="hidden-phone">
					                              <?php echo get_action_weekone(2,"1");?>
					                            </td>
					                            <td class="hidden-phone">
					                              <?php echo get_action_weekone(3,"1");?>
					                            </td>
					                            <td class="hidden-phone">
					                              <?php echo get_action_weekone(4,"1");?>
					                            </td>
					                            <td class="hidden-phone">
					                              <?php echo get_action_weekone(5,"1");?>
					                            </td>
					                          </tr>
					                          <tr class="">
					                            <td>
					                               3-4节
					                            </td>
					                            <td>
					                              <?php echo get_action_weekone(1,"2");?>
					                            </td>
					                            <td class="hidden-phone">
					                              <?php echo get_action_weekone(2,"2");?>
					                            </td>
					                            <td class="hidden-phone">
					                              <?php echo get_action_weekone(3,"2");?>
					                            </td>
					                            <td class="hidden-phone">
					                              <?php echo get_action_weekone(4,"2");?>
					                            </td>
					                            <td class="hidden-phone">
					                              <?php echo get_action_weekone(5,"2");?>
					                            </td>
					                          </tr>
					                          <tr class="">
					                            <td>
					                               6-7节
					                            </td>
				                            <td>
				                              <?php echo get_action_weekone(1,"3");?>
				                            </td>
				                            <td class="hidden-phone">
				                              <?php echo get_action_weekone(2,"3");?>
				                            </td>
				                            <td class="hidden-phone">
				                              <?php echo get_action_weekone(3,"3");?>
				                            </td>
				                            <td class="hidden-phone">
				                              <?php echo get_action_weekone(4,"3");?>
				                            </td>
				                            <td class="hidden-phone">
				                              <?php echo get_action_weekone(5,"3");?>
				                            </td>
					                          </tr>
					                          <tr class="">
					                            <td>
					                               8-9节
					                            </td>
					                            <td>
					                              <?php echo get_action_weekone(1,"4");?>
					                            </td>
					                            <td class="hidden-phone">
					                              <?php echo get_action_weekone(2,"4");?>
					                            </td>
					                            <td class="hidden-phone">
					                              <?php echo get_action_weekone(3,"4");?>
					                            </td>
					                            <td class="hidden-phone">
					                              <?php echo get_action_weekone(4,"4");?>
					                            </td>
					                            <td class="hidden-phone">
					                              <?php echo get_action_weekone(5,"4");?>
					                            </td>
					                          </tr>
					            
					                        </tbody>
					                      </table>
                                         
				                                                    
							</table>
									 
					                </div>               
					</div> <!-- end block -->
			
						<div class="block work" id="switchdiv1" style="overflow: hidden; z-index: 3;">
									<div class="main">
										<div class="div_title1 no_select">
											<div class="switch_btn divBG2 divBG1">
												待办任务
											</div>
											<div class="switch_btn divBG2">
												完成任务
											</div>
										</div>
										<div class="worklist">
											<div class="wait switch_">
												<ul>
			                                    <?php if(is_array($fabu)): $i = 0; $__LIST__ = $fabu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>【<?php echo ($vo["user_name"]); ?>】<a href="<?php echo U('task/read');?>?id=<?php echo ($vo["id"]); ?>"
			 title=""><font color="#000000"><?php echo ($vo["name"]); ?></font></a>&nbsp;<?php echo (date('Y-m-d',$vo["create_time"])); ?>
													</li><?php endforeach; endif; else: echo "" ;endif; ?>
												</ul>
											</div>
											<div class="already switch_" style="left: 856px; opacity: 0;">
												<ul>
													<?php if(is_array($jieshou)): $i = 0; $__LIST__ = $jieshou;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>【<?php echo ($vo["user_name"]); ?>】<a href="<?php echo U('task/read');?>?id=<?php echo ($vo["task_id"]); ?>"
			><font color="#000000">(<?php echo ($vo["name"]); ?>)</font></a>&nbsp;<?php echo (date('Y-m-d',$vo["create_time"])); ?>
													</li><?php endforeach; endif; else: echo "" ;endif; ?>
												</ul>
											</div>
										</div>
									</div>
								</div>
			

			            <div class="block work" id="switchdiv2" style="overflow: hidden; z-index: 3;">
									<div class="main">
										<div class="div_title1 no_select">
											<div class="switch_btn divBG2 divBG1">
												追踪流程								</div>
											<div class="switch_btn divBG2">
												完成流程
											</div>
										</div>
										<div class="worklist">
											<div class="wait switch_">
												<ul>
			                                    <?php if(is_array($faqi)): $i = 0; $__LIST__ = $faqi;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>【<?php echo ($vo["user_name"]); ?>】<a href="<?php echo U('flow/read');?>?id=<?php echo ($vo["flow_id"]); ?>"><font color="#000000"><?php echo ($vo["name"]); ?></font></a>&nbsp;<?php echo (date('Y-m-d',$vo["create_time"])); ?>
													</li><?php endforeach; endif; else: echo "" ;endif; ?>
												</ul>
											</div>
											<div class="already switch_" style="left: 856px; opacity: 0;">
												<ul>
													<?php if(is_array($shenpi)): $i = 0; $__LIST__ = $shenpi;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>【<?php echo ($vo["user_name"]); ?>】<a href="<?php echo U('flow/read');?>?id=<?php echo ($vo["flow_id"]); ?>"
			><font color="#000000">(已审批)</font></a>&nbsp;<?php echo (date('Y-m-d',$vo["create_time"])); ?>
													</li><?php endforeach; endif; else: echo "" ;endif; ?>
												</ul>
											</div>
										</div>
									</div>
								</div>
								
         </div>
			</div>
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div><!-- /.main-content -->
				</div><!-- /#ace-settings-container -->
			</div><!-- /.main-container-inner -->

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse hidden-print">
				<i class="fa fa-double-angle-up fa-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->
	<div id="push_msg"></div>
	<iframe src="<?php echo U('push/client2');?>" class="push" id="push"></iframe>
	<!-- basic scripts -->

	<!--[if !IE]>
	-->
	<script type="text/javascript">
function open_url(URL,FORMAT)
		{
		//URL="/index.php?s=/Admin/Article1/detail/id/"+NOTIFY_ID+".html";
		myleft=(screen.availWidth-780)/2;
		mytop=100
		mywidth=950;
		myheight=700;
		if(FORMAT=="1")
		{

			mywidth=1000;
			myheight=800;
		// myleft=0;
// 		mytop=0
// 		mywidth=screen.availWidth-10;
// 		myheight=screen.availHeight-40;
		}
		window.open(URL,"read_notify","height="+myheight+",width="+mywidth+",status=1,toolbar=no,menubar=no,location=no,scrollbars=yes,top="+mytop+",left="+myleft+",resizable=yes");
		}
		
			window.jQuery || document.write("<script src='__PUBLIC__/js/jquery-2.1.0.min.js'>" + "<" + "/script>");</script>
<!-- <![endif]-->

<!--[if IE]>
<script src="__PUBLIC__/js/html5.js"></script>
<script type="text/javascript">
		window.jQuery || document.write("<script src='__PUBLIC__/js/jquery-1.11.0.min.js'>"+"<"+"/script>");</script>
<![endif]-->
<script type="text/javascript">
			if ("ontouchend" in document)
				document.write("<script src='__PUBLIC__/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");</script>
<script src="__PUBLIC__/js/bootstrap.min.js"></script>
<!--[if lte IE 6]>
<script type="text/javascript" src="__PUBLIC__/js/bootstrap-ie.js"></script>
<![endif]-->
<script src="__PUBLIC__/js/typeahead-bs2.min.js"></script>
<script src="__PUBLIC__/js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="__PUBLIC__/js/jquery.ui.touch-punch.min.js"></script>
<script src="__PUBLIC__/js/jquery.slimscroll.min.js"></script>

<?php if(!empty($widget["jquery-ui"])): ?><script src="__PUBLIC__/js/jquery-ui-1.10.3.custom.min.js"></script>
	<script src="__PUBLIC__/js/jquery.ui.touch-punch.min.js"></script><?php endif; ?>

<?php if(!empty($widget["date"])): ?><script src="__PUBLIC__/js/date-time/bootstrap-datepicker.js"></script>
	<script src="__PUBLIC__/js/date-time/locales/bootstrap-datepicker.zh-CN.js"></script>
	<script src="__PUBLIC__/js/date-time/bootstrap-datetimepicker.js"></script>
	<script src="__PUBLIC__/js/date-time/locales/bootstrap-datetimepicker.zh-CN.js"></script><?php endif; ?>

<?php if(!empty($widget["uploader"])): ?><script type="text/javascript" src="__PUBLIC__/plupload/plupload.full.min.js"></script>
	<script type="text/javascript" src="__PUBLIC__/plupload/plupload.setting.js"></script><?php endif; ?>

<?php if(!empty($widget["editor"])): ?><script type="text/javascript" src="__PUBLIC__/editor/kindeditor.js"></script>
	<script type="text/javascript" src="__PUBLIC__/editor/lang/zh_CN.js"></script>
	<script type="text/javascript" src="__PUBLIC__/editor/kindeditor.setting.js"></script><?php endif; ?>
<script src="__PUBLIC__/js/jquery.gritter.min.js"></script>
<script src="__PUBLIC__/js/bootbox.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		<?php if(!empty($widget["date"])): ?>$('.input-date').datepicker({
			language : "zh-CN",
			//setStartDate:<?php echo mktime();?>,
			autoclose : true
		});
		$(".input-daterange").datepicker({
			format : "yyyy-mm-dd",
			language : "zh-CN",
			keyboardNavigation : false,
			forceParse : false,
			autoclose : true,
		});
		$(".input-date-time").datetimepicker({
			format : "yyyy-mm-dd hh:ii",
			language : "zh-CN",
			setStartDate:<?php echo mktime();?>,
			weekStart : 1,
			todayBtn : 1,
			autoclose : 1,
			todayHighlight : 1,
			startView : 2,
			forceParse : 0,
			showMeridian : 1,
			minuteStep:10
		});<?php endif; ?>

		<?php if(!empty($widget["editor"])): ?>editor_init();<?php endif; ?>
	}); 
</script>

<!-- ace scripts -->
<script src="__PUBLIC__/js/ace-elements.min.js"></script>
<script src="__PUBLIC__/js/uncompressed/ace.js"></script>
<script src="__PUBLIC__/js/common.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/calendar.js"></script>
<script type="text/javascript">
	function showdata() {
		y = $("#year").val();
		m = $("#month").val();
		$("#panel").html(y + "年" + m + "月");
		start_date1 = $("#UL0").attr("class").substr(4);
		end_date1 = $("#UL41").attr("class").substr(4);
		$.getJSON("<?php echo U('schedule/json');?>", {
			start_date : start_date1,
			end_date : end_date1
		}, function(data) {
			count = 0;
			prev_date = '';
			$(".mv-container ul").html("");
			if (data != null) {
				$.each(data, function(i) {
					html = '<li id=li_' + data[i].id + ' style=background-color:' + schedule_bg(data[i].priority) + ">";
					html += '<a id=' + data[i].id + ' class="event_msg" title="' + data[i].name + '">';
					html += data[i].name;
					html += ' </a>';
					html += "</li>";
					if (prev_date == data[i].start_time.substr(0,10)) {
						count++;
						if (count == 4) {
							$("ul.div_" + data[i].start_time.substr(0,10)).append('<li class=\"all\">显示全部...</li>');
						}
					}
					prev_date = data[i].start_time;
					$("ul.div_" + data[i].start_time.substr(0,10)).append(html);
				});
			}
		});
	}


	$(document).ready(function() {
		initial();
		set_return_url();

		$(document).on("click", "a.event_msg", (function() {
			var msg_list = "";
			current = $(this).attr('id');
			$("a#" + current).parent().parent().find('a.event_msg').each(function() {
				msg_list += $(this).attr("id") + "|";
			});
			winopen("<?php echo U('schedule/read');?>?id=" + $(this).attr('id') + "&list=" + msg_list, 730, 490);
		}));
		$("#dialog2").mouseleave(function() {
			$("#dialog2").hide();
		});
		$(document).on("click", "li.all", function() {
			//$("li.all").on("click",function(){
			$(this).parent().find("li.all").hide();
			html = $(this).parent().html();
			$(this).parent().find("li.all").show();
			html = $("<ol></ol>").html(html);
			$("#dialog2").html(html);
			$("#dialog2").show();

			$("#dialog2").css("left", $(this).parents("ul").offset().left - $(".Schedule").offset().left - 8);
			$("#dialog2").css("top", $(this).parents("ul").offset().top - $(".Schedule").offset().top - 8);
		});
	});
	// function add() {
// 		window.open("<?php echo U('add');?>", "_self");
// 	}
//
// 	function month_view() {
// 		window.open('__URL__', "_self");
// 	}
//
// 	function day_view() {
// 		window.open("<?php echo U('day_view');?>", "_self");
// 	}
</script>
<!-- inline scripts related to this page -->
</body>
</html>