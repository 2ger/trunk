<?php if (!defined('THINK_PATH')) exit();?><html>
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

	<link rel="stylesheet" href="__PUBLIC__/css/uncompressed/ace.css" />
	<link rel="stylesheet" href="__PUBLIC__/css/uncompressed/ace-rtl.css" />
	<link rel="stylesheet" href="__PUBLIC__/css/uncompressed/ace-skins.css" />

	<!--[if lte IE 8]>
	<link rel="stylesheet" href="__PUBLIC__/css/uncompressed/ace-ie.css" />
	<![endif]-->

	<!-- inline styles related to this page -->
	<link rel="stylesheet" href="__PUBLIC__/css/style.css" />
	<!-- ace settings handler -->
<script src="__PUBLIC__/v2/Scripts/jquery.min.js" type="text/javascript">
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
	<style type="text/css" media="screen">
	.addsimple{width:100%!important}
	</style>
            <?php if($is_sign == 0): ?><body class="addsimple" onLoad="sign()" style="">
		<?php else: ?>

	<body class="addsimple" style=""><?php endif; ?>
		
<input type="hidden" id="id" name="id" value="<?php echo ($vo["id"]); ?>">
<?php echo W('PageHeader',array('name'=>$vo['name'],'search'=>'N'));?>
<div class="operate panel panel-default hidden">
	<div class="panel-body">
		<div class="pull-left">
			<a onclick="go_return_url();" class="btn btn-sm btn-primary">返回</a>
			<?php if($auth['admin']): ?><a onclick="del();" class="btn btn-sm btn-danger">删除</a><?php endif; ?>
		</div>
		<div class="pull-right">
        	<!--增加签收-->
            <?php if($is_sign == 0): ?><a onclick="sign()" class="btn btn-sm btn-primary">请签收</a><?php endif; ?>
         	<!--增加签收-->
			<a onclick="winprint()" class="btn btn-sm btn-primary">打印</a>
			<?php if($auth['write']): ?><a onclick="edit();" class="btn btn-sm btn-primary">修改</a><?php endif; ?>
		</div>
	</div>
</div>
<form method='post' id="frm_content" name="frm_content" enctype="multipart/form-data"  class="well form-horizontal">
	<input type="hidden" id="id" name="id" value="<?php echo ($vo["id"]); ?>">
	<div class="form-group col-sm-6 hidden">
		<label class="col-sm-4 control-label">编号：</label>
		<div class="col-sm-8">
			<p class="form-control-static">
				<?php echo ($vo["notice_no"]); ?>
			</p>
		</div>
	</div>

	<div class="form-group col-sm-6">
		<label class="col-sm-4 control-label" >发布人：</label>
		<div class="col-sm-8">
			<p class="form-control-static">
				<?php echo ($vo["user_name"]); ?>
			</p>
		</div>
	</div>
	
	<div class="form-group col-sm-6">
		<label class="col-sm-4 control-label" >发布日期：</label>
		<div class="col-sm-8">
			<p class="form-control-static">
				<?php echo (todate($vo["create_time"],'Y年m月d日 H:i')); ?>
			</p>
		</div>
	</div>


	<div class="form-group col-sm-6 hidden">
		<label class="col-sm-4 control-label hidden" >管理者：</label>
		<div class="col-sm-8">
			<p class="form-control-static">
				<?php echo (show_contact($admin)); ?>
			</p>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="form-group">
		<div class="col-xs-12">
			<div class="content_wrap" >
				<iframe class="content_iframe"></iframe>
				<textarea  class="editor content" name="content" style="width:100%;display:none"><?php echo ($vo["content"]); ?></textarea>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label" for="name">附件：</label>
		<div class="col-sm-10">
			<?php echo W('File',array('add_file'=>$vo['add_file'],'mode'=>'show'));?>
		</div>
	</div>
    <!--增加签收-->
	<div class="form-group">
		<label class="col-sm-2 control-label" for="name">已签收人员：</label>
		<div class="col-sm-10">        	
			<div class="sign_box">
				<?php if(is_array($signlist)): $i = 0; $__LIST__ = $signlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vosign): $mod = ($i % 2 );++$i;?>&lt; <?php echo ($vosign["user_name"]); ?> <?php echo (todate($vosign["sign_time"],'Y-m-d H:i')); ?> &gt;<?php endforeach; endif; else: echo "" ;endif; ?>            
			</div>
		</div>
	</div>
    <!--增加签收-->
</form>
<div class="text-center">

	<a onclick="winprint()" class="btn btn-sm btn-primary hidden-print">打印</a>
</div>
<!--[if IE]>
<script type="text/javascript">
		window.jQuery || document.write("<script src='__PUBLIC__/js/jquery-1.11.0.min.js'>"+"<"+"/script>");</script>
<![endif]-->
<script type="text/javascript">
			if ("ontouchend" in document)
				document.write("<script src='__PUBLIC__/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");</script>
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
<script src="__PUBLIC__/js/uncompressed/ace.js"></script>
<script src="__PUBLIC__/js/common.js"></script>
<script type="text/javascript">
	$(function() {
		show_content();
	});

	function del() {
		ui_confirm('确定要删除吗?',function(){
			sendAjax("<?php echo U('mark','action=del');?>", 'id=' + $("#id").val(), function(data) {
				if (data.status) {
					ui_alert(data.info,function(){
						go_return_url();
					});								
				}
			});
		});
	}

	function attach_down(obj) {
		winopen("<?php echo U('down');?>?attach_id=" + $(obj).attr("file_id") + "&id/" + $("#id").val(), 730, 300);
	}

	function edit() {
		window.open(fix_url("<?php echo U('edit');?>?id=" + $("#id").val()), "_self");
	}

	//增加签收
	function sign() 
	{
		sendAjax("<?php echo U('sign');?>", 'id=' + $("#id").val(), function(data) {
			if (data.status) {
				ui_alert(data.info,function(){
					location.reload();//重载当前页
					//go_return_url();//返回上一页
				});								
			}
		});
	}
	//增加签收
</script>
<!-- inline scripts related to this page -->
	</body>
	</html>