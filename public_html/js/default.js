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

    $('.dropdown-block').multiselect({
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

    var openFileDialog = function(event) {
        $('.img-btn-upload').click();
    }

    $('.img-drop-zone i, .table-cell.fa').click(openFileDialog);

        function urlImgUploading () {
            $('form.img-upload').addClass('uploading');
            $('form.img-upload input:not([type="file"]), form.img-upload [type="submit"]').attr('disabled', 'disabled');
        }
        function imgUploading () {
            $(".img-progress").fadeIn(500);
            urlImgUploading () ;
        }
        function uploaded () {
          $(".uploaded-img").removeClass('img-drop-zone');
          $('form.img-upload').removeClass('uploading');
          $('form.img-upload input:not([type="file"]), form.img-upload [type="submit"]').removeAttr('disabled');
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
          $(".uploaded-img").find('.table-cell, .fa-plus').remove();
          $(".uploaded-img").addClass('img-drop-zone').append($icon_plus.clone(true,true));
          $('form.img-upload input:not([type="file"]):not([type="text"]), form.img-upload [type="submit"]').attr('disabled', 'disabled');
        }
        function imgPreview (img) {
              $(".uploaded-img").removeClass('img-drop-zone');
              $(".edit-img").removeAttr('disabled');
              $(".uploaded-img").find('.fa-plus,.table-cell').remove();
              $(".uploaded-img").append('<div class="table-cell fa fa-edit"><img src="'+img.result+'" class="img-responsive" ></div>');
              $('.table-cell.fa').click(openFileDialog);
        }
        function urlImgPreview (img) {
          $(".edit-img").removeAttr('disabled');
          $(".uploaded-img").find('.fa-plus,.table-cell').remove();
          $(".uploaded-img").append('<div id="image'+ 0 +'" class="table-cell fa fa-edit"></div>').find(".table-cell").append($(img).addClass('img-responsive'));
          $('.table-cell.fa').click(openFileDialog);
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
            /*var host = document.location.hostname;
            var local = 'http://localhost:8000';
            var root = (host === "localhost") ? local : host;*/

            $(".img-btn-upload").upload("/tempup",function  (response) {
                imgUploaded();
                if (response.state == "success")
                    {
                      $('.table-cell img').attr({
                        src: response.targetFile,
                        id: $.now()
                      });
                    }
                    else
                    {
                        imgZoneEmpty();
                        // console.log(response.msg)
                        for (var index in response.msg)
                        {
                            $('.alert-danger.up-error').html("<p>"+ response.msg[index] +"</p>");
                        }

                    };

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
              msg = "Erreur de chargement de l'image .<br> Verifiez que le chemin est correcte";
              $('.alert-danger.up-error').html(msg);
                urlImgUploaded();
                imgZoneEmpty();
              return false;
            });
            console.log(img)
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
             $('.editedImg').val(newURL);
             featherEditor.close();
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
         return launchEditor($('.table-cell img').attr('id'), $('.table-cell img').attr('src'));
     });
   }
   var keywords = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    prefetch: {
      url: window.location.origin+'/ajax/keywords',
      filter: function(list) {
        return $.map(list, function(keyword) {
          return { name: keyword }; });
      },
      cache : false
    }
  });
  keywords.initialize();
   $('[data-role="tagsinput"]').tagsinput({
      maxTags: 6,
      tagClass: 'label label-primary',
      typeaheadjs: {
        name: 'keywords',
        displayKey: 'name',
        valueKey: 'name',
        source: keywords.ttAdapter()
      }
    })

   $('[data-role="keyword-search"]').typeahead({
      hint: true,
      highlight: true,
      minLength: 1
    },
    {
      displayKey: 'name',
      name: 'name',
      source: keywords.ttAdapter()
    });

   $('.bootstrap-tagsinput input.tt-input').on('focusout', function(event) {
     event.preventDefault();
     setTimeout(function() {
      $('input.tt-input').val('');
    }, 1);
   });
   $('.brick[data-href]').click(function(event) {
     event.stopPropagation();
     // window.open($(this).attr('data-href'), '_blank');
   });

   function undo_edit_comment () {
       event.preventDefault();
       $comment = $(this).parents('.row.comment');
       $form = $comment.find('.form-control');
       // alert($.trim($form.data('text').replace(/\n/g,"<br>")) )
       content_text = $.trim($form.data('text').replace(/\n/g,"<br>").replace(/^<br\s*\/?>|<br\s*\/?>$/g,'')); // remove white space and rplace newlines to br tag and remove first and last br
       $form.replaceWith('<div class="panel-body">'+ content_text +'</div>');
       $edit_btn = $comment.find('button.update-comment');
       $edit_btn.addClass('edit-comment btn-warning').removeClass('update-comment btn-success').find('.fa-check').removeClass('fa-check').addClass('fa-edit');
       $edit_btn.click(edit_comment);
       $(this).remove();
   }
    // $('.undo-edit-comment').click(undo_edit_comment);
    function edit_comment(event) {
    event.preventDefault();
     $comment = $(this).parents('.row.comment');
     $content = $comment.find('.panel-body');
     $form = $(this).closest('form');
     $textarea = $('<textarea form="'+ $form.attr('id') +'" class="form-control " name="updateComment" id="updateComment" rows="4"></textarea>');
     $textarea.data('text', $content.text());
     $content.replaceWith($textarea.text($.trim($content.text())));
     $textarea.focus();
     $(this).removeClass('edit-comment btn-warning').addClass('update-comment btn-success').find('.fa-edit').removeClass('fa-edit').addClass('fa-check');
     $undo_btn = $('<button type="button" class="btn btn-warning undo-edit-comment"></button>').append($('<i class="fa fa-undo"> </i>'));
     $undo_btn.click(undo_edit_comment);
     $undo_btn.insertBefore($comment.find('form.delete-comment'));
     $(this).off('click');
   };

   $('.edit-comment').click(edit_comment);
   $('.img-like-btn').click(function(event) {
    var like_btn = this;
    $(like_btn).html('<i class="fa fa-refresh fa-spin"></i>');
     $.ajax({
       url: $(this).attr('data-img-like'),
       type: 'GET'
     })
     .done(function(result) {
      // console.log(result);
       if (result.state == "liked") {
          $(like_btn).html(result.count+' <i class="fa fa-heart"></i>');
       } else if(result.state == "unliked"){
          $(like_btn).html(result.count+' <i class="fa fa-heart-o"></i>');
       };
     })
     .fail(function() {
       console.log("like error file:default.js");
     })
   })

    $('.img-like-btn-text').click(function(event) {
    var like_btn = this;
    $(like_btn).html('<i class="fa fa-refresh fa-spin"></i>');
     $.ajax({
       url: $(this).attr('data-img-like'),
       type: 'GET'
     })
     .done(function(result) {
       if (result.state == "liked") {
          $(like_btn).html('<i class="fa fa-heart"></i> Enlever des favoris');
       } else if(result.state == "unliked"){
          $(like_btn).html('<i class="fa fa-heart-o"></i> Ajouter aux favoris');
       };
     })
     .fail(function() {
       console.log("like error file:default.js");
     })
    })

   $('.show-wait').click(function(event) {
     event.preventDefault();
     var wait_btn = $(this).attr('data-wait');
     $(wait_btn).fadeIn(500);
     var $disabled_a = $('<span class="text-muted disabled-a">'+$(this).html()+'</span>');
     $(this).replaceWith($disabled_a);
      $.ajax({
       url: $(this).attr('href'),
       type: 'POST'
     })
     .done(function(result) {
      console.log(result);
       if (result.state == "sent") {
          $('<p class="alert alert-success">'+result.msg+'</p>').insertAfter($disabled_a);
       } else {
          $('<p class="alert alert-warning">'+result.msg+'</p>').insertAfter($disabled_a);
       };
       $(wait_btn).fadeOut();
     })
     .fail(function() {
        $('<p class="alert alert-warning">Echec d\'envoi</p>').insertAfter($disabled_a);
        $(wait_btn).fadeOut();
       console.log("show-wait error file:default.js");
     })
   });
   /********** delete confirmation modal *********/
   $('form input[name="_method"][type="hidden"][value="DELETE"] ~ button[type="submit"]:not(\'.delete-modal-submit\')').click(function(event) {
    event.preventDefault();
    $('#delete-modal form.commit-delete').attr('action',$(this).parent('form').attr('action'));
    $('#delete-modal').modal();
   });;

   var deviceAgent = navigator.userAgent.toLowerCase();

    var isTouchDevice = Modernizr.touch ||
    (deviceAgent.match(/(iphone|ipod|ipad)/) ||
    deviceAgent.match(/(android)/)  ||
    deviceAgent.match(/(iemobile)/) ||
    deviceAgent.match(/iphone/i) ||
    deviceAgent.match(/ipad/i) ||
    deviceAgent.match(/ipod/i) ||
    deviceAgent.match(/blackberry/i) ||
    deviceAgent.match(/bada/i));

    if (isTouchDevice)
    {
        $('html').addClass('touch');
    }

    if (deviceAgent.match(/(iemobile)/))
    {
        $('html').addClass('iemobile');
    }

    $('button.picture-options-toggle').click(function(event)
    {
        // alert($('.brick:hover .hover-btns').css('bottom'));
        if ($('.brick:hover .hover-btns').css('bottom') == '0px' || $('.brick:hover .img-close').css('top') == '0px')
        {   // options hidden
            $('.brick:hover .hover-btns').css('bottom', '-30px');
            $('.brick:hover .img-close').css('top', '-30px');
            $(this).removeClass('times').addClass('bars')
        }
        else
            {   // options visible
            $('.brick:hover .hover-btns').css('bottom', '0');
            $('.brick:hover .img-close').css('top', '0');
            $(this).addClass('times').removeClass('bars')
        };
    });

    $('[data-href]').click(function(event) {
        // alert('this : ' + $(this).attr('class'))
        // alert('event.target : ' + $(event.target).attr('class'))
        if(this === (event.target || event.srcElement))
        {
            document.location.href = $(this).attr('data-href');
        }
    });

    $('[data-pic-link]').click(function(event) {
        target_modal = $(this).attr("data-target");
        $(target_modal).modal();
        $(target_modal).find('#pic-link').val($(this).attr('data-pic-link')).select();
    });

});