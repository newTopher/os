setInterval(function(){
	$('.arr').css({'webkitTransform':'translateY(-10px)'});
		$('.gift').css({'webkitTransform':'rotate(-30deg)'});
				setTimeout(function(){
					$('.arr').css({'webkitTransform':'translateY(10px)'});
					$('.gift').css({'webkitTransform':'rotate(30deg)'});
				},200)
},400);

$(document).ready(function(){	
		var to = $('.word .to').text();
		var	say = $('.word .say').text();
		var	from = $('.word .from').text();
		$('.word .to').text('');
		$('.word .say').text('');
		$('.word .from').text('');
		function appword(str,time,dom,callback){
			var i = 0,
				len = str.length;
			function go(){
				setTimeout(function(){
					if(i > len) return;
					dom.append(str[i]);
					i++;
					go();
				},time)
			}
			go();
			setTimeout(function(){
				callback();
			},len*time+500)
		}
		var t = 200;
		appword(to,t,$('.word .to'),function(){
			appword(say,t,$('.word .say'),function(){
				appword(from,t,$('.word .from'),function(){});
			})
		});
				
});	
	
function send(){
	$('.weiba-layer-sharehelper').show();		
}	
function sendh(){	
    $('.weiba-layer-sharehelper').hide();	
}  