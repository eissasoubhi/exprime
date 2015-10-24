$(document).ready(function() {
    $('.search_options').multiselect({
        enableClickableOptGroups: true,
        includeSelectAllOption: true,
        selectAllText: 'Tous',
        dropRight: true,
        buttonText: function(options, select) {
            if (options.length === 0) {
            	$('.search_options option').each(function () {
            		$(".search_options").multiselect('select', $(this).val());
            	})
            }
        }
    });
    $('.search input[type="text"], .hidden-search input[type="text"]').keypress(function(event) {
       $('.search input[type="text"], .hidden-search input[type="text"]').val($(this).val()) 
    });

    $('.dropdown').multiselect({
        buttonWidth: '100%'
    });
    $('.dropdown-filter').multiselect({
        buttonWidth: '100%',
         enableFiltering: true,
         enableCaseInsensitiveFiltering : true
    });

    $('.select2').select2({
     maximumSelectionLength: 5 ,
      language: "fr",
      debug : true
    });

    $('.img-drop-zone i').click(function(event) {
        $('.img-btn-upload').click();
    });

    if (typeof(Aviary) !== "undefined") {
     var featherEditor = new Aviary.Feather({
           apiKey: '1eaf6fa9fd812257',
           apiVersion: 3,
           theme: 'minimum', // Check out our new 'light' and 'dark' themes!
           // tools: 'all',
           tools: ['crop','resize','orientation','text','blemish'],
           language : "fr",
           appendTo: '',
           onSave: function(imageID, newURL) {
               var img = document.getElementById(imageID);
               img.src = newURL;
           },
           onError: function(errorObj) {
               alert(errorObj.message);
           }
       });
       function launchEditor(id, src) {
           featherEditor.launch({
               image: id,
               url: src
           });
          return false;
       }
       $('.edit-img').click(function(event) {
        
           return launchEditor('image1', 'http://images.aviary.com/imagesv5/feather_default.jpg');
       });
     }

        function urlImgUploading () {
            $('form.img-upload').addClass('uploading');
            $('form.img-upload input, form.img-upload [type="submit"]').attr('disabled', 'disabled');
        }
        function imgUploading () {
            $(".img-progress").fadeIn(500);
            urlImgUploading () ;
        }
        function uploaded () {  
          $(".uploaded-img").removeClass('img-drop-zone');
          $('form.img-upload').removeClass('uploading');
          $('form.img-upload input, form.img-upload [type="submit"]').removeAttr('disabled');
        }
        function urlImgUploaded () {
            uploaded();
            $('.img-btn-upload').val('');            
        }
        function imgUploaded () {
            $(".img-progress").fadeOut(500);
            $('.url-img-load').val('');
            uploaded();
        }
        function imgZoneEmpty () {
          $('form.img-upload').removeClass('uploading');
          if (!$(".uploaded-img").hasClass('img-drop-zone')) {
            $(".uploaded-img").addClass('img-drop-zone').append($icon_plus.clone(true,true)).find('.table-cell').remove();
          };
        }
        function imgPreview (img) {
              $(".uploaded-img").removeClass('img-drop-zone');
              $(".edit-img").removeAttr('disabled');
              $(".uploaded-img").find('.fa-plus,.table-cell').remove();
              $(".uploaded-img").append('<div class="table-cell"><img src="'+img.result+'" class="img-responsive" ></div>');
        }
        function urlImgPreview (img) {
          $(".edit-img").removeAttr('disabled');
          $(".uploaded-img").find('.fa-plus,.table-cell').remove();
          $(".uploaded-img").append('<div id="image'+ 0 +'" class="table-cell"></div>').find(".table-cell").append($(img).addClass('img-responsive'));
        }
        function getImageUrl (file) {
            if (/^image/.test( file.type)){ 
                var reader = new FileReader(); 
                reader.readAsDataURL(file);
                reader.onloadend = function(){ 
                  imgPreview(this);
                }
            }
        }
        $(".img-btn-upload").on("change", function()
        {
            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader) return; 
            var file = this.files[0];
            var size = file.size;
            var type = file.type;
            var name = file.name;
            var msg="";
            var invalid_file = true;
            if (size > 1048576) {
              msg += "Poids max de l'image est 1Mo<br>";
              invalid_file = false;
            };
            var ext = type.replace('image/','').toLowerCase();
            if($.inArray(ext, ['png','jpg','jpeg']) == -1) {
                msg += "Les types valides sont : png, jpg et jpeg<br>";
               invalid_file = false;
            }

            if (!invalid_file) {
            $('.alert-danger.up-error').html(msg);
              return false;
            }
            $('.alert-danger.up-error').html("");
            $('.img-name').html(name);

            getImageUrl(file);
            imgUploading();
            $(".img-btn-upload").upload("tempup",function  (success) {
              imgUploaded();
            },function  (progress, value) {
                $(".img-progress .progress-bar").attr('aria-valuenow', value).css('width', value+"%").text(value+"%");
            })
        });

        var img, msg = "";
        $icon_plus = $('.img-drop-zone .fa-plus').clone(true, true);
        $('.url-img-load').change(function () {
            $('.alert-danger.up-error').html("");
            $('.img-name').html("");
            $url_input = $(this);
            if ($url_input.val() == "") {
               imgZoneEmpty();
               return false;
            };
              // validation
            msg = "";
            img = new Image();
            urlImgUploading();
            $(img).load(function(){              
              urlImgUploaded();
              urlImgPreview(this)

            }).attr("src",$url_input.val()).error(function(){
              msg = "Erreur de chargement de l'image<br>";
              $('.alert-danger.up-error').html(msg);
                // urlImgUploaded();
                imgZoneEmpty();
              return false;
            });
        });
       wow = new WOW(
      {
        offset: 10
      }
    )
    wow.init();

$('.show-overly').closest("form").submit(function(event) {
            $("#overly").fadeIn(300);
          });

function getBgImgPath(bg) {
    return bg.replace(/^(url\(['"]?)/i,"").replace(/['"]?\)$/i,"");
}
$('.brick').mousemove(function(e) {
    var bg = $(this).children(".img").css("background-image");
    $(this).children(".img").children(".view-hover").offset({top:e.pageY+10, left:e.pageX+10}).children("img").attr('src',getBgImgPath(bg) );
});

$( ".brick .hover-btns ,.brick .img-close" ).hover(function() {
    $(this).parent().parent().children(".img").children(".view-hover").css("opacity","0").addClass('img-show')
}, function() {
    $(this).parent().parent().children(".img").children(".view-hover").css("opacity","1").removeClass('img-show')
});
    if (typeof(Aviary) !== "undefined") {
         var featherEditor = new Aviary.Feather({
         apiKey: '1eaf6fa9fd812257',
         apiVersion: 3,
         theme: 'minimum', // Check out our new 'light' and 'dark' themes!
         // tools: 'all',
         tools: ['crop','resize','orientation','text','blemish'],
         language : "fr",
         appendTo: '',
         onSave: function(imageID, newURL) {
             var img = document.getElementById(imageID);
             img.src = newURL;
         },
         onError: function(errorObj) {
             alert(errorObj.message);
         }
     });
     function launchEditor(id, src) {
         featherEditor.launch({
             image: id,
             url: src
         });
        return false;
     }
     $('.edit-img').click(function(event) {
        var id = Math.random();
        console.log('image1'+id)
         return launchEditor('image1'+id, 'http://images.aviary.com/imagesv5/feather_default.jpg');
     });
   }
   var cities = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    prefetch: {
      url: 'https://timschlechter.github.io/bootstrap-tagsinput/examples/assets/citynames.json',
      filter: function(list) {
        return $.map(list, function(cityname) {
          return { name: cityname }; });
      }
    }
  });
  cities.initialize();
   $('[data-role="tagsinput"]').tagsinput({
      maxTags: 5,
      tagClass: 'label label-primary',
      typeaheadjs: {
        name: 'citynames',
        displayKey: 'name',
        valueKey: 'name',
        source: cities.ttAdapter()
      }
    })
   $('input.tt-input').on('focusout', function(event) {
     event.preventDefault();
     setTimeout(function() {
      $('input.tt-input').val('');
    }, 1);
   });
});