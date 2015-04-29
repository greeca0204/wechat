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
	<title><?php if($game_model)echo '轻松“耍”盆友';else echo '我不为人知的秘密，你造吗？'; ?></title>
	<link rel="shortcut icon" type="image/ico" href="<?php echo site_url('assets/images/fool/niu-icon.png');?>">
	<link rel="stylesheet" href="<?php echo site_url('assets/css/fool/reset.css');?>">
	<link rel="stylesheet" href="<?php echo site_url('assets/css/fool/style.css');?>">
	<link rel="stylesheet" href="<?php echo site_url('assets/css/fool/loading.css');?>">
	<script>
		var isSubscribe = <?php echo $isSubscribe; ?>;
		var token = '<?php echo $token;?>';
		var selected_ids = '';
		var now = '';
		var result = '';
		var defaultTitle = '轻松“耍”盆友"';
		var sharedId = 0;
		var status = 0;
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
    <img src="<?php echo site_url('assets/images/fool/share.jpg');?>" id="share_mask_img" width="100%">
</div>
<div class="container" id="model1"<?php if(!$game_model){?> style="display:none;"<?php }?>>
	<section class="list-group sec0 active start">
		<div class="start_bottom" onclick="toggle(1)">
			<P class="twinkling">点击开始</P>
			<p>Powered by @eramus</p>
		</div>
	</section>
	<section class="list-group sec1 secBg">
		<div class="top">
			<img src="<?php echo site_url('assets/images/fool/1top.jpg');?>" width="100%">
		</div>
		<div class="middle">
			<div class="content_wrap">
				<div class="content">
					<table border="0" cellspacing="0" cellpadding="0">
					<?php foreach ($question as $_k => $_v):?>
						<tr>
							<td align="center" width="10"><input type="checkbox" name="question" value="<?php echo $_k;?>" id="qu_<?php echo $_k; ?>"></td>						
							<td><label for="qu_<?php echo $_k;?>"><?php echo $_k.'、'?><?php echo $_v;?></label></td>
						</tr>				
					<?php endforeach;?>
					</table>
				</div>
			</div>
		</div>
		<div class="bottom">
		  <div class="btn">
				<img src="<?php echo site_url('assets/images/fool/okBtn.png');?>" width="35%" id="okBtn">
				<img src="<?php echo site_url('assets/images/fool/sbzg.png');?>" width="35%" id="whoTrickyedBtn" style="padding: 5px 0;">
			</div>
		</div>
	</section>
	<section class="list-group sec2 secBg">
		<div class="top">
			<img src="<?php echo site_url('assets/images/fool/2top.jpg');?>" width="100%">
		</div>
		<div class="middle">
			<div class="content_wrap">
				<div class="content" id="selected_qus"></div>
			</div>
		</div>
		<div class="bottom" style="background: none;">
			<div class="btn">
		   		<img src="<?php echo site_url('assets/images/fool/qzr.png');?>" width="35%" id="shareBtn" style="padding: 5px 0;">
		   		<img src="<?php echo site_url('assets/images/fool/resetBtn.png');?>" width="35%" id="resetBtn" style="padding: 5px 0;">
		   </div>
		</div>
	</section>
	<section class="list-group sec3">
		<div class="bottom" style="background: none;">
			<div class="btn">
		   		<img src="<?php echo site_url('assets/images/fool/zzgyc.png');?>" width="35%" id="againTrickyBtn" style="padding: 5px 0;">
		         <img src="<?php echo site_url('assets/images/fool/sbzg.png');?>" width="35%" id="whoTrickyedBtn2" style="padding: 5px 0;">
		   </div>
		</div>
	</section>
