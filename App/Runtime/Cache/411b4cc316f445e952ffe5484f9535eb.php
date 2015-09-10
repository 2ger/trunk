<?php if (!defined('THINK_PATH')) exit();?>	<div class="form-group">
		<label class="col-sm-2 control-label" for="field_<?php echo ($name); ?>"><?php echo ($name); ?></label>
		<div class="col-sm-10">
			<?php echo W('FlowControl',$data);?>
		</div>
	</div>