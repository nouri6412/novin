jQuery(document).ready(function ($) {
    console.log('hi jquery');
    var myForm = $('#myform');

    $(myForm).submit(function (e) {
        //Prevent normal form submission
        e.preventDefault();
        $('.spinner-border').css('display', 'block');
        //Get the form data and store in a variable
        var myformData = new FormData(myForm[0]);

        //Add our own action to the data
        //action is where we will be hooking our php function
        myformData.append('action', 'pn_wp_frontend_ajax_upload');

        //Prepare and send the call
        $.ajax({
            type: "POST",
            data: myformData,
            dataType: "json",
            url: custom_theme_mbm_object.ajaxurl,
            cache: false,
            processData: false,
            contentType: false,
            enctype: 'multipart/form-data',
            success: function (data, textStatus, jqXHR) {
                console.log('success upload');
                console.log(data);
                $('#plan-uploaded').val(data.file_id);
                $('.spinner-border').css('display', 'none');
                if($('#myform').attr('data-type')=="img")
                {
                    $('#plan-uploaded-img').attr('src', data.url);
                    $('#plan-uploaded-img').attr('data-state', 1);
                    $('#plan-uploaded-img').attr('data-media-id',data.file_id);
                }
                else
                {
                    $('#file-voice').attr('href', data.url);
                    $('#file-voice').html("دانلود فایل آپلود شده");
                    $('#file-voice-value').val(data.file_id);
                }

            },
            error: function (jqXHR, textStatus, errorThrown) {
                //if fails     
                $('.spinner-border').css('display', 'none');
                alert('خطا دوباره امتحان فرمائید');
                console.log('fail upload');
                console.log(jqXHR);
            }
        });
    });
});

function select_plan_from_gallery(obj) {
    $('#plan-uploaded-img').attr('data-state', 1);
    $('#plan-uploaded-img').attr('data-media-id',obj.attr('data-media-id'));
    $('#plan-uploaded-img').attr('src', obj.children('img').eq(0).attr('src'));
}

function select_ghab_from_gallery(obj) {
    $('#ghab-uploaded-img').attr('data-state', 1);
    $('#ghab-uploaded-img-value').val(obj.attr('data-product-id'));
    $('#ghab-uploaded-img').attr('src', obj.children('img').eq(0).attr('src'));
}

function selected_plan_to_next(obj) {
    if ($('#plan-uploaded-img').attr('data-state') == 1) {
        window.location.href = obj.attr('data-href')+'&plan_selected='+$('#plan-uploaded-img').attr('data-media-id');
    }
    else {
        alert('طرح خود را باید انتخاب نمائید');
    }
}

function  negarenovi_order_finish()
{
    var plan_id=$('#f-pnal-id').val();
    var ghab_id=$('#ghab-uploaded-img-value').val();
    var size_id=$('#f-size-id').val();
    var voice_id=$('#file-voice-value').val();
    var site_url=$('#f-site-url').val();
  var options=  $('.negarenovin-option');

  var i=0;
  for(i=0;i<options.length;i++)
  {
console.log(options[i].attr('data-id')+' '+options[i].attr('type'));
  }
}