</div>
<script src="<?php echo site_url('assets/js/fool/zepto.min.js');?>"></script>
<script src="<?php echo site_url('assets/js/fool/main.js');?>"></script>
<script src="<?php echo site_url('assets/js/fool/layer.m.js');?>"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<?php if(!$game_model){?>
<div class="container" id="model0">
	<section class="list-group active start2">
		<div class="start_bottom" onclick="toggle(4)">
			<P class="twinkling">点击开始</P>
			<p>Powered by @eramus</p>
		</div>
	</section>
<?php if(isset($qu_ids)):?>
	<?php $i=1; $index=4?>
	<?php foreach ($qu_ids as $_v):?>
	<section class="list-group sec<?php echo $index;?> secBg question">
		<div class="top">
			<img src="<?php echo site_url('assets/images/fool/21top.jpg');?>" width="100%">
		</div>
		<div class="middle">
			<div class="text">共<?php echo $i;?>/5题</div>
			<div class="content_wrap">
				<div class="content">
    				<table border="0" cellspacing="0" cellpadding="0">		
    						<tr><td colspan="2"><?php echo $i.'.'.$question[$_v];?></td></tr>
    						<?php foreach ($question_item[$_v] as $_k => $_v2):?>
    							<tr><td><input type="radio" name="qu_<?php echo $_v;?>" value="<?php echo $_k;?>" id="<?php echo $_v.'_'.$_k;?>" data-next="<?php echo $index+1 > 8 ? 'r' : $index+1;?>" <?php if(isset($correct[$_v][$_k])) echo $correct[$_v][$_k];else echo ' data-true=0';?>></td>
    							<td><label for="<?php echo $_v.'_'.$_k;?>"><?php echo $_k.'.'.$_v2;?></label></td></tr>
    						<?php endforeach;?>
    						<?php $i++;$index++;?>
    				</table>
				</div>
			</div>
		</div>
		<div class="bottom"></div>
	</section>
	<?php endforeach;?>
<?php endif;?>
<!-- 测试结果开始 -->
<!-- 蠢萌吉祥物 -->
<section class="list-group sec9 secBg result">
	<div class="top">
		<img src="<?php echo site_url('assets/images/fool/sec8.jpg');?>" width="100%">
	</div>
	<div class="middle">
		<div class="score"></div>
		<div class="content_wrap" style="padding:10px 0;">
			<div class="content">	
				<?php if(isset($qu_ids)):?>
					<?php $i=1;?>
					<?php foreach ($qu_ids as $_v):?>
							<p><?php echo $i.'.'.$question[$_v];?></p>
							<?php foreach ($question_item[$_v] as $_k => $_v2):?>
								<P><?php echo $_k.'.'.$_v2;?></p>
							<?php endforeach;?>
							<?php $i++;?>
							<p>答案：<?php echo $question_answer[$_v]['key'].'.'.$question_answer[$_v]['value'];?></p>
						<?php endforeach;?>
				<?php endif;?>
			</div>
		</div>
	</div>
	<div class="bottom">
		<div class="btn">
		   	<img src="<?php echo site_url('assets/images/fool/goahead.png');?>" width="35%" style="padding: 5px 0;" class="goahead">
		   	<img src="<?php echo site_url('assets/images/fool/rank.png');?>" width="35%" style="padding: 5px 0;" class="rank">
		 </div>
	</div>
</section>
<!-- 人模猪脑君 -->
<section class="list-group sec10 secBg result">
	<div class="top">
		<img src="<?php echo site_url('assets/images/fool/sec9.jpg');?>" width="100%">
	</div>
	<div class="middle">
		<div class="score"></div>
		<div class="content_wrap" style="padding:10px 0;">
			<div class="content">	
				<?php if(isset($qu_ids)):?>
					<?php $i=1;?>
					<?php foreach ($qu_ids as $_v):?>
							<p><?php echo $i.'.'.$question[$_v];?></p>
							<?php foreach ($question_item[$_v] as $_k => $_v2):?>
								<P><?php echo $_k.'.'.$_v2;?></p>
							<?php endforeach;?>
							<?php $i++;?>
							<p>答案：<?php echo $question_answer[$_v]['key'].'.'.$question_answer[$_v]['value'];?></p>
						<?php endforeach;?>
				<?php endif;?>
			</div>
		</div>
	</div>
	<div class="bottom">
		<div class="btn">
		   	<img src="<?php echo site_url('assets/images/fool/goahead.png');?>" width="35%" style="padding: 5px 0;" class="goahead">
		   	<img src="<?php echo site_url('assets/images/fool/rank.png');?>" width="35%" style="padding: 5px 0;" class="rank">
		 </div>
	</div>
</section>
<!-- 大愚弱智团 -->
<section class="list-group sec11 secBg result">
	<div class="top">
		<img src="<?php echo site_url('assets/images/fool/sec10.jpg');?>" width="100%">
	</div>
	<div class="middle">
		<div class="score"></div>
		<div class="content_wrap" style="padding:10px 0;">
			<div class="content">	
				<?php if(isset($qu_ids)):?>
					<?php $i=1;?>
					<?php foreach ($qu_ids as $_v):?>
							<p><?php echo $i.'.'.$question[$_v];?></p>
							<?php foreach ($question_item[$_v] as $_k => $_v2):?>
								<P><?php echo $_k.'.'.$_v2;?></p>
							<?php endforeach;?>
							<?php $i++;?>
							<p>答案：<?php echo $question_answer[$_v]['key'].'.'.$question_answer[$_v]['value'];?></p>
						<?php endforeach;?>
				<?php endif;?>
			</div>
		</div>
	</div>
	<div class="bottom">
		<div class="btn">
		   	<img src="<?php echo site_url('assets/images/fool/goahead.png');?>" width="35%" style="padding: 5px 0;" class="goahead">
		   	<img src="<?php echo site_url('assets/images/fool/rank.png');?>" width="35%" style="padding: 5px 0;" class="rank">
		 </div>
	</div>
</section>
<!-- 智商终结者 -->
<section class="list-group sec12 secBg result">
	<div class="top">
		<img src="<?php echo site_url('assets/images/fool/sec11.jpg');?>" width="100%">
	</div>
	<div class="middle">
		<div class="score"></div>
		<div class="content_wrap" style="padding:10px 0;">
			<div class="content">	
				<?php if(isset($qu_ids)):?>
					<?php $i=1;?>
					<?php foreach ($qu_ids as $_v):?>
							<p><?php echo $i.'.'.$question[$_v];?></p>
							<?php foreach ($question_item[$_v] as $_k => $_v2):?>
								<P><?php echo $_k.'.'.$_v2;?></p>
							<?php endforeach;?>
							<?php $i++;?>
							<p>答案：<?php echo $question_answer[$_v]['key'].'.'.$question_answer[$_v]['value'];?></p>
						<?php endforeach;?>
				<?php endif;?>
			</div>
		</div>
	</div>
	<div class="bottom">
		<div class="btn">
		   	<img src="<?php echo site_url('assets/images/fool/goahead.png');?>" width="35%" style="padding: 5px 0;" class="goahead">
		   	<img src="<?php echo site_url('assets/images/fool/rank.png');?>" width="35%" style="padding: 5px 0;" class="rank">
		 </div>
	</div>
</section>
<!-- 测试结果结束 -->
</div>
<script type="text/javascript">
var score = 0;
$(function(){
	var m2s3th = $(window).width()/640*375;
	var m2s3bh = $(window).width()/640*172;
	var m2s10th = $(window).width()/640*475;
	var scoreW = $(window).width()/640*331;
	var scoreH = $(window).width()/640*51;
	$(".score").css({width:scoreW,height:scoreH,"line-height":scoreH+'px'})
	$(".score").css("background-image","url(<?php echo site_url('assets/images/fool/scoreBg.png');?>)");
	$(".score").css("background-size","cover");
	$("#model0 .bottom").css("height",m2s3bh);
	$("#model0 .question .middle").css({top:m2s3th,bottom:m2s3bh,height:$(window).height()-m2s3th-m2s3bh});
	$("#model0 .result .middle").css({top:m2s10th,bottom:m2s3bh,height:$(window).height()-m2s10th-m2s3bh});
	$("#model0 .content input[type=radio]").change(function(){
		if($(this).attr("data-true")==1)score = score+20;
		toggle($(this).attr("data-next"));
	});
	$(".goahead").click(function(){
		$("#model0").hide();
		$(".start").addClass("active");
		$("#model1").show();
	});
	$(".rank").click(function(){
		getRankBoard(0);
	});
});
</script>
<?php }?>
<div style="display: none;">
<span id="popup_1_js">layer.open({
	title:['','height:auto'],
    style: 'background: transparent;border:none; color:#fff;width:90%;padding:10px 0;overflow:hidden;',
    content:$("#popup_1").html(),
    shadeClose:false
})</span>
<span id="popup_2_js">layer.open({
	title:['','height:auto'],
    style: 'border:none; background:#121238; color:#fff;width:80%;height:80%;padding:10px 0;overflow:hidden;',
    content:$("#popup_2").html()
})</span>
</div>

