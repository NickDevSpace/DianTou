$(function(){
    //把session flash自动隐藏掉
    setTimeout(function(){
        $('.am-alert').alert('close');
    }, 3000);

    $('.admin-back-btn').on('click', function(){
        history.go(-1);
        return false;
    });
});