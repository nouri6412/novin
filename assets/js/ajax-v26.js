jQuery(document).ready(function ($) {

    //ship-to-different-address-checkbox
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
                if ($('#myform').attr('data-type') == "img") {
                    $('#plan-uploaded-img').attr('src', data.url);
                    $('#plan-uploaded-img').attr('data-state', 1);
                    $('#plan-uploaded-img').attr('data-media-id', data.file_id);
                    $('#btn-next-step').attr('href', $('#plan-uploaded-img').attr('data-href') + '&plan_selected=' + $('#plan-uploaded-img').attr('data-media-id') + '&plan_selected_type=1');
                }
                else {
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

    $('#myfilefield').change(function (e) {
        $('#myform').submit();
    });
});

function select_plan_from_gallery(obj) {
    $('#plan-uploaded-img').attr('data-state', 1);
    $('#plan-uploaded-img').attr('data-media-id', obj.attr('data-media-id'));
    $('#plan-uploaded-img').attr('src', obj.children('img').eq(0).attr('src'));
    $('#btn-next-step').attr('href', $('#plan-uploaded-img').attr('data-href') + '&plan_selected=' + $('#plan-uploaded-img').attr('data-media-id') + '&plan_selected_type=0');
}

function select_ghab_from_gallery(obj) {
    $('#ghab-uploaded-img').attr('data-state', 1);
    $('#ghab-uploaded-img-value').val(obj.attr('data-product-id'));
    $('#ghab-uploaded-img').attr('src', obj.children('img').eq(0).attr('src'));
}

function selected_plan_to_next(obj) {
    if ($('#plan-uploaded-img').attr('data-state') == 1) {
        window.location.href = obj.attr('data-href') + '&plan_selected=' + $('#plan-uploaded-img').attr('data-media-id');
    }
    else {
        alert('طرح خود را باید انتخاب نمائید');
    }
}

function plan_select_option_personal() {
    $('#div-plan-select-option').css('display', 'none');
    $('#div-plan-select').css('display', 'block');
    $('#paragraph-plan').css('display', 'none');
    $('#div-plan-select-personal').css('display', 'block');
}

function plan_select_option_common() {
    $('#div-plan-select-option').css('display', 'none');
    $('#div-plan-select').css('display', 'block');
    $('#paragraph-plan').css('display', 'none');

    $('#div-plan-select-common').css('display', 'block');
}

function select_redy_plan(obj) {
    console.log(obj.attr('data-id'));
    $('.redy-plan').css('display', 'none');
    $('.' + obj.attr('data-id')).css('display', 'block');
}

function negarenovi_order_finish() {
    var plan_id = $('#f-plan-id').val();
    var plan_type = $('#f-plan-type').val();
    var ghab_id = $('#ghab-uploaded-img-value').val();
    var size_id = $('#f-size-id').val();
    var voice_id = $('#id-voice-value').val();
    var voice_file_id = $('#file-voice-value').val();
    var site_url = $('#f-site-url').val();
    $('#btn-next-step').css('display', 'none');
    $('#btn-prev-step').css('display', 'none');
    

    if($('#id-voice-value-select').val()==0)
    {
        voice_file_id=0;
    }

    //console.log(plan_id);

    var myformData = new FormData();

    myformData.append('action', "pn_wp_frontend_ajax_order");

    myformData.append('size_id', size_id);

    myformData.append('ghab_id', ghab_id);

    myformData.append('plan_id', plan_id);
    myformData.append('plan_type', plan_type);

    myformData.append('voice_id', voice_id);

    myformData.append('file_voice_id', voice_file_id);

    // myformData.append('site_url', site_url);

    $('.negarenovin-option').each(function (i, obj) {
        if ($(obj).attr('data-type') == 'select') {
            if ($(obj).val()==1) {
                myformData.append('option-' + $(obj).attr('data-id'), $(obj).attr('data-id'));
            }
        }
        else {
            if ($(obj).val()==1) {
                myformData.append('option-' + $(obj).attr('data-id'), $(obj).attr('data-id'));
                myformData.append('option-value-' + $(obj).attr('data-id'), $('#'+$(obj).attr('id')+'-text').val());
            }
        }

    });

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
          //  window.location.href = site_url;
          $('#btn-next-step').attr('href',site_url);
          $('#btn-next-step').html('ادامه خرید');
          $('#btn-next-step').css('display', 'block');
          $('#btn-next-step-cart').css('display','block');
          $('#btn-prev-step').css('display','none');
          $('#select-ghab-panel').css('display', 'none');
          $('#head-option-title').html('تکمیل سفارش');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $('.spinner-border').css('display', 'none');
            alert('خطا دوباره امتحان فرمائید');
            console.log('fail upload');
            console.log(jqXHR);
            $('#btn-next-step').css('display', 'block');
            $('#btn-prev-step').css('display', 'block');
        }
    });
}