<!-- 提示关注 -->
<div id="popup_1" style="display: none;">
	<div style="text-align: center">
		<img src="<?php echo site_url('assets/images/fool/guanzhu.jpg');?>" width="100%">
		<img src="<?php echo site_url('assets/images/fool/guanzhuBtn.jpg');?>" width="35%" style="position: relative;top:-50px;" onclick="goGz();">
	</div>
</div>
<!-- 排行榜-->
<div id="popup_2" style="display: none;">
	<div style="text-align:center;padding-bottom:20px;">
		<img src="<?php echo site_url('assets/images/fool/rank_head.png');?>" width="100%">
	</div>
	<div style="padding:0 15px;height: 75%;overflow-y: scroll;">
		<table width="100%" border="0" cellpadding="1">
	        <colgroup>
	           <col width="10%">
	           <col width="35%">
	           <col width="20%">
	           <col width="35%">
	        </colgroup>
	        <tbody id="rankList"></tbody>
	     </table>
     </div>
	<div style="height:20px;"></div>
</div>
<script type="text/javascript">
$(function(){
	var m1s1bh = $(window).width()/640*172;//底部高度
	var m1s1th = $(window).width()/640*235;//sec1顶部高度
	var m1s2th = $(window).width()/640*356;//sec2顶部高度
	var m1s2bh = $(window).width()/640*240;//sec2底部高度
	var m1s3th = $(window).width()/640*375;
	var m1s3bh = $(window).width()/640*200;//sec3底部高度
	$("#model1 .bottom").css("height",m1s1bh);
	$("#model1 .sec1 .middle").css({top:m1s1th,bottom:m1s1bh,height:$(window).height()-m1s1th-m1s2bh});
	$("#model1 .sec1 .bottom").css("height",m1s2bh);
	$("#model1 .sec2 .middle").css({top:m1s2th,bottom:m1s2bh,height:$(window).height()-m1s2th-m1s2bh});
	$("#model1 .sec2 .bottom").css("height",m1s2bh);
	$("#model1 .sec3 .bottom").css("height",m1s3bh);
	$("#model1 .sec3 .middle").css({top:m1s3th,bottom:m1s2bh,height:$(window).height()-m1s3th-m1s3bh});
	 $("#model1 .content td input[type=checkbox]").change(function() {
		 if($("#model1 .content td").find("input[type=checkbox]:checked").length>5){
				alert("最多只能选5道题哦！");
				$(this).prop("checked", false);
		 }		 
	 });
	var q_array = new Array();
	var id = '';
	$("#okBtn").click(function(){
		if($("#model1 .content td").find("input[type=checkbox]:checked").length==5){
			$("#model1 .content td").find("input[type=checkbox]:checked").each(function(){
				   id = $(this).val();
				   selected_ids += id+'_';
			});
			selected_ids = selected_ids.substring(0,selected_ids.length-1);
			saveShareInfo();
			toggle(2);
		}else{
			alert('请选择5道题！');
			return;
		}
	});
	$("#shareBtn").click(function(){
		$("#share_mask").css("display", "block");
	});
	$("#share_mask").click(function () {
	    $(this).css("display", "none");
	});
	$("#resetBtn").click(function(){//回去纠结
		$(".content td input[type=checkbox]").prop("checked", false);
		now = 1;
		selected_ids = '';
		result = '';
		document.title = defaultTitle; 
		wxData1.title = wxDefaultData.title;
		wxData1.desc = wxDefaultData.desc;
		wxData2.title = wxData1.title;
		wxData2.desc = wxData2.desc
		toggle(1);
	});
	$("#againTrickyBtn").click(function(){//再整一次
		$(".content td input[type=checkbox]").prop("checked", false);
		now = '';
		selected_ids = '';
		result = '';
		wxData1.title = wxDefaultData.title;
		wxData1.desc = wxDefaultData.desc;
		wxData2.title = wxData1.title;
		wxData2.desc = wxData1.desc;
		toggle(0);
	});
	$("#whoTrickyedBtn,#whoTrickyedBtn2").click(function(){//谁被我整过
		getRankBoard(1);
	});
});
function goGz(){
	window.location.href="http://mp.weixin.qq.com/s?__biz=MzA3NzEzNjMxNg==&mid=214301154&idx=2&sn=0a1e150a1f94f39a0da01de9fd941374#rd";
}
function toggle(t){
	if(t==1 && isSubscribe!=1){
		new Function(popup_1_js.innerHTML)();
		return;
	}
	<?php if(!$game_model){?>
	if(t=='r'){
		var str = [9,10,11,12];
		var random = Math.floor(Math.random()*str.length);
		result = str[random];
		$(".score").text('得分：'+score+'分');
		ajaxSaveScore(score);
		toggle(result);
		return;
	}
	<?php }?>
	if(t==2){
		document.title = '我不为人知的秘密，你造吗？'; 
		wxData1.title = document.title;
		wxData1.desc = '自己人才能拿满分的题目';
		wxData2.title = wxData1.title;
		wxData2.desc = wxData1.desc;
	}	
	now = t;
	$(".container section").removeClass('active');
	$(".container .sec"+t).addClass('active');
}
function saveShareInfo(){
	 $.ajax({
         type: 'POST',
         url: '<?php echo site_url('games/fool/saveShareInfo');?>',
         dataType: 'json',
         data: {'question':selected_ids,'token':token},
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
             		sharedId = json.shareId;
             		$("#selected_qus").html(json.html);
             		wxData1.link = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx5ce0cf9472acf4b6&redirect_uri=http%3a%2f%2fnb.189.cn%2fpublic%2fwbWeixinCallback.do&response_type=code&scope=snsapi_base&state=http%3a%2f%2fwx.020yqn.com%2fgames%2ffool?shareId="+json.shareId+"&connect_redirect=1#wechat_redirect";
             		wxData2.link = wxData1.link;
                 	}else if(json.status=='1002'){
             		window.location.href="<?php echo site_url('games/fool/regetUserInfo');?>";
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
function ajaxSaveScore(score){
	 $.ajax({
            type: 'POST',
            url: '<?php echo site_url('games/fool/saveScore');?>',
            dataType: 'json',
            data: {'score':score,'shareId':<?php echo $shareId;?>,'result':result,'token':token},
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
                		window.location.href="<?php echo site_url('games/fool/regetUserInfo');?>";
	                }
                	else{
                		$("#loader").hide();
                		alert(json.msg);
                	}
            	},300);           	
            }, complete:function(x){
            }
        });
}
function getRankBoard(model){
	 $.ajax({
            type: 'GET',
            async: false,
            cache: false,
            data: {'shareId':'<?php echo $shareId;?>','model':model},
            url: '<?php echo site_url('games/fool/getRankBoard');?>',
            dataType: 'json',
            beforeSend: function (x) {
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert("提交失败,请检查网络！");
            },
            success: function (json) {
            		$("#rankList").html(json.html);  
            }, complete:function(x){
            }
        });
		new Function(popup_2_js.innerHTML)();	
}
function updateShareData(){
	$.ajax({
        type: 'POST',
        url: '<?php echo site_url('games/fool/updateShareData');?>',
        dataType: 'json',
        data: {'token':token,'sharedId':sharedId,'status':status},
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
var wxDefaultData = {"title":"轻松“耍”盆友","desc" : '愚人娱己，出题整蛊TA们！',"link":
	"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx5ce0cf9472acf4b6&redirect_uri=http%3a%2f%2fnb.189.cn%2fpublic%2fwbWeixinCallback.do&response_type=code&scope=snsapi_base&state=http%3a%2f%2fwx.020yqn.com%2fgames%2ffool&connect_redirect=1#wechat_redirect",
	"imgUrl":"<?php echo site_url('assets/images/fool/head.jpg');?>",
    "fail": function (res) {alert(JSON.stringify(res));location.reload();}
	}
var wxData1 = {
		"title" : wxDefaultData.title,
		"desc" :  wxDefaultData.desc,	      
        "link" :  wxDefaultData.link,
        "imgUrl" :wxDefaultData.imgUrl,        
        "fail":   wxDefaultData.fail,
    	"success": function () {
        	if(now==2) toggle(3);
        	status = 1;
        	updateShareData();
    		}
	    };
var wxData2 = {
		"title" : wxDefaultData.title,
		"desc" :  wxDefaultData.desc,	      
        "link" :  wxDefaultData.link,
        "imgUrl" :wxDefaultData.imgUrl,        
        "fail":   wxDefaultData.fail,
    	"success": function () {
        	if(now==2) toggle(3);
        	status = 2;
        	updateShareData();
    		}
	    };
wx.ready(function () {
	//分享到朋友圈
	wx.onMenuShareTimeline(wxData1);
	//分享给朋友
	wx.onMenuShareAppMessage(wxData2);
});
wx.error(function (res) {
  alert(res.errMsg);
  location.reload();
});
</script>
</body>
</html>