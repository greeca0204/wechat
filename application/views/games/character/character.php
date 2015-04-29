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
	<title>测测你的女神指数，是否Duang倒另一半！</title>
	<link rel="shortcut icon" type="image/ico" href="<?php echo site_url('assets/images/character/niu-icon.png');?>">
	<link rel="stylesheet" href="<?php echo site_url('assets/css/character/reset.css');?>">
	<link rel="stylesheet" href="<?php echo site_url('assets/css/character/style.css');?>">
	<link rel="stylesheet" href="<?php echo site_url('assets/css/character/loading.css');?>">
	<link type="text/css" href="<?php echo site_url('assets/css/hitboss/layer.css');?>" rel="stylesheet">
	<script>
		var isSubscribe = <?php echo $isSubscribe; ?>;
		var token = '<?php echo $token;?>';
		var shared = 0;
		var path = '';
		var nowIndex = '01';
 	</script>
</head>
<body>
<div style="display:none;" id="loader">
    <div class="loader">提交中 ...</div>
</div>
<div id="loading" class="loading">
	<div class="inner">
		<p class="loading_rate" id="loading_rate">0%</p>
		<p class="loading_progress">
			<span class="bar" id="bar"></span>
		</p>
	</div>
</div>
<div id="share_mask">
    <img src="<?php echo site_url('assets/images/character/share.jpg');?>" id="share_mask_img" width="100%">
