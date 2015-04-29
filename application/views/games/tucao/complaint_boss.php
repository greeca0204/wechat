<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta http-equiv="expires" content="-1">
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="cache-control" content="no-cache">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<title>你行你来BIBI，奇葩上司等你吐槽！</title>
	<link rel="shortcut icon" type="image/ico" href="<?php echo site_url('assets/images/tucao/niu-icon.png');?>">
	<link rel="stylesheet" href="<?php echo site_url('assets/css/tucao/reset.css');?>">
	<link rel="stylesheet" href="<?php echo site_url('assets/css/tucao/style.css');?>">
	<link rel="stylesheet" href="<?php echo site_url('assets/css/tucao/loading.css');?>">
	<link rel="stylesheet" href="<?php echo site_url('assets/css/tucao/bootstrap-modal.css');?>">
	<script>
		var isSubscribe = <?php echo $isSubscribe; ?>;
	</script>
</head>
<body>
<div id="share_mask">
    <img src="<?php echo site_url('assets/images/tucao/share.png');?>" id="share_mask_img" width="100%">
</div>
<div style="display:none;" id="loader">
    <div class="loader">算卦中...</div>
</div>
<div id="loading" class="loading">
	<div class="inner">
		<p class="loading_rate" id="loading_rate">0%</p>
		<p class="loading_progress">
			<span class="bar" id="bar"></span>
		</p>
	</div>
</div>
<div class="container">
	<div class="top">
		<a href="javascript:;" id="intro">活动奖品说明</a>
	</div>
	<div class="mid">
		<div class="txt_container">
			<div class="txt">
				<textarea id="content"></textarea>
			</div>
		</div>
		<div class="mirror">
			<img src="<?php echo site_url('assets/images/tucao/finger.png');?>" class="finger">
			<img src="<?php echo site_url('assets/images/tucao/mirror.png');?>" class="submit" id="submit">
		</div>
	</div>
	<div class="bottom">
		<div class="head"><img src="<?php echo site_url('assets/images/tucao/bg3.jpg');?>" width="100%"></div>
		<div id="scrollDiv">
			<div id="ulBox" style="overflow:Hidden;margin:0 auto;max-height:100%;">
				<ul>
					<?php if(isset($tucao)){ ?>
						<?php foreach ($tucao as $item){?>
						<li data-id="<?php echo $item['id'];?>"><span><?php echo $item['nickName'];?></span>：<?php echo $item['remark'];?></li>
						<?php }?>
					<?php }?>
				</ul>
			</div>
		</div>
</div>
</div>
<div class="modal fade modal_bg" id="rule" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="background:#ea4543;">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-content rule_bg">
            <div class="modal-body popupwindow">
                <div class="modal_inner rule_intro">
                <h2>活动说明</h2>
				<p>活动时间：2015年1月30日——2月8日</p>
				<p>活动规则：关注流量宝微信公众号（llb21cn），输入JB，进入游戏页面，吐槽你的上司，就有机会获得大奖。</p>
				<p>奖项设置：</p>
				<p>最“奇葩”上司奖，共1名</p>
				<p>最“任性”上司奖，共1名</p>
				<p>最“二逼”上司奖，共1名</p>
				<p>最“抠逼”上司奖，共1名</p>
				<p>最“傲娇”上司奖，共1名</p>
				<p>最“脑残”上司奖，共1名</p>
				<p>“你的上司够奇葩”奖：200M流量，共5名</p>
				<p>奖品设置：</p>
				<p>（保密！绝对是对抗上司的极品装备哦！）</p>
				<p>请时刻关注我们的微信公众号，中奖名单奖会在微信公众号上公布！</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 通用弹出层-->
<div class="modal fade" id="dialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="border-radius: 10px;display: none;">
    <div class="modal-dialog" style="background:#ff4040;">
        <div class="modal-header" style="background:#a50707;padding: 20px;">
            <button type="button" class="close" data-dismiss="modal" style="margin-top: -10px;"><span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" id="alert" style="font-size:16px;color:#fff;"></div>
        <div class="modal-footer" style="background:#ea4543;text-align:center;">
            <button type="button" class="btn"  data-dismiss="modal" style="background:#edc931;">确定</button>
        </div>
    </div>
</div>
<!-- 提示注册弹出层-->
<div class="modal fade" id="zhuchebox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="border-radius: 10px;display: none;">
    <div class="modal-dialog" style="background:#ea4543;">
        <div class="modal-header" style="border-bottom: 2px solid #fff;">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
            </button>
            <h3 id="myModalLabel">温馨提示</h3>
        </div>
        <div class="modal-body" id="zhuche" style="font-size:16px;color:#fff;"></div>
        <div class="modal-footer" style="background:#ea4543;text-align:center;">
            <button type="button" class="btn" style="background:#edc931;height: 40px;line-height: 40px;font-size: 18px;font-weight: bold;color: #990000;letter-spacing: 2px;" id="gogz">马上关注</button>
        </div>
    </div>
