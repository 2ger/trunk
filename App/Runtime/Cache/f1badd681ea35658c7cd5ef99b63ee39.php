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
									
<div class="page-header">
	<h1><?php echo ($vo["name"]); ?></h1>
</div>
<div class="operate panel panel-default hidden-print">
	<div class="panel-body">
		<div class="pull-left">
			<a onclick="window.history.back()" class="btn btn-sm btn-primary hidden-print">返回</a>
			<a onclick="winprint();" class="btn pull-left btn-sm btn-success hidden-print">打印</a>
			
		</div>
			<?php if(($UID) == $vo["user_id"]): ?><a href="__APP__/task/del/id/<?php echo ($task_id); ?>" class="btn pull-right btn-sm btn-danger">删除任务</a><?php endif; ?>

		<div class="text-center">
			<?php if(($no_assign) == "1"): ?><a onclick="let_me_do(<?php echo ($task_id); ?>)" class="btn btn-md btn-primary">我来处理</a><?php endif; ?>
			<?php if(($is_accept) == "1"): ?><a onclick="accept(<?php echo ($task_log_id); ?>)" class="btn btn-md btn-success">接受任务</a>
				<!-- <a onclick="reject(<?php echo ($task_log_id); ?>);" class="btn btn-md btn-danger">不接受</a> --><?php endif; ?>
		</div>
	</div>
</div>


<form method='post' id="form_data" name="form_data" enctype="multipart/form-data"   class=" form-horizontal">
	<input type="hidden" id="ajax" name="ajax" value="0">
	<input type="hidden" id="add_file" name="add_file">
	<input type="hidden" id="executor" name="executor" value="<?php echo ($vo["executor"]); ?>">
	<input type="hidden" id="opmode" name="opmode" value="add">

<style type="text/css" media="screen">
td{text-align:left;}
</style>
		   <!-- <?php echo show_bottons_status('task',$vo.type,$uid);?>
						<?php echo flow_bottons($vo.type);?>	 -->
<table class="table table-striped table-bordered text-left">
    <tr>
        <td width="20%"> 任务名称 </td>
        <td> <?php echo ($vo["name"]); ?> </td> 
    </tr>
   
    <tr>
        <td> 发起人 </td>
        <td> <?php echo ($vo["user_name"]); ?> </td>
    </tr>
    <tr>
        <td> 执行人 </td>
        <td> <?php echo (show_contact($vo["executor"])); ?></td>
    </tr>
    <tr>
        <td> 期望完成时间 </td>
        <td> 	<?php echo ($vo["expected_time"]); ?></td>
    </tr>
    <tr>
        <td> 任务说明 </td>
        <td> 	<?php echo ($vo["content"]); ?>	
			<br />
			<?php echo W('File',array('add_file'=>$vo['add_file'],'mode'=>'show'));?>
		</td>
    </tr>
</table>
<div class="hidden">
	
	<div class="form-group " >
		<label class="col-sm-2 control-label" for="name">任务名称：</label>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo ($vo["name"]); ?>
			</p>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label" for="name">发起人：</label>
		<div class="col-sm-10">
			<p class="form-control-static">
			<?php echo ($vo["user_name"]); ?>
			</p>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label" for="name">执行人：</label>
		<div class="col-sm-10">
			<p class="form-control-static">
			<?php echo (show_contact($vo["executor"])); ?>
			</p>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label" for="expected_time">期望完成时间：</label>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo ($vo["expected_time"]); ?>
			</p>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-2 control-label" for="content">任务说明：</label>
		<div class="col-xs-10">
			<p class="form-control-static">
				<div class="task_content">
					<?php echo ($vo["content"]); ?>	
				</div>				
			</p>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-2 control-label" for="name">附件：</label>
		<div class="col-sm-10">
			<?php echo W('File',array('add_file'=>$vo['add_file'],'mode'=>'show'));?>
		</div>
	</div>
	
	</div><!-- .hidden -->
</form>

