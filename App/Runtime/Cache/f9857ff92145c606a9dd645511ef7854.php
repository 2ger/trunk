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
									
<?php echo W('PageHeader',array('name'=>$folder_name,'search'=>'M'));?>
<form method="post" name="form_adv_search" id="form_adv_search">
	<div class="adv_search panel panel-default  display-none"  id="adv_search">
		<div class="panel-heading">
			<div class="row">
				<h4 class="col-xs-6">高级搜索</h4>
				<div class="col-xs-6 text-right">
					<a  class="btn btn-sm btn-info" onclick="submit_adv_search();">搜索</a>
					<a  class="btn btn-sm " onclick="close_adv_search();">关闭</a>
				</div>
			</div>
		</div>
		<div class="panel-body">
			<div class="form-group col-sm-6">
				<label class="col-sm-4 control-label" for="li_name">标题：</label>
				<div class="col-sm-8">
					<input  class="form-control" type="text" id="li_name" name="li_name" >
				</div>
			</div>

			<div class="form-group col-sm-6">
				<label class="col-sm-4 control-label" for="li_content">内容：</label>
				<div class="col-sm-8">
					<input  class="form-control" type="text" id="li_content" name="li_content" >
				</div>
			</div>

			<div class="form-group col-sm-6">
				<label class="col-sm-4 control-label" for="eq_user_name">登录人：</label>
				<div class="col-sm-8">
					<input  class="form-control" type="text" id="eq_user_name" name="eq_user_name" >
				</div>
			</div>

			<div class="form-group col-sm-6">
				<label class="col-sm-4 control-label" for="be_create_time">登录时间：</label>
				<div class="col-sm-8">
					<div class="input-daterange input-group" >
					    <input type="text" class="input-sm form-control text-center" name="be_create_time" />
						<span class="input-group-addon">-</span>
						<input type="text" class="input-sm form-control text-center" name="en_create_time" />
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
<?php if($auth['write']): ?><div class="operate panel panel-default <?php echo ($hidden); ?>">
		<div class="panel-body">
			<div class="pull-left">
				<?php if($auth['admin']): ?><a class="btn btn-sm btn-danger" onclick="mark('del');">删除</a>
					<div class="btn-group" id="move_to">
						<a class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" href="#" > 转移到 <span class="fa fa-caret-down"></span> </a>
						<ul class="dropdown-menu">
							<?php echo ($folder_list); ?>
						</ul>
					</div><?php endif; ?>
			</div>
			<div class="pull-right">
				<a class="btn btn-sm btn-primary" onclick="add()">新建</a>
			</div>
		</div>
	</div><?php endif; ?>
<div class="ul_table">
	<ul>
		<li class="thead">
			<div class="pull-left">
				<label class="inline pull-left col-3">
					<input class="ace" type="checkbox" name="id-toggle-all" id="id-toggle-all" />
					<span class="lbl"></span></label>
				<span class="col-10"> 编号 </span>
			</div>
			<div class="pull-right">
				<span class="col-10  "> 发布时间 </span>
				<span class="col-6  "> 发布人 </span>	
				<span class="col-6 "> 操作 </span>				
			</div>
			<div class="auto">
				标题
			</div>
		</li>
		<?php if(empty($list)): ?><ul>
				<li class="no-data">
					没找到数据
				</li>
				<?php else: ?>
				<form method="post" action="" name="form_data" id="form_data">
					<?php if(is_array($list)): foreach($list as $key=>$vo): ?><li class="tbody  <?php if((!in_array($vo['id'],$readed_id))&&($vo['create_time']>=time()-3600*30*24)) echo("bold") ?>" >
							<div class="pull-left">
								<label class="inline pull-left col-3">
									<input class="ace" type="checkbox" name="id[]" value="<?php echo ($vo["id"]); ?>" />
									<span class="lbl"></span></label>
								<span class="col-10"> <?php echo ($vo["notice_no"]); ?> </span>
							</div>
							<div class="pull-right">
								<span class="col-10 "> <?php echo (todate($vo["create_time"],'Y-m-d')); ?> </span>
								<span class="col-6 "> <?php echo ($vo["user_name"]); ?> </span>
								<span class="col-6 <?php echo ($hidden); ?>"> <a href="<?php echo U('edit','id='.$vo['id']);?>" class="btn btn-info btn-xs"><i class="fa fa-pencle"></i> 编辑</a>
								 </span>		
							</div>
							<div class="auto">
								<a href="<?php echo U('read','id='.$vo['id']);?>" ><?php echo ($vo["name"]); ?>
								<?php if((strlen($vo["name"])) == "0"): ?>无标题<?php endif; ?></a>
							</div>
						</li><?php endforeach; endif; ?>
				</form>
				<div class="pagination">
					<?php echo ($page); ?>
				</div><?php endif; ?>
	</ul>
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
	function mark(action) {
		var vars = $("#form_data").serialize();
		switch(action){
			case "del":
				ui_confirm('确定要删除吗?',function(){
					sendAjax("<?php echo U('mark','action=del');?>", vars, function(data) {
						if (data.status) {
							ui_alert(data.info,function(){
								$("input[name='id[]']:checkbox:checked").each(function() {
									$(this).parents("li").remove();
								});
							});				
						}
					});
				});
				break;
			default:
		}
	}

	function add() {
		window.open("<?php echo U('add','fid='.$folder_id);?>", "_self");
	}

	function move_to(val) {
		var vars = $("#form_data").serialize();
		sendAjax("<?php echo U('mark','action=move_folder');?>", 'val=' + val + '&' + vars);
		$("input[name='id[]']:checkbox:checked").each(function() {
			$(this).parent().parent().hide();
		});
	}


	$(document).ready(function() {
		set_return_url();
		$("#move_to li").click(function() {
			move_to($(this).attr("id"));
		});
	}); 
</script>
<!-- inline scripts related to this page -->
</body>
</html>