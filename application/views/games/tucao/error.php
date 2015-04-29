<!DOCTYPE html>
<html lang="en">
<head>
	<title>抱歉，出错了</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
	<link rel="stylesheet" href="<?php echo site_url('assets/css/tucao/err.css');?>">
</head>
<body>
<div class="page_msg">
	<div class="inner">
		<span class="msg_icon_wrp">
			<i class="icon80_smile"></i>
		</span>
		<div class="msg_content">
			<h4><?php if(isset($msg)) echo $msg;?></h4>
		</div>
		<?php if(isset($jump)&&$jump){?>
		<meta http-equiv="refresh" content="<?php echo $time;?>;URL=<?php echo $forward;?>">
		<?php }?>
	</div>
</div>
</body>
</html>