</div>
<div class="container">
	<section class="list-group active start" onclick="toggle('01')">
		<img src="<?php echo site_url('assets/images/character/body.jpg');?>" width="100%" onclick="toggle('01')">
	</section>
	<section class="list-group sec01">
		<div class="box">
			<div class="question_top">
				<img src="<?php echo site_url('assets/images/character/bg_1.jpg');?>" width="100%">
			</div>
			<h2 class="question_middle">生活中哪些特技让你无法忍受</h2>
			<div class="question_bottom buttons">
				<a href="#" class="btn" onclick="toggle('02');">duang地一下假期没了</a>
				<a href="#" class="btn" onclick="toggle('03');">duang地一下工资花光了</a>
				<a href="#" class="btn" onclick="toggle('04');">duang地一下吃成胖子了</a>
			</div>
		</div>
	</section>
	<section class="list-group sec02">
		<div class="box">
			<div class="question_top">
				<img src="<?php echo site_url('assets/images/character/bg_2.jpg');?>" width="100%">
				</div>
			<h2 class="question_middle">你一般怎么看爱情动作片？</h2>
			<div class="question_bottom buttons">
				<a href="#" class="btn" onclick="toggle('03');">自己看，万一有反应怎么办</a>
				<a href="#" class="btn" onclick="toggle('04');">和朋友看，好货不私藏</a>
				<a href="#" class="btn" onclick="toggle('05');">和恋人看，顺水推舟</a>
			</div>
		</div>
	</section>
	<section class="list-group sec03">
		<div class="box">
			<div class="question_top">
				<img src="<?php echo site_url('assets/images/character/bg_3.jpg');?>" width="100%">
			</div>
			<h2 class="question_middle">你会选择和谁看午夜场电影？</h2>
			<div class="question_bottom buttons">
				<a href="#" class="btn" onclick="toggle('04');">同性朋友，比较有安全</a>
				<a href="#" class="btn" onclick="toggle('05');">异性朋友，比较有激情</a>
			</div>
		</div>
	</section>
	<section class="list-group sec04">
		<div class="box">
			<div class="question_top">
				<img src="<?php echo site_url('assets/images/character/bg_4.jpg');?>" width="100%">
			</div>
			<h2 class="question_middle">你的胆子比你身边的很多人<br>都要大吗？</h2>
			<div class="question_bottom buttons">
				<a href="#" class="btn" onclick="toggle('05');">是的，蟑螂老鼠妖魔<br>鬼怪都不在话下</a>
				<a href="#" class="btn" onclick="toggle('06');">不是，较容易受到惊吓</a>
			</div>
		</div>
	</section>
	<section class="list-group sec05">
		<div class="box">
			<div class="question_top">
				<img src="<?php echo site_url('assets/images/character/bg_5.jpg')?>" width="100%">
			</div>
			<h2 class="question_middle">你有单方面坚持过一份感情吗？</h2>
			<div class="question_bottom buttons">
				<a href="#" class="btn" onclick="toggle('07');">有，从此听懂很多情歌，<br>间歇性矫情</a>
				<a href="#" class="btn" onclick="toggle('06');">没有，你不爱我，<br>我孤芳自赏，也自有人爱</a>
			</div>
		</div>
	</section>
		<section class="list-group sec06">
		<div class="box">
			<div class="question_top">
				<img src="<?php echo site_url('assets/images/character/bg_6.jpg');?>" width="100%">
			</div>
			<h2 class="question_middle">你更喜欢一下那种颜色搭配<br>的裙子？</h2>
			<div class="question_bottom buttons">
				<a href="#" class="btn" onclick="toggle('07');">白金，让我与土豪距离近一点</a>
				<a href="#" class="btn" onclick="toggle('08');">蓝黑，经典安全不失礼</a>
			</div>
		</div>
	</section>
		<section class="list-group sec07">
		<div class="box">
			<div class="question_top">
				<img src="<?php echo site_url('assets/images/character/bg_7.jpg');?>" width="100%">
			</div>
			<h2 class="question_middle">会和恋人当街拥吻么？</h2>
			<div class="question_bottom buttons">
				<a href="#" class="btn" onclick="toggle('08');">会的，荷尔蒙来了挡都挡不住</a>
				<a href="#" class="btn" onclick="toggle('09');">不会啦，超害羞</a>
				<a href="#" class="btn" onclick="toggle('10');">专职单身狗几十年，走开</a>
			</div>
		</div>
	</section>
		<section class="list-group sec08">
		<div class="box">
			<div class="question_top">
				<img src="<?php echo site_url('assets/images/character/bg_8.jpg');?>" width="100%">
			</div>
			<h2 class="question_middle">你觉得早早地结婚生子，<br>是不是你的路线？</h2>
			<div class="question_bottom buttons">
				<a href="#" class="btn" onclick="toggle('09');">人就该早点成家立业，有个根</a>
				<a href="#" class="btn" onclick="toggle('10');">年轻就是要自己逍遥快活</a>
			</div>
		</div>
	</section>
		<section class="list-group sec09">
		<div class="box">
			<div class="question_top">
				<img src="<?php echo site_url('assets/images/character/bg_9.jpg');?>" width="100%">
			</div>
			<h2 class="question_middle">对于那个贱萌系陈姓男艺人婚内<br>出轨，你觉得？</h2>
			<div class="question_bottom buttons">
				<a href="#" class="btn" onclick="toggle('14');">呵呵！关我P事！</a>
				<a href="#" class="btn" onclick="toggle('11');">为什么！怎么会！<br>不相信爱情了！</a>
			</div>
		</div>
	</section>
		<section class="list-group sec10">
		<div class="box">
			<div class="question_top">
				<img src="<?php echo site_url('assets/images/character/bg_10_01.jpg');?>" width="100%">
			</div>
			<h2 class="question_middle">你能包容另一半脑洞大开吗？</h2>
			<div class="question_bottom buttons">
				<a href="#" class="btn" onclick="toggle('12');">非常！完全HOLD不住！</a>
				<a href="#" class="btn" onclick="toggle('13');">还行，我不会喜欢太二逼的人</a>
				<a href="#" class="btn" onclick="toggle('15');">你们够了，都说了我是单身狗！<br>要闹哪样！</a>
			</div>
		</div>
	</section>
	<!-- 谢娜 -->
	<section class="list-group sec11">
		<div class="box">
			<img src="<?php echo site_url('assets/images/character/bg_33_01.jpg');?>" width="100%">		
			<div class="btn_share">
				<img src="<?php echo site_url('assets/images/character/shareBtn.png');?>"  onclick="share();" class="leftBtn">
				<img src="<?php echo site_url('assets/images/character/resultBtn.png');?>" onclick="toggle('16')" class="rightBtn">
			</div>
		</div>
	</section>
	<!-- 全智贤 -->
	<section class="list-group sec12">
		<div class="box">
			<img src="<?php echo site_url('assets/images/character/bg_44_01.jpg');?>" width="100%">
			<div class="btn_share">
				<img src="<?php echo site_url('assets/images/character/shareBtn.png');?>"  onclick="share();" class="leftBtn">
				<img src="<?php echo site_url('/assets/images/character/resultBtn.png');?>" onclick="toggle('17')" class="rightBtn">
			</div>
		</div>
	</section>
	<!-- 吴君如 -->
	<section class="list-group sec13">
		<div class="box">
			<img src="<?php echo site_url('assets/images/character/bg_22_01.jpg');?>" width="100%">
			<div class="btn_share">
				<img src="<?php echo site_url('assets/images/character/shareBtn.png');?>"  onclick="share();" class="leftBtn">
				<img src="<?php echo site_url('assets/images/character/resultBtn.png');?>" onclick="toggle('18')" class="rightBtn">
			</div>
		</div>
	</section>
	<!-- 小S -->
	<section class="list-group sec14">
		<div class="box">
			<img src="<?php echo site_url('assets/images/character/bg_55_01.jpg');?>" width="100%">
			<div class="btn_share">
				<img src="<?php echo site_url('assets/images/character/shareBtn.png');?>"  onclick="share();" class="leftBtn">
				<img src="<?php echo site_url('assets/images/character/resultBtn.png');?>" onclick="toggle('19')" class="rightBtn">
			</div>
		</div>
	</section>
	<!-- 林志玲 -->
	<section class="list-group sec15">
		<div class="box">
			<img src="<?php echo site_url('assets/images/character/bg_11_01.jpg');?>" width="100%">
			<div class="btn_share">
				<img src="<?php echo site_url('assets/images/character/shareBtn.png');?>"  onclick="share();" class="leftBtn">
				<img src="<?php echo site_url('assets/images/character/resultBtn.png');?>" onclick="toggle('20')" class="rightBtn">
			</div>
		</div>
	</section>
	<!-- 谢娜 -->
	<section class="list-group sec16">
		<div class="box">
			<img src="<?php echo site_url('assets/images/character/11111.jpg');?>" width="100%">
			<div class="btn_share">
				<img src="<?php echo site_url('assets/images/character/againBtn.png');?>"  onclick="reset();" class="leftBtn">
				<img src="<?php echo site_url('assets/images/character/shareResultBtn.png');?>" onclick="share();" class="rightBtn">
			</div>
		</div>
	</section>
	<!-- 全智贤 -->
	<section class="list-group sec17">
		<div class="box">
			<img src="<?php echo site_url('assets/images/character/4444.jpg');?>" width="100%">
			<div class="btn_share">
				<img src="<?php echo site_url('assets/images/character/againBtn.png');?>"  onclick="reset();" class="leftBtn">
				<img src="<?php echo site_url('assets/images/character/shareResultBtn.png');?>" onclick="share();" class="rightBtn">
			</div>
		</div>
	</section>
	<!-- 吴君如 -->
	<section class="list-group sec18">
		<div class="box">
			<img src="<?php echo site_url('assets/images/character/333.jpg');?>" width="100%">
			<div class="btn_share">
				<img src="<?php echo site_url('assets/images/character/againBtn.png');?>"  onclick="reset();" class="leftBtn">
				<img src="<?php echo site_url('assets/images/character/shareResultBtn.png');?>" onclick="share();" class="rightBtn">
			</div>
		</div>
	</section>
	<!-- 小S -->
	<section class="list-group sec19">
		<div class="box">
			<img src="<?php echo site_url('assets/images/character/2222.jpg');?>" width="100%">
			<div class="btn_share">
				<img src="<?php echo site_url('assets/images/character/againBtn.png');?>"  onclick="reset();" class="leftBtn">
				<img src="<?php echo site_url('assets/images/character/shareResultBtn.png');?>" onclick="share();" class="rightBtn">
			</div>
		</div>
	</section>
	<!-- 林志玲 -->
	<section class="list-group sec20">
		<div class="box">
			<img src="<?php echo site_url('assets/images/character/55555.jpg');?>" width="100%">
			<div class="btn_share">
				<img src="<?php echo site_url('assets/images/character/againBtn.png');?>"  onclick="reset();" class="leftBtn">
				<img src="<?php echo site_url('assets/images/character/shareResultBtn.png');?>" onclick="share();" class="rightBtn">
			</div>
		</div>
	</section>
