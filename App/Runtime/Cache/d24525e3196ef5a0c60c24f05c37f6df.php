<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
	<head>
		<meta charset="utf-8" />
		<title></title>
		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!-- basic styles -->

		<link href="__PUBLIC__/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="__PUBLIC__/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="__PUBLIC__/css/jquery.gritter.css" />
<?php if(!empty($widget["jquery-ui"])): ?><link rel="stylesheet" href="__PUBLIC__/css/jquery-ui-1.10.3.full.min.css" /><?php endif; ?>
<?php if(!empty($widget["date"])): ?><link rel="stylesheet" href="__PUBLIC__/css/datepicker.css" />
	<link rel="stylesheet" href="__PUBLIC__/css/bootstrap-datetimepicker.css" /><?php endif; ?>


		<!-- fonts -->

		<!-- ace styles -->
		<link rel="stylesheet" href="__PUBLIC__/css/ace.min.css" />
		<link rel="stylesheet" href="__PUBLIC__/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="__PUBLIC__/css/ace-skins.min.css" />
		<link rel="stylesheet" href="__PUBLIC__/css/idangerous.swiper.css">
		<link rel="stylesheet" href="__PUBLIC__/css/idangerous.swiper.scrollbar.css">

		<!--[if lte IE 8]>
		<link rel="stylesheet" href="__PUBLIC__/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->
		<link rel="stylesheet" href="__PUBLIC__/css/style.css" />
		<!-- ace settings handler -->
		<style>
			.swiper-container{
				overflow-y: auto;				
			}
			.swiper-slide {
				padding: 0px;
				background: #fff;
			}
			.red-slide {
				background: #ca4040;
			}
			.blue-slide {
				background: #4390ee;
			}
			.orange-slide {
				background: #ff8604;
			}
			.green-slide {
				background: #49a430;
			}
			.pink-slide {
				background: #973e76;
			}
			.swiper-scrollbar {
				width: 100%;
				height: 4px;
				position: relative;
				left: 0;
				bottom: 5px;
				z-index: 1;
			}
		</style>
		<script src="__PUBLIC__/js/ace-extra.min.js"></script>

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

		<!--[if lt IE 9]>
		<script src="__PUBLIC__/js/html5shiv.js"></script>
		<script src="__PUBLIC__/js/respond.min.js"></script>
		<![endif]-->
		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='__PUBLIC__/js/jquery-2.1.0.min.js'>" + "<" + "/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
		<script type="text/javascript">
		window.jQuery || document.write("<script src='__PUBLIC__/js/jquery-1.11.0.min.js'>"+"<"+"/script>");
		</script>
		<![endif]-->

		<script src="__PUBLIC__/js/bootstrap.min.js"></script>

		<script src="__PUBLIC__/js/idangerous.swiper-2.1.min.js"></script>
		<script src="__PUBLIC__/js/idangerous.swiper.scrollbar-2.1.js"></script>
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
		<!-- inline scripts related to this page -->
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
		<div class="swiper-container">
			<div class="swiper-scrollbar"></div>
			<div class="swiper-wrapper">
				<div class="swiper-slide">
					<div class="container popup">
						
