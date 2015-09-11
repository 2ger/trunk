<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
	<head>
		<meta charset="utf-8" />
		<title><?php echo ($title); ?></title>
		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!-- basic styles -->
		<link rel="stylesheet" href="__PUBLIC__/css/bootstrap.min.css"  />
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

		<link rel="stylesheet" href="__PUBLIC__/css/ace.min.css" />
		<link rel="stylesheet" href="__PUBLIC__/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="__PUBLIC__/css/ace-skins.min.css" />

		<!--[if lte IE 8]>
		<link rel="stylesheet" href="__PUBLIC__/css/ace-ie.min.css" />		
		<style>
			html {
				position: static
			}
		</style>
		<![endif]-->
		<!-- inline styles related to this page -->
		<link rel="stylesheet" href="__PUBLIC__/css/style.css" />
		<!-- ace settings handler -->

		<script src="__PUBLIC__/js/ace-extra.min.js"></script>

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
	</head>
	<body>
		<!-- Wrap all page content here -->
		<div class="container">
			<div class="col-xs-12 <?php echo (MODULE_NAME); ?>">
				
<style type="text/css" media="screen">
body{background:url('__PUBLIC__/v2/Images/bg.jpg') #659dcc repeat-x ;}
</style>
<div class="container" style="width:1132px;height:660px;background:url('__PUBLIC__/v2/Images/bg-b.jpg');position: relative;">
	<!-- /container -->
	<div class="row">
		<div class="col-xs-12 hidden-xs" style="margin-top:120px;"> </div>
	</div>
	<div class="row" >
		<div class="col-sm-8 hidden-xs hidden">
			<div class="img"></div>
		</div>
		
		<div style="     width: 220px;
    position: absolute;
    left: 645px;
    top: 280px;
    color: #fff;    text-shadow: 1px 1px #333;"  >
			<div style="margin-bottom:44px;margin-top:20px;" >
				<h1 class="text-center"></h1>
			</div>
			<form method="post" id="form_login" class="form-horizontal">
				<div class="form-group">
					<label class="col-sm-4  control-label" for="emp_no">编号：</label>
					<div class="col-sm-8">
						<input class="form-control" id="emp_no" name="emp_no"  vlaue="admin"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4  control-label" for="password">密码：</label>
					<div class="col-sm-8">
						<input class="form-control" id="password" type="password" name="password" vlaue="admin"/>
					</div>
				</div>
				<?php if(!empty($is_verify_code)): ?><div class="form-group">
						<label class="col-sm-3  control-label" for="verify">验证码：</label>
						<div class="col-sm-9 row">
							<div class="col-xs-8">
								<input class="form-control" id="verify" name="verify" />
							</div>
							<div class="col-xs-4">
								<img src='__URL__/verify' / style='cursor:pointer' title='刷新验证码' id='verifyImg' onclick='freshVerify()'>
							</div>
						</div>
					</div><?php endif; ?>
				<div class="form-group display-none hidden" >
					<span class="col-sm-3  control-label"> </span>
					<div class="col-sm-9">
						<label class="inline pull-left col-5">
							<input class="ace" type="checkbox" name="remember" value="" />
							<span class="lbl"> </span> </label>
						<label for="remember-me">记住我的登录状态</label>
					</div>
				</div>
				<div class="form-group">
					<style type="text/css" media="screen">
					.btn-info, .btn-info:focus {
					    background-color: #5c87ba!important;
						border: 1px solid #547fa2!important;
						padding:7px;
						margin-top:30px;
					}
					</style>
					<div class="col-sm-offset-3 col-sm-9">
						<input type="button" value="登录" onclick="login();" class="btn btn-sm btn-info col-12">
					</div>
				</div>
			</form>
			
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12 text-center ">
			<!-- <?php echo get_system_config("SYSTEM_NAME");?> -->
			<a href="http://down.360safe.com/cse/360cse_8.3.0.122.exe" target="_blank" style="color: #fff;">下载系统需求web环境</a> ｜ <a href="http://www.kancloud.cn/dddasdfasdfasdf/t86xuyuanshuoming" target="_blank" style="color: #fff;">OA使用说明书</a>
		</div>
	</div>
</div>
			</div>
		</div>
		<!-- basic scripts -->

		<!--[if !IE]>
		-->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='__PUBLIC__/js/jquery-2.1.0.min.js'>" + "<" + "/script>");
		</script>
		<!-- <![endif]-->

		<!--[if IE]>
		<script type="text/javascript">
		window.jQuery || document.write("<script src='__PUBLIC__/js/jquery-1.11.0.min.js'>"+"<"+"/script>");</script>
		<![endif]-->

		<script src="__PUBLIC__/js/bootstrap.min.js"></script>
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
		<script src="__PUBLIC__/js/ace.min.js"></script>
		<script src="__PUBLIC__/js/common.js"></script>
		<script type="text/javascript">
	function login() {
		if (check_form("form_login")) {
			sendForm("form_login", "<?php echo U('login/check_login');?>");
		}
	}
	
	$(document).ready(function() {
			//sendForm("form_login", "<?php echo U('login/check_login');?>");
		var $dom="#password";
		<?php if(!empty($is_verify_code)): ?>$dom="#verify";<?php endif; ?>

		$($dom).keydown(function(event) {
			if (event.keyCode == 13) {
				if (check_form("form_login")) {
					sendForm("form_login", "<?php echo U('login/check_login');?>");
					return false;
				}
			}
		});
	});
</script>
		<!-- inline scripts related to this page -->
	</body>
</html>