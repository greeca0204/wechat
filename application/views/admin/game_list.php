<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php echo $res;?>
<script src="<?php echo site_url('assets/datepicker/WdatePicker.js');?>"></script>
<script src="<?php echo site_url('assets/js/bootbox.min.js');?>"></script>
<script type="text/javascript"> 
$(document).ready(function() {
	
		$('.tooltip-demo').tooltip({selector: "a[data-toggle=tooltip]"});
		$('td a[href=#top]').click(function(){
			var a = $(this);
			var text = a.parents('tr').find('td:eq(4)').text();
			bootbox.confirm(
					'<div class=text-error style=padding-left:20px;font-size:16px;>你确定要置顶：【'+text+'】？</div>',
					function(result){
						if(result==true){
							var id = a.parents("tr").attr('id');
							$.ajax({
					            type: "POST",
					            url: "<?php echo site_url('admin/game/setTop');?>",
					            dataType:"json",
					            data:{id:id},
					            success: function(data){
						            if(data.status==0){
							            alert(data.msg);
						            }
						            if(data.status==-1){
							            alert(data.msg);
							            window.location.href="<?php echo site_url('home/login');?>";
							            return;
						            }
					                $('.form-inline').submit();
					            }
					        });
						}
					}
				)
		});
		$('td a[href=#down]').click(function(){
			var a = $(this);
			var text = a.parents('tr').find('td:eq(4)').text();
			bootbox.confirm(
					'<div class=text-error style=padding-left:20px;font-size:16px;>你确定要取消置顶：【'+text+'】？</div>',
					function(result){
						if(result==true){
							var id = a.parents("tr").attr('id');
							$.ajax({
					            type: "POST",
					            url: "<?php echo site_url('admin/game/cancleTop');?>",
					            dataType:"json",
					            data:{id:id},
					            success: function(data){
						            if(data.status==0){
							            alert(data.msg);
						            }
						            if(data.status==-1){
							            alert(data.msg);
							            window.location.href="<?php echo site_url('/home/login');?>";
							            return;
						            }
					                $('.form-inline').submit();
					            }
					        });
						}
					}
				)
		});
		$(".pager span a").click(function (){
			var page = $(this).attr('href');
			$('#curpage').val(page);
			$('.form-inline').submit();
			return false;
		});

		$("#search").click(function(){
			$('#curpage').val(0);
			$('.form-inline').submit();
		});
     });
</script>
</head>

