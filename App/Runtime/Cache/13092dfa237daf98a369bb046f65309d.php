<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title><?php echo (($title)?($title):"smeoa"); ?></title>
	<meta name="description" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <script src="__PUBLIC__/mui/js/mui.min.js"></script>
    <link href="__PUBLIC__/mui/css/mui.min.css" rel="stylesheet"/>
    
    <script type="text/javascript" charset="utf-8">
      	mui.init();
	</script>
	</head>
	<body onload="">
	<header class="mui-bar mui-bar-nav">
		<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
		<h1 class="mui-title">教学评测oa</h1>
		<a href="wilddog.html" class="mui-action-back mui-icon mui-icon-info mui-pull-right"></a>
	</header>
		<div class="mui-content">
				<style type="text/css" media="screen">
				.hidden{display:none;}
				</style>
<div class="hidden">
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
				
					<span class="badge badge-pink"> <?php echo getToDoNum();?> </span>
					<a href="<?php echo U('login/logout');?>" style="color:#fff">退出</a>
						<span >当前用户：<?php echo (session('user_name')); ?></span>
					<?php echo W('Nav',array('tree'=>$left_menu,'new_count'=>$new_count));?>
	
</div><!-- .hidden -->
			
									

<div id="content" style="height:750px">
			
				<div class="blocks" style="left:0;  width: 100%;">
					<div class="block work" id="switchdiv1" style="overflow: hidden; z-index: 3;">
						<div class="main">
							<div class="div_title1 no_select">
								<div class="switch_btn divBG2 divBG1">
									待办工作
								</div>
								<div class="switch_btn divBG2">
									已办工作
								</div>
								<span><a href="javascript:open_url('__APP__/home/showall')">查看全部&gt;&gt;</a></span>
							</div>
							<div class="worklist">
								<div class="wait switch_">
									<ul>
                                    <?php if(is_array($todo_flow_list)): $i = 0; $__LIST__ = $todo_flow_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>【<?php echo ($vo["user_name"]); ?>】<a href="<?php echo U('flow/read');?>?id=<?php echo ($vo["id"]); ?>" title=""><font color="#000000"><?php echo ($vo["name"]); ?></font></a>&nbsp;(<?php echo (date('Y-m-d h:i',$vo["create_time"])); ?>)
										</li><?php endforeach; endif; else: echo "" ;endif; ?>
	                                    <?php if(is_array($taskgt)): $i = 0; $__LIST__ = $taskgt;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>【<?php echo ($vo["user_name"]); ?>】<a href="<?php echo U('task/read');?>?id=<?php echo ($vo["id"]); ?>" title=""><font color="#000000"><?php echo ($vo["name"]); ?></font></a>&nbsp;(<?php echo (date('Y-m-d h:i',$vo["create_time"])); ?>)
											</li><?php endforeach; endif; else: echo "" ;endif; ?>
									</ul>
								</div>
								<div class="already switch_" style="left: 856px; opacity: 0;">
									<ul>
                                    <?php if(is_array($show1)): $i = 0; $__LIST__ = $show1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
											<a href="<?php echo U('flow/read');?>?id=<?php echo ($vo["id"]); ?>">【<?php echo ($vo["user_name"]); ?>】<font color="#000000"><?php echo ($vo["name"]); ?></font></a>&nbsp;(<?php echo (date('Y-m-d h:i',$vo["create_time"])); ?>)
										</li><?php endforeach; endif; else: echo "" ;endif; ?>
	                                    <?php if(is_array($task_done)): $i = 0; $__LIST__ = $task_done;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>【<?php echo ($vo["user_name"]); ?>】<a href="<?php echo U('task/read');?>?id=<?php echo ($vo["id"]); ?>" title=""><font color="#000000"><?php echo ($vo["name"]); ?></font></a>&nbsp;(<?php echo (date('Y-m-d h:i',$vo["create_time"])); ?>)
											</li><?php endforeach; endif; else: echo "" ;endif; ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
	

					<div class="block email">
						<div class="main">
							<div class="div_title no_select">
								公告通知<!-- <span onclick="view_more('notify','公告通知','/general/notify/show/')">更多&gt;&gt;</span> -->
							</div>
							<ul>
                            <?php if(is_array($new_notice_list)): $i = 0; $__LIST__ = $new_notice_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
									<a onclick="open_url('<?php echo U('notice/read');?>?id=<?php echo ($vo["id"]); ?>')" >