<?php echo W('PageHeader',array('name'=>'任务执行情况','search'=>'N'));?>
<!-- 任务流程： <?php echo ($vo["user_name"]); ?>（发起人）
		<?php if(is_array($task_log)): $i = 0; $__LIST__ = $task_log;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>》 	 <?php echo ($item["executor_name"]); endforeach; endif; else: echo "" ;endif; ?> -->
		<style type="text/css" media="screen">
		.ke-insertfile{clear:right;float:left;width: 100%;}
		td{font-size:14px;}
		.tr<?php echo ($last_log_id); ?>{background-color: #fcf8e3;
    border-color: #fbeed5;}
		</style>
		<table class="table  table-bordered ">
			<?php if(is_array($task_log)): $i = 0; $__LIST__ = $task_log;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><tr class="tr<?php echo ($item["id"]); ?> " id ="<?php echo ($item["id"]); ?>">
		        <td width=20%> 第<?php echo ($item["step"]); ?>步 <strong>执行人</strong></td>
		        <td width=20%><?php echo ($item["executor_name"]); ?></td>
		        <td width=20%><strong>时间</strong></td>
		        <td width=20%><?php echo ($item["finish_time"]); ?></td>
		        <td width=20% class="deel">
					 <?php if(($item["assigner"]) == $UID): ?><div class="hidden-print">
						 	<?php echo (task_log_deel($item["id"])); ?>
						 </div><?php endif; ?> 
					 <?php if(($item["executor"]) == $UID): ?><style type="text/css" media="screen">
						 .deel .btn-success{display:none;}
						 </style>
						 <div class="hidden-print">
						 	<?php echo (task_log_deel($item["id"])); ?>
						 </div><?php endif; ?>
			</td>
		    </tr>
		    <tr  class="tr<?php echo ($item["id"]); ?>" style="border-bottom: 2px solid #333;">
		        <td> <strong>批注</strong> </td>
		        <td colspan='4' style="min-height:50px"> 
				<!-- <?php echo (task_status($item["status"])); ?>  --><?php echo ($item["feed_back"]); ?>
				
				 </td>
		    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</table>
		
<div class="ul_table border-bottom hidden">
	<ul>
		<li class="thead">
			<span class="col-15 text-center">分配给</span>
			<span class="col-9 text-center">状态</span>
			<span class="col-9 text-center">执行人</span>
						<span class="col-9 text-center">限定时间</span>
			<span class="col-15 text-center">完成时间</span>
			<!-- <span class="col-15 text-center">完成情况</span> -->
			<?php if(($item["assigner"]) == $UID): ?><span class="col-10 ">评价</span><?php endif; ?>
			<span class="auto">备注内容</span>
		
			 
		</li>
		<?php if(is_array($task_log)): $i = 0; $__LIST__ = $task_log;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><li class="tbody">
				<span class="col-15 text-center">&nbsp;<?php echo (get_user_ssk($item["assigner"])); ?> 分配给 <?php echo ($item["executor_name"]); ?></span>
				<span class="col-9 text-center">&nbsp;<?php echo (task_status($item["status"])); ?></span>
				<span class="col-9 text-center">&nbsp;<?php echo ($item["transactor_name"]); ?></span>
		<span class="col-9 text-center">&nbsp; <?php if(($item["limit_time"]) == "0000-00-00 00:00:00"): else: echo ($item["limit_time"]); endif; ?>
	</span>
				<span class="col-15 text-center">&nbsp;<?php echo ($item["finish_time"]); ?></span>
				<span class="col-15 text-center hidden">
					&nbsp;<?php if(($item["status"]) == "2"): echo (finish_rate($item["finish_rate"])); endif; ?>
					<?php if(($item["status"]) > "2"): echo ($item["finish_time"]); endif; ?></span>
						<span class="col-10"> 
					<?php if(($item["assigner"]) == $UID): echo (task_log_deel($item["id"])); endif; ?>
						</span>	
				
				<span class="auto">
					<div style="overflow:hidden">
						<?php echo ($item["feed_back"]); ?>
							
					</div> </span>
					 
			</li><?php endforeach; endif; else: echo "" ;endif; ?>
	</ul>
</div>
<?php if(($is_working) == "1"): ?><div class="widget-box task_todo">
		<div class="widget-header">
			<h5 class="smaller">反馈 <a class="pull-right text-warning" href="#<?php echo ($last_log_id); ?>">查看上一步  </a></h5>
			<div class="widget-toolbar no-border">
				<ul class="nav nav-tabs" id="myTab">
					<li class="working active">
						<a href="#working" data-toggle="tab">进行中</a>
					</li>
					<li class="finish">
						<a href="#finish" data-toggle="tab">已完成</a>
					</li>
					<li class="forword">
						<a href="#forword" data-toggle="tab">下发</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="widget-body">
			<div class="widget-main no-padding">
				<div class="tab-content">
					<div class="tab-pane active" id="working">
						<form method='post' id="form_data_working" name="form_data_working" >
							<input type="hidden" name="status" value="2">
							<input type="hidden" name="id" value="<?php echo ($task_working["id"]); ?>">
							<input type="hidden" name="finish_time" id="finish_time" value="<?php echo (date('Y-m-d h:i:s',$now)); ?>" >
							<div class="form-group col-sm-12">
								<label class="col-sm-2 control-label" >计划完成时间：</label>
								<div class="col-sm-10">
									<input class="input-date-time col-20" name="plan_time" value="<?php echo ($task_working["plan_time"]); ?>"  msg="请输入计划完成时间">
								</div>
							</div>
							<div class="form-group col-sm-12">
								<label class="col-sm-2 control-label" >完成率：</label>
								<div class="col-sm-10">
									<div class="form-control-static" >
										<input type="hidden" id="finish_rate" name="finish_rate"/>
										<div  class="slider_box" >
											<div id="slider-range-priority"></div>
											<div class="right" >
												<span id="slider_val"><?php echo ($task_working["finish_rate"]); ?></span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group panel-body">
								<label class="col-sm-2 control-label" >执行内容：</label>
								<div class="col-sm-10">
									<textarea id="feed_back" name="feed_back" class="col-xs-12 simple" style="height:120px"><?php echo ($task_working["feed_back"]); ?></textarea>
								</div>
								<label class="col-sm-2 control-label" >上传附件：</label>
								<div class="col-sm-10">
									<a href="#" class="btn btn-default btn-sm btn-success " id="upload0">点击上传</a>
								</div>
							</div>

						</form>
					</div>

					<div class="tab-pane" id="finish">
						<form method='post' id="form_data_finish" name="form_data_finish" >
							<input type="hidden" name="status" value="3">
							<input type="hidden" name="id" value="<?php echo ($task_working["id"]); ?>">

							<input type="hidden" name="finish_time" id="finish_time" value="<?php echo (date('Y-m-d h:i:s',$now)); ?>" >
							<!-- <div class="form-group col-sm-12">
								<label class="col-sm-2 control-label" >完成时间：</label>
								<div class="col-sm-10">
								</div>
							</div> -->
							<div class="form-group panel-body">
								<label class="col-sm-2 control-label" >说明：</label>
								<div class="col-sm-10">
									<textarea id="feed_back" name="feed_back" class="col-xs-12 simple" style="height:120px" ><?php echo ($task_working["feed_back"]); ?></textarea>
								</div>

								<label class="col-sm-2 control-label" >上传附件：</label>
								<div class="col-sm-10">
									<a href="#" class="btn btn-default btn-sm btn-success " id="upload1">点击上传</a>
								</div>
								
							</div>
						</form>
					</div>

					<div class="tab-pane" id="forword">
						<form method='post' id="form_data_forword" name="form_data_forword" >
							<input type="hidden" name="id" value="<?php echo ($task_working["id"]); ?>">
							<input type="hidden" name="task_id" value="<?php echo ($task_working["task_id"]); ?>">
							<input type="hidden" name="status" value="4">
							<input type="hidden" id="forword_executor" name="forword_executor" >
							<input type="hidden" id="step" name="step" value="<?php echo ($task_working["step"]); ?>">
							<input type="hidden" id="task_type" name="task_type" value="<?php echo ($task_working["task_type"]); ?>">
							<input type="hidden" name="finish_time" id="finish_time" value="<?php echo (date('Y-m-d h:i:s',$now)); ?>" >
							<div class="form-group col-sm-12 forwordto">
								<label class="col-sm-2 control-label" for="name"><?php echo (($forwordto)?($forwordto):'传给'); ?>：</label>
								<div class="col-sm-10">
									<div id="actor_wrap" class="inputbox">
										<a class="pull-right btn btn-link text-center" onclick="popup_actor();"><i class="fa fa-user"></i> </a>
										<div class="wrap" >
											<span class="address_list">
												<?php if(is_array($user)): $i = 0; $__LIST__ = $user;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><span data="<?php echo ($vo["id"]); ?>" id="<?php echo ($vo["id"]); ?>"><nobr><b title="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></b><a class="del" title="删除"><i class="fa fa-times"></i></a></nobr></span><?php endforeach; endif; else: echo "" ;endif; ?>
											</span>
											<span class="text" >
												<input class="letter" type="text"  >
											</span>
										</div>
										<div class="search dropdown ">
											<ul class="dropdown-menu"></ul>
										</div>
									</div>
								</div>
							</div>
                             	<div class="form-group col-sm-12 limit_time">
								<label class="col-sm-2 control-label" >限定时间：</label>
								<div class="col-sm-10">
									<input class="input-date-time col-20" name="limit_time" id="limit_time" value="<?php echo ($task_working["plan_time"]); ?>"  msg="请输入实际完成时间">
								</div>
							</div>

							<div class="form-group panel-body">
								<label class="col-sm-2 control-label" ><?php echo (($zxnr)?($zxnr):'执行内容'); ?>：</label>
								<div class="col-sm-10">
								<textarea id="feed_back" name="feed_back" class="col-xs-12 simple" style="height:120px" ><?php echo ($task_working["feed_back"]); ?></textarea>
								</div>
							
								<label class="col-sm-2 control-label" >上传附件：</label>
								<div class="col-sm-10">
									<a href="#" class="btn btn-default btn-sm btn-success " id="upload2">点击上传</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="widget-toolbox padding-8 clearfix">
				<div class="text-center">
					<a onclick="save_log();" class="btn btn-md btn-success"><?php echo (($tj)?($tj):'提交'); ?></a>
					<!-- <a onclick="go_return_url();" class="btn btn-sm btn-default">取消</a> -->
				</div>
			</div>
		</div>
	</div><?php endif; ?>
<?php echo ($style); ?>

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
<script type="text/javascript">
	$(function() {
		show_content();
	});
	function del() {
		ui_confirm('确定要删除吗?', function() {
			sendAjax("<?php echo U('mark','action=del');?>", 'id=' + $("#id").val(), function(data) {
				if (data.status) {
					ui_alert(data.info, function() {
						go_return_url();
					});
				}
			});
		});
	}

	function popup_actor() {
		winopen("<?php echo U('popup/task');?>", 730, 574);
	}

	function edit() {
		window.open(fix_url("<?php echo U('edit');?>?id=" + $("#id").val()), "_self");
	}

	function accept($task_log_id) {
		sendAjax("<?php echo U('accept');?>",'task_log_id='+$task_log_id, function(data) {
			if (data.status) {
				ui_alert(data.info, function() {
					location.reload(true);
				});
			}
		});
	}
	
	function let_me_do($task_id) {
		sendAjax("<?php echo U('let_me_do');?>",'task_id='+$task_id,function(data) {
			if (data.status) {
				ui_alert(data.info, function() {
					location.reload(true);
				});
			}
		});
	}	
	

	function reject() {
		winopen("<?php echo U('reject','task_id='.$vo['id']);?>", 730, 540);
	}

	function save_log() {
		<?php if(empty($status_name)): ?>var status_name = $(".task_todo .tab-pane.active").attr('id');
		<?php else: ?> 
			var status_name = "<?php echo ($status_name); ?>";<?php endif; ?> 
		
		if (status_name == "forword") {
			if ($(".address_list span").length == 0) {
				ui_error('请选择要下发的人');
				return false;
			} else {
				$("#forword_executor").val("");
				$("#actor_wrap span.address_list span").each(function() {
					$("#forword_executor").val($("#forword_executor").val() + $(this).find("b").text() + '|' + $(this).attr("data") + ";");
				});
			}
		}
		var form_name = "form_data_" + status_name;
		var vars = $("#" + form_name).serialize();
		if (check_form(form_name)) {
			if (status_name == "working") {
				sendForm("form_data_working", "<?php echo U('save_log');?>", "__SELF__");
				// sendAjax("<?php echo U('save_log');?>", vars, function(data) {
// 					if (data.status) {
// 						ui_alert(data.info, function() {
// 							location.reload(true);
// 						});
// 					} else {
// 						ui_error(data.info);
// 					}
// 				});
			}

			if (status_name == "finish") {
				ui_confirm('选择完成以后不能修改了,是否继续修改了?', function() {
					//sendForm(,"<?php echo U('save_log');?>",);
					sendForm("form_data_finish", "<?php echo U('save_log');?>", "__SELF__");
					// sendAjax("<?php echo U('save_log');?>", vars, function(data) {
// 						if (data.status) {
// 							ui_alert(data.info, function() {
// 								location.reload(true);
// 							});
// 						} else {
// 							ui_error(data.info);
// 						}
// 					});
				});
			}

			if (status_name == "forword") {
				ui_confirm('选择转发以后不能修改了,是否继续修改了?', function() {

					sendForm("form_data_forword", "<?php echo U('save_log');?>", "__SELF__");
					// sendAjax("<?php echo U('save_log');?>", vars, function(data) {
// 						if (data.status) {
// 							ui_alert(data.info, function() {
// 								location.reload(true);
// 							});
// 						} else {
// 							ui_error(data.info);
// 						}
// 					});
				});
			}
		}
	}


	$(document).ready(function() {
		$(document).on("click", ".inputbox .address_list a.del", function() {
			$(this).parent().parent().remove();
		});

		set_val('status', '<?php echo ($task_working["finish_rate"]); ?>');
		$("#slider-range-priority").slider({
			range : "min",
			min : 0,
			max : 100,
			value : '<?php echo ($task_working["finish_rate"]); ?>',
			slide : function(event, ui) {
				$("#finish_rate").val(ui.value);
				$("#slider_val").text(ui.value + "%");
			}
		});
		$('#upload0').click(function(event) {
			$('.ke-icon-insertfile:eq(0)').trigger("click");
		});
		$('#upload1').click(function(event) {
			$('.ke-icon-insertfile:eq(1)').trigger("click");
		});
		$('#upload2').click(function(event) {
			$('.ke-icon-insertfile:eq(2)').trigger("click");
		});
		
		
		
		
	}); 
</script>
<!-- inline scripts related to this page -->
</body>
</html>