<body>
<?php echo $nav;?>
	<div class="container">
		<div class="w_bg tooltip-demo">
			<ul class="breadcrumb">
				<li><a href="<?php echo site_url();?>">首页</a></li>
				<li><a href="javascript:;">游戏</a></li>
				<li class="active"><?php if($gameid==1)echo '举报上司';elseif($gameid==2)echo '打上司';elseif($gameid==3)echo '三八活动';elseif($gameid==4)echo '愚人节活动';?></li>
			</ul>
			<form class="form-inline" action="<?php echo site_url('admin/game/index').'/'.$gameid;?>/" method="post">
				<input type="hidden" id="curpage" name="curpage" value="<?php echo $curpage;?>"/>
				<div class="col-sm-2" style="padding: 0px;">
					<div class="form-group">
				      <input type="text" name="nickname" id="nickname" class="form-control" placeholder="微信昵称" value="<?php echo $nickname?>"> 
					</div>
				</div>
				<div class="col-sm-2" style="padding: 0px;">
					<div class="form-group">
				      <input type="text" name="fromid" id="fromid" class="form-control" placeholder="用户openid" value="<?php echo $fromid?>"> 
					</div>
				</div>
				<?php if($gameid==1){?>
				 <div class="form-group">
		            <select class="form-control" name="top" value ="<?php echo $top;?>">
						<option value="" selected>全部类型</option>
		                <option value="0" <?php if(trim($top)==0&&trim($top)!=''){ echo 'selected';}?> >普通</option>
		                <option value="1" <?php if(trim($top)==1){ echo 'selected';}?>>置顶</option>
					</select>
				</div>
				<?php }?>
				<?php if($gameid==3){?>
				 <div class="form-group">
		            <select class="form-control" name="shared" value ="<?php echo $shared;?>">
						<option value="" selected>选择是否分享</option>
		                <option value="0" <?php if(trim($shared)==0&&trim($shared)!=''){ echo 'selected';}?> >未分享</option>
		                <option value="1" <?php if(trim($shared)==1){ echo 'selected';}?>>已分享到朋友圈</option>
		                <option value="2" <?php if(trim($shared)==2){ echo 'selected';}?>>已分享给朋友</option>
					</select>
				</div>
				<?php }?>
				<?php if($gameid!=1){?>
				 <div class="form-group">
		            <select class="form-control" name="order" value ="<?php echo $order;?>">
						<option value="" selected>默认排序</option>
		                <option value="0" <?php if(trim($order)==0&&trim($order)!=''){ echo 'selected';}?> >时间升序</option>
		                <option value="1" <?php if(trim($order)==1){ echo 'selected';}?>>成绩倒序</option>
		                <option value="2" <?php if(trim($order)==2){ echo 'selected';}?>>成绩升序</option>
					</select>
				</div>
				<?php }?>
				<div class="col-sm-2" style="padding: 0px;">
					<div class="form-group">
				      <input type="text" name="sDate" id="sDate" class="form-control" placeholder="开始日期" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" value="<?php echo $sDate?>"> 
					</div>
				</div>
               	<div class="col-sm-2" style="padding: 0px;">
					<div class="form-group">
				      <input type="text" name="eDate" id="eDate" class="form-control" placeholder="结束日期" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" value="<?php echo $eDate?>"> 
					</div>
				</div>
				
				<div class="form-group">
				<button id="search" class="btn btn-primary" type="submit">搜索</button>
				</div>
				<div style="height: 5px;"></div>
				<div>总访问量：<b><?php echo $view;?></b><?php if($gameid==4):?>　总回答人次：<b><?php echo $totalCount;?></b>　总回答人数：<b><?php echo $totalMemberCount;?></b>
				　总出题人次：<b><?php echo $qnum;?></b>
				  　 总出题人数：<b><?php echo $qmnum;?></b>
				　总分享次数：<b><?php echo $shareNum;?></b>（其中分享到朋友圈 <b><?php echo $sharepyqNum;?></b>次,分享给朋友<b><?php echo $sharepyNum;?></b>次）
				<?php endif;?>
				</div>
				<div style="height: 5px;"></div>
				<table class="table table-hover table-bordered">
					<thead>
						<tr>
							<th>ID</th>
							<th>openId</th>
							<th>昵称</th>
							<th>游戏结果</th>
							<th>备注</th>
							<?php if($gameid==3){?>
							<th>是否已分享</th>
							<?php } ?>
							<?php if($gameid==4){?>
							<th>分享者昵称</th>
							<?php } ?>
							<?php if($gameid==4){?>
							<th>分享ID</th>
							<?php } ?>
							<?php if($gameid==4){?>
							<th>分享题目</th>
							<?php } ?>
							<?php if($gameid==4){?>
							<th>分享时间</th>
							<?php } ?>
							<th>创建时间</th>
							<?php if($gameid==2||$gameid==4){?>
							<th>更新时间</th>
							<?php } ?>
							<th>IP地址</th>
							<?php if($gameid==1){?>
							<th>是否置顶</th>
							<th>操作</th>
							<?php } ?>
						</tr>
					</thead>
							<?php
							if (isset ( $list )) :
								foreach ( $list as $item ) {
									
							?>
					<tbody>
						<tr  id="<?php echo $item['id'];?>">
							<td><?php echo $item['id']?></td>
							<td><?php echo $item['fromId']?></td>
							<td><?php echo $item['nickName']?> </td>
							<td><?php echo $item['score']?> </td>
							<td><?php if($gameid==4){
								$reslut_array = array(9 => '蠢萌吉祥物',10 => '人模猪脑君 ',11 => '大愚弱智团',12 => '智商终结者');
								if($item['remark'])echo $reslut_array[$item['remark']];
							}else{echo $item['remark'];}?></td>
							<?php if($gameid==3){?>
							<td><?php if($item['shared']==1){ echo "<span style='color:green;'>已分享到朋友圈</span>";}elseif($item['shared']==2){echo "<span style='color:blue;'>已分享给朋友</span>";}else{echo "<span style='color:red;'>未分享</span>";}?></td>
							<?php } ?>
							<?php if($gameid==4){?>
							<td><?php echo $item['fromUsername']?></td>
							<?php } ?>
							<?php if($gameid==4){?>
							<td><?php echo $item['shareId']?></td>
							<?php } ?>	
							<?php if($gameid==4){?>
							<td><?php echo $item['question']?></td>
							<?php } ?>	
							<?php if($gameid==4){?>
							<td><?php echo $item['dateline']?></td>
							<?php } ?>			
							<td><?php echo $item['createTime']?></td>
							<?php if($gameid==2||$gameid==4){?>
							<td><?php echo $item['updateTime']?></td>
							<?php } ?>
							<td><?php echo $item['ip']?></td>
							<?php if($gameid==1){?>
							<td><?php echo $item['top']?"<span style='color:red'>是</span>":"否";?></td>
							<td>
								<?php if($item['top']){?>
								<a href="#down" data-toggle="tooltip" data-placement="right" title="取消置顶 " ><i class="icon-reply icon-large"></i></a>
								<?php }else{?>
								<a href="#top" data-toggle="tooltip" data-placement="right" title="置顶 " ><i class="icon-thumbs-up icon-large"></i></a>
								<?php }?>
							</td>
							<?php }?>
						</tr>
					</tbody>
			 <?php }endif;?>
			<tfoot>
			<tr>
			<td <?php if($gameid==4)echo 'colspan="12"';else echo  'colspan="10"'?>>
			<?php echo $page;?>
			</td>
						</tr>
					</tfoot>
				</table>
			</form>
		</div>
	</div>
</body>
</html>
