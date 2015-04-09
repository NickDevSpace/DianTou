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
});