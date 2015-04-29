<!DOCTYPE html>
<html lang="en">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta http-equiv="expires" content="-1">
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="cache-control" content="no-cache,must-revalidate">
	<meta name="format-detection" content="telephone=no">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<title>激情暴打奇葩BOSS!上高分榜赢免费流量！</title>
<script type="text/javascript" src="<?php echo site_url('assets/js/hitboss/createjs.min.js');?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/js/hitboss/zepto.min.js');?>"></script>
<script src="<?php echo site_url('assets/js/hitboss/common.js');?>"></script>
<script src="<?php echo site_url('assets/js/hitboss/layer.m.js')?>"></script>
<link type="text/css" href="<?php echo site_url('assets/css/hitboss/common.css');?>" rel="stylesheet">
<link type="text/css" href="<?php echo site_url('assets/css/hitboss/style.css');?>" rel="stylesheet">
<link type="text/css" href="<?php echo site_url('assets/css/hitboss/layer.css?');?>" rel="stylesheet">
<script language="javascript">
	var isSubscribe = <?php echo $isSubscribe; ?>;
	var maxScore = <?php echo $maxScore; ?>;
	var shareMsg = '';
	var token = '<?php echo $token;?>';
</script>
</head>

<body>
<div id="container">
	<canvas id="canvas"></canvas>
</div>
<div style="display:none;" id="loader">
    <div class="loader">提交成绩中...</div>
</div>
<div style="display:none;" id="rankLoader">
    <div class="loader" style="width:180px;margin-left:-90px;;">获取排行榜中...</div>
</div>
<div style="display: none;">
<span id="popup_1_js">layer.open({
	title:['','height:auto'],
    style: 'border:none; background:url(<?php echo site_url('assets/images/hitboss/popupbg.jpg');?> repeat-x;-webkit-background-size: 100%; color:#fff;width:90%;padding:10px 0;overflow:hidden;',
    content:$("#popup_1").html()
})</span>
<span id="popup_2_js">layer.open({
    style: 'border:none; background:transparent;color:#fff;width:90%;',
    content:$("#popup_2").html(),
    end:function(){
    	window.location.href="http://mp.weixin.qq.com/s?__biz=MzA3NzEzNjMxNg==&mid=210110054&idx=2&sn=241ea5f2ead470dab7cbfcae3a244ee4#rd";
    }
})</span>
<span id="popup_3_js">layer.open({
	btn: [
		'确定',
		'取消'
	],
	shade:false,
	style:'background:url(<?php echo site_url('assets/images/hitboss/popupbg.jpg');?>) repeat-x;-webkit-background-size: 100%;color:#fff;width:90%;padding:10px 15px 0px 15px;',
    content:$("#popup_3").html(),
    yes:function(){
    	layer.closeAll()
    	dp_share();
    },
    end:function(){
        ajaxSaveScore(myData.score,maxScore);
        maxScore = Main.maxScore;
    	Main.endGame(myData.score);
    }
})</span>
<span id="popup_4_js">layer.open({
	title:['','height:auto'],
    style: 'border:none; background:url(<?php echo site_url('assets/images/hitboss/popupbg.jpg');?>) repeat-x;-webkit-background-size: 100%; color:#fff;width:90%;height:80%;padding:10px 0;overflow:hidden;',
    content:$("#popup_4").html()
})</span>
</div>
<!-- 游戏规则 -->
<div id="popup_1" style="display: none;">
	<div style="text-align:center;padding-bottom:15px;">
		<img src="<?php echo site_url('assets/images/hitboss/rule_head.png');?>" width="60%">
	</div>
	<div id="ruleContent" style="height:80%;padding: 0 15px;overflow-y: scroll;">
		<p style="color:red;font-weight:bold;">【游戏时间】</p>
		<p>2015年2月10日——2月28日</p>
		<p>Ps:请争取时间暴打上司，错过了就要等一万年了。</p>
		<p style="color:red;font-weight:bold;">【游戏规则】</p>
		<p>1.首先是霸王条款：请先关注流量宝微信公众号（llb21cn），然 后输入BOSS，进入游戏页面。</p>
		<p>2.点击开始游戏后，机智的你会懂的，小编就不解释了。顺便提醒 一下：你不是一个人在战斗，打得越远分数越高，就越有机会进入“全国 上司飞行排行榜“。</p>
		<p>3.最后你觉得游戏很爽快的话，请告诉小伙伴；如果你觉得游戏很 坑爹，更加需要吼出去，告诉大家不要玩这个游戏。</p>
		<p style="color:red;font-weight:bold;">【活动奖品】</p>
		<p>【2015年2月28日下午16：00截取排行榜数据,流量以牛币的形式充值到手机流量宝账号】</p>
		<p>第一名获得：500M</p>
		<p>第二名获得：300M</p>
		<p>第三名获得：100M</p>
		<p>第四名至十五名获得：50 M </p>
		<p>游戏风险：千万别让上司知道，这就是我们的游戏没有加上司惨叫声的原 因，我怕你会在工作期间爽的不能自理！</p>
	</div>
	<div style="height:20px;"></div>
