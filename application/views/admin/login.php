<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>微信内容管理系统</title>
<?php echo $res;?>
<script src="<?php echo base_url('assets/js/bootbox.min.js');?>"></script>
<style type="text/css">
body {
	padding-top: 120px;
	padding-bottom: 40px;
}
.form-signin {
	max-width: 400px;
	padding: 19px 29px 29px;
	margin: 0 auto 20px;
	background-color: #fff;
	background-color: #fff;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	-webkit-box-shadow: 0 1px 3px rgba(0,0,0,.4);
	-moz-box-shadow: 0 1px 3px rgba(0,0,0,.4);
	box-shadow: 0 1px 3px rgba(0,0,0,.4);
}
.form-signin .form-signin-heading, .form-signin .checkbox {
	margin-bottom: 10px;
}
.form-signin input[type="text"], .form-signin input[type="password"] {
	font-size: 16px;
	height: auto;
	margin-bottom: 15px;
	padding: 7px 9px;
}
</style>
<script type="text/javascript">
$(document).ready(function() {
	$('.tooltip-demo').tooltip({selector: "a[data-toggle=tooltip]"});

	bootbox.setDefaults({
		locale: "zh_CN"
	});

	$("button").click(function(){
		loginCheck();
	});
	$(document).keyup(function(event){
		  if(event.keyCode ==13){
			  loginCheck();
		  }
	});
	
});

function loginCheck(){
	if($("#username").val()==""){
		bootbox.alert("请填写用户名！");
		return;
	}
	if($("#password").val()==""){
		bootbox.alert("请填写密码！");
		return;
	}
	$(this).button('loading');
	$.ajax({
        type: "POST",
        url: "<?php echo base_url('admin/home/in');?>",
        data:{username:$("#username").val(),password:$("#password").val(),captcha:$("#captcha").val()},
        dataType:"json",
        success: function(data){
            if(data.statu=='yes'){
                location.href=data.url;
            }else if(data.statu=='captcha wrong'){
            	bootbox.alert("验证码错误！");
            	$('button').button('reset');
            }else{
            	bootbox.alert("用户名或密码错误！");
            	$('button').button('reset');
            }
        }
    });
}
</script>
</head>

<body>
<div class="container">
	<form class="form-signin" action="#" method="post">
		<span class="form-signin-heading pull-right" style="color:#ccc;"><?php $sysname =$this->session->userdata('sysname'); echo $sysname;?></span>
		<h2 class="form-signin-heading"><i class="icon-signin"></i> 用户登录</h2>
		<div style="clear:both; height:15px;"></div>
		<input name="username" id="username" type="text" class="form-control" placeholder="用户名" dataType="Require" msg="用户名必须填写" autocomplete= "off" value="" >
		<input name="password" id="password" type="password" class="form-control" placeholder="密码" dataType="Require" msg="密码必须填写">
		<input name="captcha" id="captcha" type="text" class="form-control" placeholder="验证码" dataType="Require" msg="验证码必须填写" style="float:left;width:175px;margin-right:15px;">
		<div style="float:left;padding-top:4px">
        <img src="<?php echo site_url('admin/home/captcha');?>" alt="" onclick= this.src="<?php echo site_url('admin/home/captcha').'/'?>"+Math.random() style="cursor: pointer;" title="看不清？点击更换另一个验证码。"/>
		</div>
		<div class="clear"></div>
			<button type="button" data-loading-text="正在验证..." class="btn btn-lg btn-success btn-block">登　　录</button>
		<div style="clear:both;"></div>
	</form>
</div>
</body>
</html>