<script type="text/javascript">
	function save() {
		$html=$("#rc select").html();
		var re = new RegExp("dept_","g");
		var arr = $html.match(re);
		if(arr!=null){
			$dept_count=arr.length;
			$total_count=$("#rc select option").length;
			if($dept_count!=$total_count){
				ui_error('部门和人员不能同时选择');
				return false;
			}
		}
		$("#rc select option").each(function(i) {
			//email = ($(this).html().split(";")[1].split("&")[0]);
			emp_no = $(this).val();
			name = jQuery.trim($(this).text());
			name = name.replace(/<.*>/, '');
			html_string = conv_inputbox_item(emp_no, name, emp_no, emp_no);
			$("#actor_wrap .address_list", parent.document).append(html_string);
		});
		myclose();
	}

	function showdata(result) {
		$("#addr_list").html("");
		if ( type = $("input[name='type']:checked").val() == "company") {
			var id = "dept_" + $("#company a.active").attr("node");
			var dept_name = $("#company a.active span").text();
			var email = "dept@group";
			var name = dept_name + "&lt;" + email + "&gt;";
			var html_string = conv_address_item(id, name);
			$("#addr_list").html(html_string);
		}else {
			for (s in result.data) {
				var id = result.data[s].id;
				var position_name = result.data[s].position_name;
				var emp_no = result.data[s].emp_no;
				var email = result.data[s].email;
				var name = result.data[s].name;
				//var name = name + "/" + position_name + "&lt;" + email + "&gt;";
				var html_string = conv_address_item(id, name);
				$("#addr_list").append(html_string);
			}
		}
		
	}

	$(document).ready(function() {

		$("#rb_<?php echo ($type); ?>").prop('checked', true);
		// 选择用户默认选择的类型

		$("#<?php echo ($type); ?>").removeClass("display-none");

		$("input[name='type']").on('click', function() {
			$("input[name='type']").each(function() {
				$("#" + $(this).val()).addClass("display-none");
			});
			$("#" + $(this).val()).removeClass("display-none");
		});

		$(".tree_menu  a").click(function() {
			$(".tree_menu a").attr("class", "");
			var type = $("input[name='type']:checked").val();
			$(this).attr("class", "active");
			sendAjax("<?php echo U('read');?>", "type=" + type + "&id=" + $(this).attr("node"), function(data) {
				showdata(data);
			});
			return false;
			//禁止连接生效
		});

		$(document).on("dblclick", "#addr_list label", function() {
			$text = $(this).text();
			$val = $(this).find("input").val();
			if ($("#rc select option[value='" + $val + "']").val() == undefined) {
				$("<option></option>").val($val).text($text).appendTo("#rc select");
				$("#rc_count").text("(" + $("#rc select option").length + ")");
			};
		});

		$("#rc  select").on("dblclick", function() {
			$(this).find("option:selected").remove();
			$("#rc_count").text("(" + $("#rc select option").length + ")");
		});

		$("#addr_list").on("mouseover", function() {
			$("#addr_list label").draggable({
				appendTo : "body",
				helper : "clone"
			});
		});
	});
	//最终确认

	function add_address(name) {
		$("input:checked[name='addr_id']").each(function() {
			$text = $(this).parents("label").find("span").text();
			$val = $(this).val();
			if ($("#" + name + " select option[value='" + $val + "']").val() == undefined) {
				$("<option></option>").val($val).text($text).appendTo("#" + name + " select");
				$("#" + name + "_count").text("(" + $("#" + name + " select option").length + ")");
			};
		});
	}

	//-->
</script>
<div class="panel panel-default ">
	<div class="panel-heading clearfix">
		<div class="pull-left">
			<label class="hidden">
				<input class="ace"  type="radio" id="rb_company" name="type" value="company" >
				<span class="lbl">部门</span> </label>

			<label>
				<input  class="ace"  type="radio" id="rb_rank" name="type" value="rank">
				<span class="lbl">职级</span> </label>

			<label>
				<input  class="ace"  type="radio" id="rb_position" name="type" value="position">
				<span class="lbl">职位</span> </label>

		</div>
		<div class="pull-right">
			<a  onclick="save();" class="btn btn-sm btn-primary">确定</a>
			<a  onclick="myclose();" class="btn btn-sm btn-primary">关闭</a>
		</div>
	</div>
	<div class="panel-body">
		<div class="col-28 pull-left">
			<div class="">
				<b>地址簿</b>
			</div>
			<div class="popup_tree_menu" >
				<div id="company" class="display-none" style="height:200px;">
					<?php echo ($list_company); ?>
				</div>
				<div id="rank" class="display-none" style="height:200px;">
					<?php echo ($list_rank); ?>
				</div>
				<div id="position" class="display-none" style="height:200px;">
					<?php echo ($list_position); ?>
				</div>
				<a href="#" class="btn btn-success btn-xs" onclick='$(":checkbox").attr("checked", true);add_address("rc");'>全选并添加 <i class="fa fa-angle-double-right"></i></a>
				
				<div id="personal" class="display-none" style="height:200px;">
					<ul class="tree_menu">
						<?php if(is_array($list_personal)): $i = 0; $__LIST__ = $list_personal;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
								<a class="" node="<?php echo ($key); ?>"><i class="icon level1"></i><span><?php echo ($vo); ?></span></a>
							</li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
			</div>
			<div>
				<div id="addr_list" style="width:100%;height:210px;"></div>
			</div>
		</div>
		<div class="col-34 pull-right">
			<div>
				<b style="padding-left: 60px;">执行人员</b><span id="rc_count"></span>
			</div>
			<div class="clearfix" style="margin-bottom: 15px;">
				<label class="col-4 pull-left text-right" ><a onclick="add_address('rc');" class="btn btn-sm btn-primary"> <i class="fa fa-angle-double-right"></i> </a> </label>
				<div class="col-28 pull-right">
					<div id="rc" style="width:100%;height:424px;overflow:hidden">
						<select size="6" style="height:100%;width:100%;"></select>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

					</div>
				</div>
			</div>
		</div>
		<script>
			$(document).ready(function(){
				if(is_mobile()){
					$(".swiper-container").width($("#dialog",parent.document).width());
					$(".swiper-container").height(window.screen.height-40);													
					var mySwiper = new Swiper('.swiper-container', {
						scrollContainer : true,
						scrollbar : {
							container : '.swiper-scrollbar'
						}
					});						
				}else{
					$(".swiper-container").width(700);
				}				
			});
		</script>
	</body>
</html>