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
									
<link rel="stylesheet" href="__PUBLIC__/css/handle.css">


<div id="west" class="input-operation in smallsidebar hidden-print" style="width:50px;float:left;height:100%;margin-top: 0;">
  <div id="workflow-switcher" class="communication-block">
    <ul class="nav nav-tabs">
      <li class=" active form_in" title="表单"><a href="#bd" hidefocus="true"> <i class="form"></i> 表单</a></li>
      <li class="attach_in" title="附件"><a href="#pickfiles" hidefocus="true"> <i class="attach"></i>附件</a></li>
      <li class="remark_in" title="会签"><a href="#flow_status" hidefocus="true"> <i class="remark"></i>会签</a></li>
      <li class="remark_in" title="打印"><a  onclick="winprint();" hidefocus="true"> <i class="remark"></i>打印</a></li>
    </ul>
  </div>
  <!-- <div class="operation-block communication-op-block">
    <div class="op-block-container" title="分享"> <i class="com"></i>
      <div class="op-block-title">分享</div>
    </div>
  </div>
  <div class="operation-block fav-block">
    <div class="op-block-container" id="to_print" title="打印"> <i class="print-icon"></i>
      <div class="op-block-title">打印</div>
    </div>
  </div>
  <div class="operation-block operation-op-block">
    <div class="op-block-container" title="更多"> <i class="do-more"></i>
      <div class="op-block-title">更多</div>
    </div>
  </div> -->
</div>


<style type="text/css" media="screen">
#west {
    border-right: 3px solid #169bf5;
    z-index: 10;
    color: rgba(83, 83, 83);
    background: url(__PUBLIC__/v2/imges/left_bg.png) repeat-y;
    margin-top: 20%;
}
.page-header,.ul_table,#form_confirm{  max-width: 1024px;
  margin: auto;}

#sidebar,#breadcrumbs{display:none;}
.main-content {margin-left: 0;}
</style>
<div style="  width: 1024px;
  margin: auto;">
  <h3 class="text-center"><?php echo $vo['name'];?>

	
  </h3> 
  
<div class="operate panel panel-default hidden-print "  name="bd" id="bd">
	<div class="panel-body">
		<div class="pull-left">
			

			<a onclick="window.history.back()" class="btn btn-sm btn-primary pull-left hidden-print">返回</a>
			<!-- <a href="#flow_status"  class="btn btn-sm btn-primary">审批情况</a>
			<?php if(!empty($to_confirm)): ?><a href="#confirm"  class="btn btn-sm btn-primary">会签意见</a><?php endif; ?> -->
		</div>
		<div class="pull-right">
			<?php if(($UID) == $vo["user_id"]): ?><a href="__APP__/flow/del/id/<?php echo ($vo["id"]); ?>" class="btn btn-danger btn-sm">删除</a><?php endif; ?>
			<!-- <a onclick="winprint();" class="btn btn-sm btn-primary">打印</a> -->
			<?php if(($is_edit) == "1"): ?><a onclick="save();" class="btn btn-sm btn-primary">保存</a><?php endif; ?>
		</div>
	</div>
</div>
<form method='post' id="form_data" name="form_data" enctype="multipart/form-data"  class="well form-horizontal">
	<input type="hidden" id="ajax" name="ajax" value="0">
	<input type="hidden" id="opmode" name="opmode" value="edit">
	<input type="hidden" id="name" name="name" value="<?php echo ($vo["name"]); ?>">
	<input type="hidden" id="add_file" name="add_file" value="<?php echo ($vo["add_file"]); ?>" >
	<input type="hidden" id="id" name="id" value="<?php echo ($vo["id"]); ?>">
	<div class="form-group col-sm-6 hidden">
		<label class="col-sm-4 control-label" >文件编号：</label>
		<div class="col-sm-8">
			<p class="form-control-static">
				<?php echo ($vo["doc_no"]); ?>
			</p>
		</div>
	</div>

	<div class="form-group col-sm-6">
		<label class="col-sm-4 control-label" >日期：</label>
		<div class="col-sm-8">
			<p class="form-control-static">
				<?php echo (todate($vo["create_time"],'Y-m-d')); ?>
			</p>
		</div>
	</div>

	<div class="form-group  col-sm-6">
		<label class="col-sm-4 control-label" >填写：</label>
		<div class="col-sm-8">
			<p class="form-control-static">
				<?php echo ($vo["user_name"]); ?>
			</p>
		</div>
	</div>

	<div class="form-group  col-sm-6">
		<label class="col-sm-4 control-label" >部门：</label>
		<div class="col-sm-8">
			<p class="form-control-static">
				<?php echo ($vo["dept_name"]); ?>
			</p>
		</div>
	</div>

	<div class="form-group  col-xs-6">
		<label class="col-sm-2 control-label" >审批：</label>
		<div class="col-sm-10">
			<p id="confirm_wrap" class="form-control-static">
				<?php echo ($vo["confirm_name"]); ?>
			</p>
		</div>
	</div>