</div>
<!-- 游戏结果弹出层-->
<div class="modal fade" id="gameResultBox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="border-radius: 10px;display: none;">
    <div class="modal-dialog" style="background:#ff4040;">
        <div class="modal-header" style="background:#a50707;padding:5px;">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="font-size: 2.2rem;">&times;</span>
            </button>
            <h3>&nbsp;</h3>
        </div>
        <div class="modal-body" style="font-size:16px;color:#fff;padding: 20px 0;text-align: center;">
        	<img src="" id="gameResultPic">
        	<div id="gameResult" style="margin-top:20px;"></div>
        </div>
        <div class="modal-footer" style="background:#ff4040;text-align:center;padding-bottom:30px;">
            <button type="button" class="btn btn2" data-dismiss="modal" style="width:100px;">再玩一次!</button>
            <button type="button" class="btn btn2" id="share" style="width:100px;">告诉小伙伴们!</button>
        </div>
    </div>
</div>
<!-- 精彩吐槽详情-->
<div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="border-radius: 10px;display: none;">
    <div class="modal-dialog" style="background:#ff4040;">
        <div class="modal-header" style="background: #a50707;padding:5px;">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="font-size: 2.2rem;">&times;</span>
            </button>
            <h3 style="font-size: 1rem;letter-spacing: 2px;">吐槽详情</h3>
        </div>
        <div class="modal-body" style="font-size:16px;color:#fff;">
        	<span id="author" style="color:#fff100;padding-right:15px;"></span>
        	<article id="tucao_detail" style="padding: 15px 0 25px 0;overflow-y: scroll;"></article>
        </div>
        <div class="modal-footer" style="background:#ff4040;text-align: center;">
            <button type="button" class="btn btn2" data-dismiss="modal">确定</button>
        </div>
    </div>
