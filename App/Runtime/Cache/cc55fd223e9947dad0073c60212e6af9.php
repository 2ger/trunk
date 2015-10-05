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
.Schedule .event_list .event_time {
    width: 150px;
}
</style>
<div id="cal" class="day">
	<div id="top" class="operate panel panel-default">
		<div class="panel-body">
			<div class="pull-left">
				<a id="panel" class="btn btn-sm btn-primary"> </a>
				<a onclick="pushBtm('MU');" class="btn btn-sm btn-primary"><i class="fa fa-chevron-left"></i></a>
				<a onclick="pushBtm('MD');" class="btn btn-sm btn-primary"><i class="fa fa-chevron-right"></i></a>
				<a onclick="pushBtm('');" class="btn btn-sm btn-primary"> 今天 </a>
				<input type="text" name="start_date" id="start_date" style="display:none">
				<input type="text" name="end_date" id="end_date" style="display:none">
			</div>
			<div class="pull-right">
				<a onclick="month_view();" class="btn btn-sm btn-primary"> 自己 </a>
				<a onclick="day_view();" class="btn btn-sm btn-primary"> 全部 </a>
				<!-- <a onclick="add();" class="btn btn-sm btn-primary"> 新建 </a> -->
			</div>
		</div>
	</div>
	<form method="post" action="" name="CLD">
		<div style="display:none">
			<font> 公历
				<select id="year" onchange=changeCld() name=SY>
					<script language=JavaScript>
						for ( i = 1900; i < 2050; i++)
							document.write('<option>' + i)
					</script>
				</select> 年
				<select id="month" onchange=changeCld() name=SM>
					<script language=JavaScript>
						for ( i = 1; i < 13; i++)
							document.write('<option>' + i)
					</script>
				</select> 月 </font>
			<font id="GZ"> </font>
		</div>
		<div class="row">
			<div class="col-sm-4" style="height:260px;">
				<div class="mv-container" style="height:250px;min-height:250px;">
					<table class="mv-daynames-table" cellspacing="0" cellpadding="0">
						<tbody>
							<tr>
								<th title="周日" class="mv-dayname"> 周日 </th>
								<th title="周一" class="mv-dayname"> 周一 </th>
								<th title="周二" class="mv-dayname"> 周二 </th>
								<th title="周三" class="mv-dayname"> 周三 </th>
								<th title="周四" class="mv-dayname"> 周四 </th>
								<th title="周五" class="mv-dayname"> 周五 </th>
								<th title="周六" class="mv-dayname"> 周六 </th>
							</tr>
						</tbody>
					</table>
					<div class="mv-event-container" id="mvEventContainer" style="height:225px;">
						<div class="month-row" style="top:0%; height:36px;">
							<table class="st-bg-table" cellspacing="0" cellpadding="0">
								<tbody>
									<tr>
										<td class="st-bg "> &nbsp; </td>
										<td class="st-bg"> &nbsp; </td>
										<td class="st-bg"> &nbsp; </td>
										<td class="st-bg"> &nbsp; </td>
										<td class="st-bg"> &nbsp; </td>
										<td class="st-bg"> &nbsp; </td>
										<td class="st-bg"> &nbsp; </td>
									</tr>
								</tbody>
							</table>
							<table class="st-grid" cellspacing="0" cellpadding="0">
								<tbody>
									<tr>
										<td class="st-dtitle"><span class="left" id="SD0"> </span><span class="right" id="LD0"> </span></td>
										<td class="st-dtitle  "><span class="left" id="SD1"> </span><span class="right" id="LD1"> </span></td>
										<td class="st-dtitle  "><span class="left" id="SD2"> </span><span class="right" id="LD2"> </span></td>
										<td class="st-dtitle  "><span class="left" id="SD3"> </span><span class="right" id="LD3"> </span></td>
										<td class="st-dtitle "><span class="left" id="SD4"> </span><span class="right" id="LD4"> </span></td>
										<td class="st-dtitle "><span class="left" id="SD5"> </span><span class="right" id="LD5"> </span></td>
										<td class="st-dtitle "><span class="left" id="SD6"> </span><span class="right" id="LD6"> </span></td>
									</tr>
									<tr>
										<td class="st-c "><ul id="UL0"></ul></td>
										<td class="st-c "><ul id="UL1"></ul></td>
										<td class="st-c "><ul id="UL2"></ul></td>
										<td class="st-c "><ul id="UL3"></ul></td>
										<td class="st-c "><ul id="UL4"></ul></td>
										<td class="st-c "><ul id="UL5"></ul></td>
										<td class="st-c "><ul id="UL6"></ul></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="month-row" style="top:37px;height:36px;">
							<table class="st-bg-table" cellspacing="0" cellpadding="0">
								<tbody>
									<tr>
										<td class="st-bg "> &nbsp; </td>
										<td class="st-bg"> &nbsp; </td>
										<td class="st-bg"> &nbsp; </td>
										<td class="st-bg"> &nbsp; </td>
										<td class="st-bg"> &nbsp; </td>
										<td class="st-bg"> &nbsp; </td>
										<td class="st-bg"> &nbsp; </td>
									</tr>
								</tbody>
							</table>
							<table class="st-grid" cellspacing="0" cellpadding="0">
								<tbody>
									<tr>
										<td class="st-dtitle "><span class="left" id="SD7"> </span><span class="right" id="LD7"> </span></td>
										<td class="st-dtitle"><span class="left" id="SD8"> </span><span class="right" id="LD8"> </span></td>
										<td class="st-dtitle"><span class="left" id="SD9"> </span><span class="right" id="LD9"> </span></td>
										<td class="st-dtitle"><span class="left" id="SD10"> </span><span class="right" id="LD10"> </span></td>
										<td class="st-dtitle"><span class="left" id="SD11"> </span><span class="right" id="LD11"> </span></td>
										<td class="st-dtitle"><span class="left" id="SD12"> </span><span class="right" id="LD12"> </span></td>
										<td class="st-dtitle"><span class="left" id="SD13"> </span><span class="right" id="LD13"> </span></td>
									</tr>
									<tr>
										<td class="st-c "><ul id="UL7"></ul></td>
										<td class="st-c "><ul id="UL8"></ul></td>
										<td class="st-c "><ul id="UL9"></ul></td>
										<td class="st-c "><ul id="UL10"></ul></td>
										<td class="st-c "><ul id="UL11"></ul></td>
										<td class="st-c "><ul id="UL12"></ul></td>
										<td class="st-c "><ul id="UL13"></ul></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="month-row" style="top:74px; height:36px;">
							<table class="st-bg-table" cellspacing="0" cellpadding="0">
								<tbody>
									<tr>
										<td class="st-bg "> &nbsp; </td>
										<td class="st-bg"> &nbsp; </td>
										<td class="st-bg"> &nbsp; </td>
										<td class="st-bg"> &nbsp; </td>
										<td class="st-bg"> &nbsp; </td>
										<td class="st-bg"> &nbsp; </td>
										<td class="st-bg"> &nbsp; </td>
									</tr>
								</tbody>
							</table>
							<table class="st-grid" cellspacing="0" cellpadding="0">
								<tbody>
									<tr>
										<td class="st-dtitle "><span class="left" id="SD14"> </span><span class="right" id="LD14"> </span></td>
										<td class="st-dtitle"><span class="left" id="SD15"> </span><span class="right" id="LD15"> </span></td>
										<td class="st-dtitle"><span class="left" id="SD16"> </span><span class="right" id="LD16"> </span></td>
										<td class="st-dtitle"><span class="left" id="SD17"> </span><span class="right" id="LD17"> </span></td>
										<td class="st-dtitle"><span class="left" id="SD18"> </span><span class="right" id="LD18"> </span></td>
										<td class="st-dtitle"><span class="left" id="SD19"> </span><span class="right" id="LD19"> </span></td>
										<td class="st-dtitle"><span class="left" id="SD20"> </span><span class="right" id="LD20"> </span></td>
									</tr>
									<tr>
										<td class="st-c "><ul id="UL14"></ul></td>
										<td class="st-c "><ul id="UL15"></ul></td>
										<td class="st-c "><ul id="UL16"></ul></td>
										<td class="st-c "><ul id="UL17"></ul></td>
										<td class="st-c "><ul id="UL18"></ul></td>
										<td class="st-c "><ul id="UL19"></ul></td>
										<td class="st-c "><ul id="UL20"></ul></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="month-row" style="top:111px; height:36px;">
							<table class="st-bg-table" cellspacing="0" cellpadding="0">
								<tbody>
									<tr>
										<td class="st-bg "> &nbsp; </td>
										<td class="st-bg"> &nbsp; </td>
										<td class="st-bg"> &nbsp; </td>
										<td class="st-bg"> &nbsp; </td>
										<td class="st-bg"> &nbsp; </td>
										<td class="st-bg"> &nbsp; </td>
										<td class="st-bg"> &nbsp; </td>
									</tr>
								</tbody>
							</table>
							<table class="st-grid" cellspacing="0" cellpadding="0">
								<tbody>
									<tr>
										<td class="st-dtitle "><span class="left" id="SD21"> </span><span class="right" id="LD21"> </span></td>
										<td class="st-dtitle"><span class="left" id="SD22"> </span><span class="right" id="LD22"> </span></td>
										<td class="st-dtitle"><span class="left" id="SD23"> </span><span class="right" id="LD23"> </span></td>
										<td class="st-dtitle"><span class="left" id="SD24"> </span><span class="right" id="LD24"> </span></td>
										<td class="st-dtitle"><span class="left" id="SD25"> </span><span class="right" id="LD25"> </span></td>
										<td class="st-dtitle"><span class="left" id="SD26"> </span><span class="right" id="LD26"> </span></td>
										<td class="st-dtitle"><span class="left" id="SD27"> </span><span class="right" id="LD27"> </span></td>
									</tr>
									<tr>
										<td class="st-c "><ul id="UL21"></ul></td>
										<td class="st-c "><ul id="UL22"></ul></td>
										<td class="st-c "><ul id="UL23"></ul></td>
										<td class="st-c "><ul id="UL24"></ul></td>
										<td class="st-c "><ul id="UL25"></ul></td>
										<td class="st-c "><ul id="UL26"></ul></td>
										<td class="st-c "><ul id="UL27"></ul></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="month-row" style="top:148px;height:36px;">
							<table class="st-bg-table" cellspacing="0" cellpadding="0">
								<tbody>
									<tr>
										<td class="st-bg "> &nbsp; </td>
										<td class="st-bg"> &nbsp; </td>
										<td class="st-bg"> &nbsp; </td>
										<td class="st-bg"> &nbsp; </td>
										<td class="st-bg"> &nbsp; </td>
										<td class="st-bg"> &nbsp; </td>
										<td class="st-bg"> &nbsp; </td>
									</tr>
								</tbody>
							</table>
							<table class="st-grid" cellspacing="0" cellpadding="0">
								<tbody>
									<tr>
										<td class="st-dtitle "><span class="left" id="SD28"> </span><span class="right" id="LD28"> </span></td>
										<td class="st-dtitle"><span class="left" id="SD29"> </span><span class="right" id="LD29"> </span></td>
										<td class="st-dtitle"><span class="left" id="SD30"> </span><span class="right" id="LD30"> </span></td>
										<td class="st-dtitle"><span class="left" id="SD31"> </span><span class="right" id="LD31"> </span></td>
										<td class="st-dtitle"><span class="left" id="SD32"> </span><span class="right" id="LD32"> </span></td>
										<td class="st-dtitle"><span class="left" id="SD33"> </span><span class="right" id="LD33"> </span></td>
										<td class="st-dtitle"><span class="left" id="SD34"> </span><span class="right" id="LD34"> </span></td>
									</tr>
									<tr>
										<td class="st-c "><ul id="UL28"></ul></td>
										<td class="st-c "><ul id="UL29"></ul></td>
										<td class="st-c "><ul id="UL30"></ul></td>
										<td class="st-c "><ul id="UL31"></ul></td>
										<td class="st-c "><ul id="UL32"></ul></td>
										<td class="st-c "><ul id="UL33"></ul></td>
										<td class="st-c "><ul id="UL34"></ul></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="month-row" style="top:185px;bottom:0;">
							<table class="st-bg-table" cellspacing="0" cellpadding="0">
								<tbody>
									<tr>
										<td class="st-bg "> &nbsp; </td>
										<td class="st-bg"> &nbsp; </td>
										<td class="st-bg"> &nbsp; </td>
										<td class="st-bg"> &nbsp; </td>
										<td class="st-bg"> &nbsp; </td>
										<td class="st-bg"> &nbsp; </td>
										<td class="st-bg"> &nbsp; </td>
									</tr>
								</tbody>
							</table>
							<table class="st-grid" cellspacing="0" cellpadding="0">
								<tbody>
									<tr>
										<td class="st-dtitle "><span class="left" id="SD35"></span><span class="right" id="LD35"> </span></td>
										<td class="st-dtitle"><span class="left" id="SD36"> </span><span class="right" id="LD36"> </span></td>
										<td class="st-dtitle"><span class="left" id="SD37"> </span><span class="right" id="LD37"> </span></td>
										<td class="st-dtitle"><span class="left" id="SD38"> </span><span class="right" id="LD38"> </span></td>
										<td class="st-dtitle"><span class="left" id="SD39"> </span><span class="right" id="LD39"> </span></td>
										<td class="st-dtitle"><span class="left" id="SD40"> </span><span class="right" id="LD40"> </span></td>
										<td class="st-dtitle"><span class="left" id="SD41"> </span><span class="right" id="LD41"> </span></td>
									</tr>
									<tr>
										<td class="st-c "><ul id="UL35"></ul></td>
										<td class="st-c "><ul id="UL36"></ul></td>
										<td class="st-c "><ul id="UL37"></ul></td>
										<td class="st-c "><ul id="UL38"></ul></td>
										<td class="st-c "><ul id="UL39"></ul></td>
										<td class="st-c "><ul id="UL40"></ul></td>
										<td class="st-c "><ul id="UL41"></ul></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-8">
				<ul class="event_list clearfix"></ul>
			</div>
		</div>
	</form><div id="dialog2"></div>
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
		$("ul.event_list").html("");
		y = $("#year").val();
		m = $("#month").val();
		$("#panel").html(y + "年" + m + "月");
		start_date1 = $("#UL0").attr("class").substr(4);
		end_date1 = $("#UL41").attr("class").substr(4);
		$.getJSON("<?php echo U('jsonall');?>", {
			start_date : start_date1,
			end_date : end_date1
		}, function(data) {
			count = 0;
			prev_date = '';
			if (data != null) {
				$.each(data, function(i) {
			<?php echo get_user_ssk('+data[i].user_id+'); ?>
					html = '<li id=li_' + data[i].id + ' style=background-color:' + schedule_bg(data[i].priority) + ">";
					html += '<i class="ico_square"></i>';
					html += '<span class="event_time">' + data[i].start_time + '</span>';//data[i].start_time.substr(0,10)
					html += ' <p id=' + data[i].id + ' class="" title="' + data[i].name + '">' + data[i].user_name +' : '; //event_msg
					html += data[i].name;
					html += '<a  href="__APP__/Schedule/update/id/' + data[i].id + '/p/3" class="btn  btn-success btn-xs <?php echo ($hidde); ?>">标记为正常</a> <a href="__APP__/Schedule/update/id/' + data[i].id + '/p/5" class="<?php echo ($hidde); ?> btn btn-danger btn-xs">标记为异常</a> ';
					html += ' </p>';
					html += "</li>";
					prev_date = data[i].start_date;
					$("ul.event_list").append(html);
				});
			}
		});
	}
	
	function add() {
		window.open("<?php echo U('add');?>", "_self");
	}

	function month_view() {
		window.open("__URL__", "_self");
	}

	function day_view() {
		window.open("<?php echo U('day_view');?>", "_self");
	}

	$(document).ready(function() {
		set_return_url();
		initial();
		$("#cm div").click(function() {
			$("#cm div.active").removeClass("active");
			$(this).addClass("active");
		});

		$(document).on("click", "p.event_msg", function() {
			var msg_list = "";
			current = $(this).attr('id');
			$("p#" + current).parent().parent().find('p.event_msg').each(function() {
				msg_list += $(this).attr("id") + "|";
			});
			winopen("<?php echo U('read');?>?id=" + $(this).attr('id') + "&list=" + msg_list, 730, 490);
		});
	});
	//-->
</script>

<!-- inline scripts related to this page -->
</body>
</html>