</div>
<!-- 提示关注 -->
<div id="popup_2" style="display: none;">
	<div style="text-align: center">
		<img src="<?php echo site_url('assets/images/hitboss/guanzhu.png');?>" width="100%" onclick="layer.closeAll()">
	</div>
</div>
<!-- 提示分享 -->
<div id="popup_3" style="display: none;">
	<div style="padding-bottom:10px;border-bottom:1px solid #a76a00;" id="shareMsg"></div>
</div>
<!-- 游戏排行榜-->
<div id="popup_4" style="display: none;">
	<div style="text-align:center;padding-bottom:20px;">
		<img src="<?php echo site_url('assets/images/hitboss/rank_head.png');?>" width="60%">
	</div>
	<div style="padding:0 15px;height: 75%;overflow-y: scroll;">
		<table width="100%" border="0" cellpadding="1">
	        <colgroup>
	           <col width="10%">
	           <col width="70%">
	           <col width="20%">
	        </colgroup>
	        <tbody id="rankList"></tbody>
	     </table>
     </div>
	<div style="height:20px;"></div>
</div>
<script src="<?php echo site_url('assets/js/hitboss/index.js');?>"></script>
<script src="<?php echo site_url('assets/js/hitboss/fly.js');?>"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script language="javascript">
		document.getElementById("container").addEventListener('touchmove', function(e) {
        e.preventDefault();
        	return false;
   		 }, false);
		function dp_share(){
			document.getElementById("share").style.display= "block";
		}
		</script>
		<div id="share" style="display: none;" ontouchstart="document.getElementById('share').style.display='none';">
			<img src="<?php echo site_url('assets/images/hitboss/share.png');?>" width="100%">
		</div>

		<script type="text/javascript">
		var suffix=Math.floor(Math.random()*10);
	    var myData = { gameid: '2' };
		function dp_submitScore(score){
			myData.score = score;
			myData.scoreName = score+"米";
			shareMsg = "你太猛了，大力出奇迹，一下把伦家击飞"+score+"米！要不要通知一下小伙伴！";
			$("#shareMsg").html(shareMsg);
			if(score>0){
    			wxData.title = "看我把BOSS揍飞了"+score+"米！上高分榜赢免费流量！";
    			wxData.desc = "让上司飞，若再给我一次机会，我只想说，请棍上加钉子！";
				new Function(popup_3_js.innerHTML)();
			} else {
				Main.endGame(myData.score);
			}
		}
		function ajaxSaveScore(score,maxScore){
			if(score>maxScore){
			 $.ajax({
		            type: 'POST',
		            url: '<?php echo site_url('games/hitboss/saveScore');?>',
		            dataType: 'json',
		            data: {'score':score,'token':token},
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
			            		token=json.token;
		                    	$("#loader").hide();
		                	}else if(json.status=='1002'){
		                		window.location.href="<?php echo site_url('games/hitboss/regetUserInfo');?>";
			                }
		                	else{
		                		$("#loader").hide();
		                		alert(json.msg);
		                	}
		            	},500);           	
		            }, complete:function(x){
		            }
		        });
			} else {
				$("#loader").show();
    			setTimeout(function(){$("#loader").hide();},500);
			}
		}
		function getRankBoard(){
    		$("#rankLoader").show();
			setTimeout(function(){
				 $.ajax({
			            type: 'GET',
			            async: false,
			            cache: false,
			            url: '<?php echo site_url('games/hitboss/getRankBoard');?>',
			            dataType: 'json',
			            beforeSend: function (x) {
			            },
			            error: function (XMLHttpRequest, textStatus, errorThrown) {
			                alert("提交失败,请检查网络！");
			                $("#rankLoader").hide();
			            },
			            success: function (json) {
			            		$("#rankList").html(json.html);  
			            }, complete:function(x){
			            	$("#rankLoader").hide();
			            }
			        });
					new Function(popup_4_js.innerHTML)();	
				},500);
		}
		wx.config({
		    debug: false,
		    appId: '<?php echo $res['appid'];?>',
		    timestamp:'<?php echo $res['timestamp'];?>',
		    nonceStr: '<?php echo $res['noncestr'];?>',
		    signature: '<?php echo $res['sign'];?>',
		    jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage']
		});
		var wxData = {
				"title" : "激情暴打奇葩BOSS!上高分榜赢免费流量！",
				"desc" : '加班有加班费？年终有年终奖？你敢裸辞?不敢就打飞奇葩上司，发泄一下吧！',	      
		        "link" : "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx5ce0cf9472acf4b6&redirect_uri=http%3a%2f%2fnb.189.cn%2fpublic%2fwbWeixinCallback.do&response_type=code&scope=snsapi_base&state=http%3a%2f%2fwx.020yqn.com%2fgames%2fhitboss&connect_redirect=1#wechat_redirect",
		        "imgUrl" :"<?php echo site_url('assets/images/hitboss/head.jpg');?>",        
		        "fail": function (res) {
		                alert(JSON.stringify(res));
		                location.reload();
		            },
				"success": function () { 
					
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
		(function() {
			$("#ruleContent").css("max-height",$(window).height()*0.6);
		})()
		</script>
			
</body></html>