<style type="text/css" media="screen">
table{    border-spacing: 0;width: 100%!important;}
h1{text-align:center;}
</style>
	<div class="form-group col-xs-12 hidden">
		<label class="col-sm-2 control-label" >协商：</label>
		<div class="col-sm-10">
			<p id="consult_wrap" class="form-control-static address_list">
				<?php echo ($vo["consult_name"]); ?>
			</p>
		</div>
	</div>
	<div class="form-group col-xs-12 hidden">
		<label class="col-sm-2 control-label" >抄送：</label>
		<div class="col-sm-10">
			<p id="refer_wrap" class="form-control-static address_list">
				<?php echo ($vo["refer_name"]); ?>
			</p>
		</div>
	</div>
	<?php if(is_array($field_list)): $i = 0; $__LIST__ = $field_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$field_vo): $mod = ($i % 2 );++$i; echo W('FlowField',$field_vo); endforeach; endif; else: echo "" ;endif; ?>
	
	<?php if(($is_edit) != "2"): ?><div class="form-group">
			<div class="col-xs-12">
				<?php echo ($vo["content"]); ?>
				 <?php if(($is_edit) == "0"): ?><!--	<div class="content_wrap">
						<iframe class="content_iframe"></iframe>
						<textarea class="content display-none"  name="content" style="width:100%;height:300px;" ><?php echo ($vo["content"]); ?></textarea>
					</div> --><?php endif; ?>
				<?php if(($is_edit) == "1"): ?><!--	<textarea class="editor content display-none"  name="content" style="width:100%;height:300px;" ><?php echo ($vo["content"]); ?></textarea> -->
				<eq>
			</div>
		</div><?php endif; ?>
	<?php if(!empty($vo["add_file"])): ?><div class="form-group">
			<label class="col-sm-2 control-label" >附件：</label>
			<div class="col-sm-10">
				<eq name="is_edit" value="0">
					<?php echo W('File',array('add_file'=>$vo['add_file'],'mode'=>'show')); endif; ?>
				<?php if(($is_edit) == "1"): echo W('File',array('add_file'=>$vo['add_file'],'mode'=>'edit')); endif; ?>
			</div>
		</div><?php endif; ?>
	<div class="clearfix"></div>
</form>

<a id="flow_status"></a>
<?php echo W('PageHeader',array('name'=>'会签意见','search'=>'N'));?>

		<table class="table table-striped table-bordered ">
			<?php if(is_array($flow_log)): $i = 0; $__LIST__ = $flow_log;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><tr>
		        <td> <strong>批注</strong> </td>
		        <td colspan='4' style="min-height:50px"> 
				<?php echo (show_result($item["result"])); ?> <?php echo ($item["comment"]); ?>
				
				 </td>
		    </tr>
		    <tr>
		        <td width=20%><strong>审批人</strong></td>
		        <td width=20%><?php echo ($item["user_name"]); ?></td>
		        <td width=20%><strong>时间</strong></td>
		        <td width=20%><?php echo (todate($item["create_time"],'Y-m-d h:i')); ?></td>
		        <td width=20%>
					 <?php if(($item["assigner"]) == $UID): ?><div class="hidden-print">
						 	<?php echo (task_log_deel($item["id"])); ?>
						 </div><?php endif; ?> 
			</td>
		    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</table>
		
