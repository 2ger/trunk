<?php if (!defined('THINK_PATH')) exit();?><html>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<!-- basic styles -->
	<link rel="stylesheet" href="__PUBLIC__/css/bootstrap.min.css"  />

		<script src="__PUBLIC__/v2/Scripts/jquery.min.js" type="text/javascript"></script>
		<script src="__PUBLIC__/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="/trunk/Public/v2/Content/pure-min.css" type="text/css">


	<!-- inline styles related to this page -->
	<link rel="stylesheet" href="__PUBLIC__/css/style.css" />
	<!-- ace settings handler -->
<body class="showall" onload="">
	
							<ul class="list-group">
                                    <?php if(is_array($showall)): $i = 0; $__LIST__ = $showall;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="list-group-item">
											<a href="<?php echo U('flow/read');?>?id=<?php echo ($vo["id"]); ?>">【<?php echo ($vo["user_name"]); ?>】<font color="#000000"><?php echo ($vo["name"]); ?></font></a>&nbsp;(<?php echo (date('Y-m-d',$vo["create_time"])); ?>)
										</li><?php endforeach; endif; else: echo "" ;endif; ?>
	                                    <?php if(is_array($task_done)): $i = 0; $__LIST__ = $task_done;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>【<?php echo ($vo["user_name"]); ?>】<a href="<?php echo U('task/read');?>?id=<?php echo ($vo["id"]); ?>" title=""><font color="#000000"><?php echo ($vo["name"]); ?></font></a>&nbsp;(<?php echo (date('Y-m-d',$vo["create_time"])); ?>)
											</li><?php endforeach; endif; else: echo "" ;endif; ?>
	                                    <?php if(is_array($taskall)): $i = 0; $__LIST__ = $taskall;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="list-group-item">【<?php echo ($vo["user_name"]); ?>】<a href="<?php echo U('task/read');?>?id=<?php echo ($vo["id"]); ?>" title=""><font color="#000000"><?php echo ($vo["name"]); ?></font></a>&nbsp;(<?php echo (date('Y-m-d',$vo["create_time"])); ?>)
											</li><?php endforeach; endif; else: echo "" ;endif; ?>
									</ul>
</body>
		</html>