<?php switch($vo["folder"]): case "71": ?>【行政公告】<?php break;?>
<?php case "72": ?>【教学公告】<?php break;?>
<?php case "73": ?>【其他公告】<?php break;?>
<?php default: endswitch;?>
<font color="#000000"> <?php echo ($vo["name"]); ?></font></a>&nbsp;(<?php echo (date('Y-m-d',$vo["create_time"])); ?>)<?php echo (notice_read($vo["id"])); ?>
								</li><?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
						</div>
					</div>
					<div class="block email">
						<div class="main">
							<div class="div_title no_select">
								我的课程表
									<span><a href="javascript:open_url('__APP__/teaching/allkechengbiao')">查看全部&gt;&gt;</a></span>
							</div>
			              
                       <table  class="table table-striped table-bordered table-condensed" style="margin:10px 20px; width:95%;clear:both;width" id="mytable">
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
					                               5节
					                            </td>
					                            <td>
					                              <?php echo get_action_weekone(1,"6");?>
					                            </td>
					                            <td class="hidden-phone">
					                              <?php echo get_action_weekone(2,"6");?>
					                            </td>
					                            <td class="hidden-phone">
					                              <?php echo get_action_weekone(3,"6");?>
					                            </td>
					                            <td class="hidden-phone">
					                              <?php echo get_action_weekone(4,"6");?>
					                            </td>
					                            <td class="hidden-phone">
					                              <?php echo get_action_weekone(5,"6");?>
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
					                          <tr class="">
					                            <td>
					                               11-12节
					                            </td>
					                            <td>
					                              <?php echo get_action_weekone(1,"5");?>
					                            </td>
					                            <td class="hidden-phone">
					                              <?php echo get_action_weekone(2,"5");?>
					                            </td>
					                            <td class="hidden-phone">
					                              <?php echo get_action_weekone(3,"5");?>
					                            </td>
					                            <td class="hidden-phone">
					                              <?php echo get_action_weekone(4,"5");?>
					                            </td>
					                            <td class="hidden-phone">
					                              <?php echo get_action_weekone(5,"5");?>
					                            </td>
					                          </tr>
					            
					                        </tbody>
					                      </table>

						</div>
			
					</div>
					<div class="block notice">
							<div class="main">
							<div class="div_title no_select">
								异常指标 <!-- <span onclick="view_more('email','电子邮件','/general/email/')">更多&gt;&gt;</span> -->
							</div>
							<ul>
								
							<?php if(is_array($schedule)): $i = 0; $__LIST__ = $schedule;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>【<?php echo (get_user_ssk($vo["user_id"])); ?>】<font color="#000000"><?php echo ($vo["name"]); ?></font>&nbsp;(<?php echo ($vo["start_time"]); ?>)
								</li><?php endforeach; endif; else: echo "" ;endif; ?>
							
							
							</ul>
						</div>

					
					</div>
				</div>
			</div>
			
			<div>				
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
<script src="__PUBLIC__/js/min/modernizr-custom-v2.7.1.min.js" type="text/javascript"></script>
<script src="__PUBLIC__/js/min/jquery-finger-v0.1.0.min.js" type="text/javascript"></script>

<!--Include flickerplate-->
<link href="__PUBLIC__/css/flickerplate.css"  type="text/css" rel="stylesheet">
<script src="__PUBLIC__/js/min/flickerplate.min.js" type="text/javascript"></script>

<script type="text/javascript">
	$(function() {
		if (!is_mobile()){
			$('.widget-container-span').sortable({
				connectWith : '.widget-container-span',
				cancel : ".widget-body,.nav-tabs",
				stop : function(event, ui) {
					set_sort();
				},
				items : '> .widget-box',
				opacity : 0.8,
				revert : true,
				forceHelperSize : true,
				placeholder : 'widget-placeholder',
				forcePlaceholderSize : true,
				tolerance : 'pointer'
			});
		}
		init_sort("<?php echo ($home_sort); ?>");
	});

	function init_sort(sort_string) {
		if (sort_string == "") {
			sort_string = "11,12,13|21,22,23";
		}
		array_sort_string = sort_string.split("|");
		sort_string_1 = array_sort_string[0];
		sort_string_2 = array_sort_string[1];

		array_sort = sort_string_1.split(",");

		for (x in array_sort) {
			index = array_sort[x];
			last = $("#t1 .widget-box:last");
			current = $(".widget-box[sort='" + index + "']");
			if (index !== last.attr("sort")) {
				current.insertAfter(last);
			}
		}

		array_sort = sort_string_2.split(",");
		for (x in array_sort) {
			index = array_sort[x];
			last = $("#t2 .widget-box:last");
			current = $(".widget-box[sort='" + index + "']");
			if (index !== last.attr("sort")) {
				current.insertAfter(last);
			}
		}
	};

	function set_sort() {
		var sort_string = "";
		t1_count = $("#t1 .widget-box:not(.display-none)").length;
		t2_count = $("#t2 .widget-box:not(.display-none)").length;

		if ((t1_count == 0) || (t2_count == 0)) {
			ui_error("至少保留一个");
			location.reload();
			return false;
		}
		$("#t1 .widget-box").each(function() {
			sort_string = sort_string + $(this).attr("sort") + ",";
		});
		sort_string = sort_string + "|";
		$("#t2 .widget-box").each(function() {
			sort_string = sort_string + $(this).attr("sort") + ",";
		});
		sendAjax("<?php echo U('set_sort');?>", "val=" + sort_string);
	}

	$(function() {
		$('.flicker-example').flicker({
			auto_flick : true,
			dot_alignment : "right",
			auto_flick_delay : 5,
			flick_animation : "transform-slide",
			theme : "dark"
		});
	});

</script>
<!-- inline scripts related to this page -->
</body>
</html>