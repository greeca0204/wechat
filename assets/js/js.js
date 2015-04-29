// JavaScript Document
function jump(data){
    
	var currentId = data.id;
    
	if(currentId == 'top_one'){
		this.history.go(-1);
	}else if(currentId == 'top_two'){
        var current_url = window.location.href;
        //alert(current_url);
		var home_url = 'http://kafka.sinaapp.com/index.php?'+this.document.getElementById('wanjiaCS').value;
        //alert(home_url);
        if(current_url.slice(0,24) != "http://kafka.sinaapp.com")
			window.location.href= home_url;
            //alert(current_url.slice(0,24));
        else{
            //alert("go top");
           // window.location.href=  '#back_top';
        }
	}else if(currentId == 'top_three'){
		var cansu2 = this.document.getElementById('cansu2').value;
		var openId = 1;
		if(cansu2 == "2"){
			openId = 2;
		}
		
		window.location.href='http://wx.wanjiaclub.com/wap/index/'+openId;
	}else if(currentId == 'top_four'){
		var cansu1 = this.document.getElementById('cansu1');
		var cansu2 = this.document.getElementById('cansu2');
		var url = "http://wx.wanjiaclub.com/wap/card/"+cansu2.value+"/"+cansu1.value;
		//alert(url);
		window.location.href=url;
	}
}