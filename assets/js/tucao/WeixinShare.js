WeixinApi.ready(function(Api) {
    var wxData = {
        "appId": "", 
        "imgUrl" : GAME_IMG_RESULT+"?timer="+ _timer,
        "link" : "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx5ce0cf9472acf4b6&redirect_uri=http%3a%2f%2fnb.189.cn%2fpublic%2fwbWeixinCallback.do&response_type=code&scope=snsapi_base&state=http%3a%2f%2f42.121.145.203%2fgames%2ftucao&connect_redirect=1#wechat_redirect",
        //"desc" : '上司虐我千百遍，我待上司如初恋。今天面子我可以给，但是槽一定要吐！',
        "desc" : '上司虐我千百遍，我待上司如初恋。',
        "title" : "你行你来BIBI，奇葩上司等你吐槽！"
    };
    var wxCallbacks = {
        favorite : false,
        async:true,
        ready : function() {
            this.dataLoaded({
            	desc : '上司虐我千百遍，我待上司如初恋。'+GAME_RESULT,
                imgUrl : GAME_IMG_RESULT+"?timer="+ _timer
            });
        },
        cancel : function(resp) {
        },
        fail : function(resp) {
        },
        confirm : function(resp) {
        },
        all : function(resp,shareTo) {
        }
    };

    Api.shareToFriend(wxData, wxCallbacks);
    Api.shareToTimeline(wxData, wxCallbacks);
    Api.shareToWeibo(wxData, wxCallbacks);
    Api.generalShare(wxData,wxCallbacks);
});