</div>
<script src="<?php echo site_url('assets/js/jquery-2.1.1.min.js');?>"></script>
<script src="<?php echo site_url('assets/bootstrap/js/bootstrap.min.js');?>"></script>
<script src="<?php echo site_url('assets/js/tucao/main.js');?>"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script src="<?php echo site_url('assets/js/tucao/fontscroll.js');?>"></script>
<script type="text/javascript">
var _timer = parseInt(Date.now() + Math.random() * 100000000000);
var IMG_PATH = "<?php echo site_url('assets/images/tucao').'/';?>";
var IMG_NET_PATH = "<?php echo site_url('assets/images/tucao').'/';?>";
var GAME_IMG_RESULT = IMG_NET_PATH+'head.jpg';
var placeholder = '受不了了！老子今天就要说出来！\n(点击下方照妖镜,即可让你的上司现出原形!)';
$(function(){
	$('#ulBox').FontScroll({time: 2000,num: 1});
	$(".top").height($(".container").width()/640*466);
	$(".mid").height($(".container").width()/640*350);
	$("#scrollDiv").height($(".container").width()/640*251);
	var ulBoxHeight = $("#ulBox ul:first").height();
	if(ulBoxHeight>$("#scrollDiv").height()){
		ulBoxHeight = $("#scrollDiv").height();
	}
	$("#tucao_detail").height($(window).height()*0.5);
	$("#ulBox").height(ulBoxHeight);
	$("#content").val(placeholder);
	$("#content").focus(function(){
		 if ($(this).val() === placeholder) {
			 $(this).val('')
	     }
		if(!isSubscribe){
			$("#zhuche").text('请先关注流量宝微信公众号：llb21cn');
			$("#zhuchebox").modal("show");
		}
	}).blur(function() {
	    if ($(this).val().length === 0) {
	    	$(this).val(placeholder);
	    }
	});
	$("#intro").click(function(){
			$("#rule").modal("show");
		});
	$("#gogz").click(function(){
		window.location.href="http://mp.weixin.qq.com/s?__biz=MzA3NzEzNjMxNg==&mid=210110054&idx=2&sn=241ea5f2ead470dab7cbfcae3a244ee4#rd";
	});
	$('#share').click(function () {
	    $("#share_mask").css("display", "block");
	});
	$("#share_mask").click(function () {
	    $(this).css("display", "none");
	});
	$('.modal').on('shown.bs.modal', function (e) {
	    $(this).css({  
	        'top': function () {  
	            var modalHeight = $(this).find("div").first().height();
	            var top = $(window).height() / 2 - (modalHeight / 2);
	            if(top < modalHeight*0.1){
	            	top = "10%";
	            }
	            return top;  
	        }  
	    });      
	});
	$("#scrollDiv ul li").click(function (){
		var tucao_id = $(this).attr("data-id");
		 $.ajax({
	         type: 'GET',
	         url: '<?php echo site_url('games/tucao/getOneComplaint').'/';?>'+tucao_id,
	         data:{},
	         dataType: 'json',
	         beforeSend: function (x) {
	    
	         },
	         error: function (XMLHttpRequest, textStatus, errorThrown) {
	             alert("获取数据失败,请检查网络！");
	         },
	         success: function (json) {
	        	 if(json.status=='1001'){
	        		 $("#author").text(json.nickname+'：');
	        		 $("#tucao_detail").text(json.remark);
	        		 $("#detail").modal("show");
	        	 } else if(json.status=='1002'){
	        		 alert(json.msg);
	        	 } else if(json.status=='1003'){
	        		 alert(json.msg);
	        	 }
	         	
	         }, complete:function(x){
	         }
	     });
	});
	$("#submit").click(function(){
		var content = $("#content").val();
		if(content.length==0||content==placeholder){
			alert("请先吐槽你的奇葩上司！");
			return false;
		}
	        $.ajax({
	            type: 'POST',
	            url: '<?php echo site_url('games/tucao/getResult');?>',
	            dataType: 'json',
	            data: {'content':content},
	            beforeSend: function (x) {
	            	$("#loader").show();           	
	            },
	            error: function (XMLHttpRequest, textStatus, errorThrown) {
	                alert("提交失败,请检查网络！");
	                $("#loader").hide();
	            },
	            success: function (json) {
	            	setTimeout(function(){
	            		if(json.status=='1001'){
	                    	$("#loader").hide();
	    	            	$("#content").val(placeholder);
	    	            	var gameResultPic = new Image(); 
	    	            	gameResultPic.src = IMG_PATH+"pic_"+json.num+'.jpg';
	    	            	$("#gameResult").text(json.msg);
	    	            	wxData.title = json.msg.replace("你的","我的")+'。你也快来吐槽奇葩上司，测测他的前世，还有机会中大奖哦！';
	    	            	wxData.imgUrl = IMG_NET_PATH+"pic_"+json.num+'.jpg';
	 	 	            	$("#gameResultPic").attr("src",IMG_PATH+"loader.gif");
	                		$("#gameResultBox").modal("show");
	    	            	gameResultPic.onload=function(){
	    	 	            	if(gameResultPic.complete) {
	    	 	            		$("#gameResultPic").attr("src",gameResultPic.src);
	    	 	            	}
	    	            	}
	                	}else if(json.status=='1002'){
	                		window.location.href="<?php echo site_url('games/tucao/regetUserInfo');?>"
	                	}else if(json.status=='1003'){
	                		$("#zhuche").text('请先关注流量宝微信公众号：llb21cn');
	                		$("#zhuchebox").modal("show");
	                	}
	            	},1500);           	
	            }, complete:function(x){
	            }
	        });
	});
});
wx.config({
    debug: false,
    appId: '<?php echo $res['appid'];?>',
    timestamp:'<?php echo $res['timestamp'];?>',
    nonceStr: '<?php echo $res['noncestr'];?>',
    signature: '<?php echo $res['sign'];?>',
    jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage']
});
var wxData = {
		"title" : "快来吐槽奇葩上司，测测他的前世，还有机会中大奖哦！",
		"desc" : '上司虐我千百遍，我待上司如初恋。今天我就要向你证明我上司是最奇葩，我们来PK，看看谁可以中大奖。',	      
        "link" : "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx5ce0cf9472acf4b6&redirect_uri=http%3a%2f%2fnb.189.cn%2fpublic%2fwbWeixinCallback.do&response_type=code&scope=snsapi_base&state=http%3a%2f%2fwx.020yqn.com%2fgames%2ftucao&connect_redirect=1#wechat_redirect",
        "imgUrl" :"<?php echo site_url('assets/images/tucao/head.jpg');?>",        
        "fail": function (res) {
                alert(JSON.stringify(res));
                location.reload();
            }
	    };
wx.ready(function () {
	//分享到朋友圈
	wx.onMenuShareTimeline(wxData);
	//分享给朋友
	wx.onMenuShareAppMessage(wxData);
});
wx.error(function (res) {
  alert(res.errMsg);
  location.reload();
});
</script>
</body>
</html>