jQuery(document).ready(function () {
	$(".colorbox, .colorbox-scan").click(function(){
		$('body').css({"overflow-y": "hidden"});
	});
	$(document).on("click", "#cboxClose, #cboxOverlay", function(){ 
    	$('body').css({"overflow-y": ""});
	});

	$(".page-up").click(function() {
  		$("html, body").animate({ scrollTop: 0 }, "slow");
  		return false;
	});
});

jQuery(function(){
// 
	if($(window).width() <= '882'){

		$('.collapse-b').click(function(){
			var a = $(this);
			var	item = a.parent().parent().children('ul');

			item.toggleClass('collapse-toggle');
			return false;
		});
		$('.title-cat').click(function(){
			var a = $(this).children('a');
			var	item = a.parent().parent().children('ul');

			item.toggleClass('collapse-toggle');
			return false;
		});
	}
// 
	$('.cat-desc').css("display", "none").toggleClass('js-animate');
	$('.cat-desc-h').click(function(){
		if ($('.cat-desc').hasClass('js-animate')) {
			$(this).parent().children('div').slideDown("slow");
			$('.cat-desc').toggleClass('js-animate');
		}else{
			$(this).parent().children('div').slideUp("slow");
			$('.cat-desc').toggleClass('js-animate');
		}
	});
// 

	$('div.tabs__caption').on('click', 'div:not(.acc-active)', function() {
    $(this)
      .addClass('acc-active').siblings().removeClass('acc-active')
      .closest('div.accordion').find('div.tabs__content').removeClass('acc-active-content')
      .eq($(this).index()).addClass('acc-active-content');
  });

//
if ($("div").is('.page-product')) {
	var 
		s = "Здравствуйте, нас интересует коммерческое предложение на " + $(".page-product h1").html() + ". Спасибо.",
		t = $('.single-pr-thumbs'),
		i = 0,
		v = 3,
		tD = 0,
		sD = 350,
		slider = $('.single-pr-slides ul'),
		displayRes = 0,
		maxResPhone = false,

		prev = t.find('.nav-prev'),
		next = t.find('.nav-next'),
		p = t.find('.item-list ul'),
		l = p.find('li'),
		maxOffset = l.length - 3,
		init = function() {

			displayRes = $(window).width();
			maxResPhone = displayRes <= '750' ? true : false;

			if (maxResPhone) {
				tD = (displayRes - 10) / 3 - 5;
			}else{
				tD = 110;
			}

			l.removeClass('active');
			l.first().addClass('active');
			l.each(function(){
				$(this).css({width: tD + 'px'});
			});
			
			p.css({
				position: 'absolute',
				top: 0
			});
			slider.css({
				position: 'absolute',
				top: 0
			});			
		};

		$(".kp-text-area").val( s );

		init();

		prev.click(function() {
			if ( i < 0 ) {
				i++;
				p.css({top: i * tD + 'px' })
			}
		});
		next.click(function() {		
			if ( i > v - l.length ) {
				i--;				
				p.css({top: i * tD + 'px' })
			}
		});
		l.click(function() {
			if (maxResPhone) {
				l.removeClass('active');
				$(this).addClass('active');
				slider.css({top: -1 * $(this).index() * sD + 'px' })

				var
				offset = ( $(this).index() - 1 > 0 ) ? $(this).index() - 1 : 0;
				
				if ( offset > maxOffset )
					offset = maxOffset; 

				p.css({left: -1 * offset * tD + 'px' })
			} else{	
				l.removeClass('active');
				$(this).addClass('active');			
				slider.css({top: -1 * $(this).index() * sD + 'px' })
			}
		});

	$(window).on("resize", function(){
		setTimeout(function () {
			init();
		}, 1000);
	});
}
//
});