</div>
<div style="display: none;">
<span id="popup_1_js">layer.open({
	title:['','height:auto'],
    style: 'border:none; background:url(<?php echo site_url('assets/images/character/popupbg.jpg');?> repeat-x;-webkit-background-size: 100%; color:#fff;width:90%;padding:10px 0;overflow:hidden;',
    content:$("#popup_1").html(),
    shadeClose:false
})</span>
</div>
<!-- 提示关注 -->
<div id="popup_1" style="display: none;">
	<div style="text-align: center">
		<img src="<?php echo site_url('assets/images/character/guanzhu.jpg');?>" width="100%">
		<img src="<?php echo site_url('assets/images/character/guanzhuBtn.jpg');?>" width="35%" style="position: relative;top:-50px;" onclick="goGz();">
	</div>
</div>
<script src="<?php echo site_url('assets/js/character/zepto.min.js');?>"></script>
<script src="<?php echo site_url('assets/js/character/main.js');?>"></script>
<script src="<?php echo site_url('assets/js/character/layer.m.js');?>"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript">
$(function(){
	if($(window).height()>=470){
		$(".btn_share").removeClass('btn_share');
	}
	$("#share_mask").click(function () {
	    $(this).css("display", "none");
	});
	$(".question_top,.question_middle,.question_bottom").css("-webkit-transform", "translateX(100%)");
});
function goGz(){
	window.location.href="http://mp.weixin.qq.com/s?__biz=MzA3NzEzNjMxNg==&mid=212369759&idx=1&sn=89436480c776fbf1286fa0a61a5f43ae#rd";
}
function toggle(t){
	if(t>20) return;
	if(t=='01' && isSubscribe!=1){
		new Function(popup_1_js.innerHTML)();
		return;
	}
	if(t>='16' && t<='20' && shared==0){
		alert('请先分享到朋友圈！');
		return;
	}
	path = path+t+'->';
	if(t>='11' && t<='15'){		
		path = path.substring(0,path.length-2);
		var shareTitle = '';
		switch(t){
			case '11':
				shareTitle = '闰土贤妻谢娜型';
				break;
			case '12':
				shareTitle = '女神经全智贤型';
				break;
			case '13':
				shareTitle = '大笑姑婆吴君如型';
				break;
			case '14':
				shareTitle = '百变魔女小S型';
				break;
			case '15':
				shareTitle = '自由女神林志玲型';
				break;
		}
		wxData.title='我的女神类型是“'+shareTitle+'“，你也快来测试女神指数是否Duang倒另一半吧！';
		wxData01.title = wxData.title;
		wxData02.title = wxData.title;
		saveResult();
	}
	var now =$(".start");
	var next = $(".sec"+t);
	var nextBg = next.css("background-color");
	$("body").css("background-color",nextBg);
	if(t<11){
		if(t=="01"){ 
			var next = $(".sec"+t);
			setTimeout(function() {			
				now.toX("-100%");
			}, 100);
			setTimeout(function() {
				next.find(".question_bottom").x("100%").toX("0%");
				now.toX("-100%", function() {
					now.removeClass('active');
					next.addClass('active');
					setTimeout(function() {
						next.find(".question_top").x("100%").toX("0%");
					}, 100);
					setTimeout(function() {
						next.find(".question_middle").x("100%").toX("0%");
					}, 200);
					setTimeout(function() {
						next.find(".question_bottom").x("100%").toX("0%");
					}, 300);
				});
			}, 600);
		}else{
			now =$(".sec"+nowIndex);
			setTimeout(function() {			
				now.find(".question_top").toX("-100%");
			}, 100);
			setTimeout(function() {			
				now.find(".question_middle").toX("-100%");
			}, 200);
			setTimeout(function() {			
				now.find(".question_bottom").toX("-100%");
			}, 300);
			setTimeout(function() {
				next.find(".question_bottom").x("100%").toX("0%");
				now.toX("-100%", function() {
					now.removeClass('active');
					next.addClass('active');
					setTimeout(function() {
						next.find(".question_top").x("100%").toX("0%");
					}, 100);
					setTimeout(function() {
						next.find(".question_middle").x("100%").toX("0%");
					}, 200);
					setTimeout(function() {
						next.find(".question_bottom").x("100%").toX("0%");
					}, 300);
				});
			}, 600);
		}
	}else{
		$(".container section").removeClass('active');
		$(".container .sec"+t).addClass('active');
	}
	nowIndex = t;
}
function reset(){
	$.ajax({
        type: 'POST',
        url: '<?php echo site_url('games/character/reset');?>',
        dataType: 'json',
        data: {'token':token},
        beforeSend: function (x) {
        	$("#loader").show();           	
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("请检查网络！");
            $("#loader").hide();
        },
        success: function (json) {
        	setTimeout(function(){
        		if(json.status=='1001'){
	            		token=json.token;
            	}else if(json.status=='1002'){
            		window.location.href="<?php echo site_url('games/character/regetUserInfo');?>";
	                }
            	else{
            		$("#loader").hide();
            		alert(json.msg);
            	}
        	},300);           	
        }, complete:function(x){
       	 $("#loader").hide();
        }
    });
	shared = 0;
	path = '';
	nowIndex = '01'
	$(".question_top,.question_middle,.question_bottom").css("-webkit-transform", "translateX(100%)");
	$("body").css("background-color","#ffead9");
	$(".container section").removeClass('active');
	$(".container .list-group").css('-webkit-transform',"translateX(0%)");
	$(".container .start").addClass('active');
}
function share(){
	$("#share_mask").css("display", "block");
}
function saveResult(){
	 $.ajax({
         type: 'POST',
         url: '<?php echo site_url('games/character/saveResult');?>',
         dataType: 'json',
         data: {'score':path,'shared':shared,'token':token},
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
             	}else if(json.status=='1002'){
             		window.location.href="<?php echo site_url('/games/character/regetUserInfo');?>";
	                }
             	else{
             		$("#loader").hide();
             		alert(json.msg);
             	}
         	},300);           	
         }, complete:function(x){
        	 $("#loader").hide();
         }
     });
}
function updateShareStatus(){
	$.ajax({
        type: 'POST',
        url: '<?php echo site_url('/games/character/updatShareStatus');?>',
        dataType: 'json',
        data: {'shared':shared,'token':token},
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("请检查网络！");
        },
        success: function (json) {
        	if(json.status=='1001'){
	            token=json.token;
          	}         	
        }
    });
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
		"title" : "测测你的女神指数，是否Duang倒另一半！",
		"desc" : '',	      
        "link" : "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx5ce0cf9472acf4b6&redirect_uri=http%3a%2f%2fnb.189.cn%2fpublic%2fwbWeixinCallback.do&response_type=code&scope=snsapi_base&state=http%3a%2f%2fwx.020yqn.com%2fgames%2fcharacter&connect_redirect=1#wechat_redirect",
        "imgUrl" :"<?php echo site_url('assets/images/character/200x200.jpg');?>",        
        "fail": function (res) {
                alert(JSON.stringify(res));
                location.reload();
            }
	    };
var wxData01 = {
		"title" : wxData.title,
		"desc" : wxData.desc,
		"link" : wxData.link,
		"imgUrl": wxData.imgUrl,
		"fail": wxData.fail,
		"success": function () {
			shared = 1;
			updateShareStatus()
			var resultIndex = String(Number(nowIndex)+5);
			toggle(resultIndex);
		}
};
var wxData02 = {
		"title" : wxData.title,
		"desc" : wxData.desc,
		"link" : wxData.link,
		"imgUrl": wxData.imgUrl,
		"fail": wxData.fail,
		"success": function () {
			shared = 2;
			updateShareStatus();
			var resultIndex = String(Number(nowIndex)+5);
			toggle(resultIndex);
		}
}
wx.ready(function () {
	//分享到朋友圈
	wx.onMenuShareTimeline(wxData01);
	//分享给朋友
	wx.onMenuShareAppMessage(wxData02);
});
wx.error(function (res) {
  alert(res.errMsg);
  location.reload();
});
</script>
</body>
</html>