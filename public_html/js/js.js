	/*****************************************flex-grid*****************************************************/
	/*var temp = "<div class='brick' style='width:{width}px;'><img src='../uploads/{index}.jpg' width='100%'></div>";
			var w = 1, h = 1, html = '', limitItem = 66;
			var width;
			for (var i = 0; i < limitItem; ++i) {
				w = 1 + 3 * Math.random() << 0;
				// var image = new Image();
				// image.src = "../uploads/"+ i +".jpg";
				// image.onload = function() {
				//      width = image.width;

				// };
				// alert(i +".jpg" + "       "+ width)
				html += temp.replace(/\{width\}/g, w*100).replace("{index}", i + 1);
			}
			$("#container").html(html);

var wall = new freewall("#container");
			wall.reset({
				selector: '.brick',
				animate: true,
				cellW: 150,
				cellH: 'auto',
				onResize: function() {
					wall.fitWidth();
				}
			});

var images = wall.container.find('.brick');
			images.find('img').load(function() {
				wall.fitWidth();
			});*/
		/*****************************************image-layout*****************************************************/
		/*var temp = "<div class='brick' style='width:{width}px; height: {height}px; background-image: url(../uploads/{index}.jpg)'></div>";
			var w = 1, html = '', limitItem = 66;
			for (var i = 0; i < limitItem; ++i) {
				w = 200 +  200 * Math.random() << 0;
				html += temp.replace(/\{height\}/g, 200).replace(/\{width\}/g, w).replace("{index}", i + 1);
			}
			$("#container").html(html);

			var wall = new freewall("#container");
			wall.reset({
				selector: '.brick',
				animate: true,

				onResize: function() {
					wall.fitWidth();
				}
			});
			wall.fitWidth();
			// for scroll bar appear;
			$(window).trigger("resize");*/



$('.brick').mousemove(function(e) {
	var bg = $(this).children(".img").css("background-image").replace("url(","").replace("url(","").slice(0,-1);
	// $(this).children(".img").children(".view-hover").css({top:e.pageY+10, left:e.pageX+10}).children("img").attr('src',bg );
	$(this).children(".img").children(".view-hover").offset({top:e.pageY+10, left:e.pageX+10}).children("img").attr('src',bg );
});

$( ".brick .hover-btns ,.brick .img-close" ).hover(function() {
	$(this).parent().parent().children(".img").children(".view-hover").css("opacity","0").addClass('img-show')
}, function() {
	$(this).parent().parent().children(".img").children(".view-hover").css("opacity","1").removeClass('img-show')
});

/********** delete confirmation modal *********/
   $('form input[name="_method"][type="hidden"][value="DELETE"] ~ button[type="submit"]').click(function(event) {
    var x = confirm("êtes vous sûre de voiloire supprimer?");
                    if (x) {
                        return true;
                    }
                    else {

                        event.preventDefault();
                        return false;
                    }
   });;