<div class="ul_table border-bottom hidden">
	<ul>
		<li class="thead">
			<span class="col-9 text-center">类型</span>
			<span class="col-9 text-center">审批人</span>
			<span class="col-9 text-center">日期</span>
			<span class="col-9 text-center">结果</span>
			<span class="auto">意见</span>
		</li>
		<?php if(is_array($flow_log)): $i = 0; $__LIST__ = $flow_log;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><li class="tbody">
				<span style="width:90px;" class="text-center"><?php echo (show_step_type($item["step"])); ?></span>
				<span style="width:90px;" class="text-center"><?php echo ($item["user_name"]); ?></span>
				<span style="width:90px;" class="text-center"><?php echo (todate($item["create_time"],'Y-m-d')); ?></span>
				<span style="width:90px;" class="text-center"><?php echo (show_result($item["result"])); ?></span>
				<span class="auto">
					<div style="overflow:hidden">
						<?php echo ($item["comment"]); ?>
					</div> </span>
			</li><?php endforeach; endif; else: echo "" ;endif; ?>
	</ul>
</div>
<?php if(!empty($to_confirm)): ?><a id="confirm"></a>
	<?php echo W('PageHeader',array('name'=>'会签意见','search'=>'N'));?>
	<form method="post" action="" name="form_confirm" id="form_confirm">
		<input type="hidden" name="id" value="<?php echo ($to_confirm["id"]); ?>">
		<input type="hidden" name="flow_id" value="<?php echo ($vo["id"]); ?>">
		<input type="hidden" name="step" value="<?php echo ($to_confirm["step"]); ?>">
		<div class="operate panel panel-default ">
			<div class="panel-heading clearfix">
				<div class="pull-left">
					<a onclick="go_return_url();" class="btn btn-sm btn-primary">返回</a>
				</div>
				<div class="pull-right">
					<?php if(!empty($is_edit)): ?><div class="btn-group">
							<a class="btn btn-sm btn-warning dropdown-toggle" data-toggle="dropdown" href="#">退回到<span class="fa fa-caret-down"></span> </a>
							<ul class="dropdown-menu col-5">
								<?php if(is_array($confirmed)): $i = 0; $__LIST__ = $confirmed;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li onclick="back_to('<?php echo ($vo["emp_no"]); ?>');">
										<a><?php echo ($vo["user_name"]); ?></a>
									</li><?php endforeach; endif; else: echo "" ;endif; ?>
								<li onclick="back_to('<?php echo ($emp_no); ?>');">
									<a><?php echo ($user_name); ?></a>
								</li>
							</ul>
						</div><?php endif; ?>
					<a onclick="reject();" class="btn btn-sm btn-danger">否决</a>
					|
					<a onclick="approve();" class="btn btn-sm btn-primary">同意</a>
				</div>
			</div>
			<div class="form-group panel-body">
				<label class="col-sm-2 control-label" >会签意见：</label>
				<div class="col-sm-10">
					<textarea name="comment" class="col-xs-12" style="height:120px"></textarea>
				</div>
			</div>
		</div>
	</form><?php endif; ?>

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
<script type="text/javascript">
	function approve() {
		sendForm("form_confirm", "<?php echo U('mark','action=approve');?>", "<?php echo U('read','id='.$vo['id']);?>");
	}

	function reject() {
		sendForm("form_confirm", "<?php echo U('mark','action=reject');?>", "<?php echo U('read','id='.$vo['id']);?>");
	}

	function back_to(emp_no) {
		sendForm("form_confirm", fix_url("<?php echo U('mark','action=back');?>?emp_no=" + emp_no), "<?php echo U('read','id='.$vo['id']);?>");
	}

	function save() {
		window.onbeforeunload = null;
		sendForm("form_data", "<?php echo U('save');?>");
	}

	function select_confirm() {
		winopen("<?php echo U('popup/confirm');?>", 730, 750);
	};

	$(document).ready(function(){
		set_return_url(document.location,1);
		$("#confirm span").on("dblclick", function() {
			$("#confirm span").last().find("b").remove();
		});
		$("#consult span").on("dblclick", function() {
			$("#consult span").last().find("b").remove();
		});
		show_content();		
	}); 
</script>
<!-- inline scripts related to this page -->
</body>
</html>