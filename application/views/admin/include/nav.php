<title>微信内容管理系统</title>
<div class="container top">
	<div class="row span12">
		<h2><i class="icon-comments-alt"></i>微信内容管理系统</h2>
	</div>
</div>
<!-- nav -->
<div class="container">
<div class="navbar">
<nav class="navbar navbar-default" role="navigation">
<!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav">
    		
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-table"></i> 数据<b class="caret"></b></a>
							<ul class="dropdown-menu">
								<?php foreach($games as $_k => $_v):?>
								<li><a href="<?php echo site_url('admin/game/index').'/'. $_v['id'];?>"><?php echo $_v['name'];?></a></li>
								<?php endforeach;?>
							</ul>
				</li>
				<?php $user =$this->session->userdata('user');?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> 你好！<?php echo $user['username'];?><b class="caret"></b></a>
					
					<ul class="dropdown-menu">
						<li><a href="<?php echo site_url('admin/home/out');?>">退出</a></li>
					</ul> 
				</li>
			</ul>
  </div><!-- /.navbar-collapse -->
</nav>
</div>
</div>

<!-- nav -->