var group = {
	loading: function() {
		document.getElementById("loading");
		
		(function() {
			for (var a = "1top.jpg 2top.jpg 3top.jpg qzr.png sbzg.png zzgyc.png 21top.jpg bg.jpg bottom1.png goahead.png guanzhu.jpg guanzhuBtn.jpg okBtn.png rank.png rank_head.png resetBtn.png scoreBg.png sec8.jpg sec9.jpg sec10.jpg sec11.jpg share.jpg shareBtn.jpg start.jpg start2.jpg".split(" "), b = 0; b < a.length; b++) 
				a[b] = "../assets/images/fool/" + a[b];
			var d =
				function(a, c) {
					var b = new Image;
					b.onload = function() {
						b.onload = null;
						c(a)
					};
					b.src = a
				},
				c = document.getElementById("loading_rate"),
				e = document.getElementById("bar"),
				f = 0;
			(function(a, b) {
				for (var c = a.length, e = 0; a.length;) d(a.shift(), function(a) {
					b(a, ++e, c)
				})
			})(a, function(a, b, d) {
				f = b / d;
				e.style.width = Math.floor(212 * f) + "px";
				c.innerHTML = Math.floor(100 * f) + "%";
				1 == f && setTimeout(function() {
					$("#loading").hide();
				}, 500)
			})
		})()
	}
}
group.loading();