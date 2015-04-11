$(function(){
    //把session flash自动隐藏掉
    setTimeout(function(){
        $('.am-alert').alert('close');
    }, 3000);

    $('.admin-back-btn').on('click', function(){
        history.go(-1);
        return false;
    });

    $('.admin-op-btn').on('click', function(){
       var url = $(this).attr('data-url');
        var target = $(this).attr('data-target');

        if(target == '_self'){
            window.location.href = url;
        }else if(target == '_blank'){
            window.open(url);
        }
        return false;
    });

    //绑定省份城市选择器事件
    $('#i-province-code').on('change', function(){
        var val = $(this).find("option:selected").val();
        if(val == ''){
            $("#i-city-code").empty();
            $("<option></option>").val('').text('请选择').appendTo($("#i-city-code"));
            return;
        }

        $.getJSON(BASE_URL + '/x/get-city-list', {province_code : val}, function(data){
            $("#i-city-code").empty();
            data.unshift({city_code : '', city_name : '请选择'});
            $.each(data, function(i, item) {
                $("<option></option>")
                    .val(item["city_code"])
                    .text(item["city_name"])
                    .appendTo($("#i-city-code"));
            });
        })

    });
});