<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>
    <script src="{{{asset('assets/js/jquery.min.js')}}}"></script>
    <script>
        $(function(){
            $('#follow').on('click', function(){
                var $btn = $(this);
                $.ajax({
                    url:'{{{action('FollowController@postCreateFollow')}}}',
                    method:'post',
                    type:'json',
                    data:{project_id: $btn.attr('data-project-id')},
                    success:function(data){
                        alert(data.message);

                    }
                })
            });
            $('#defollow').on('click', function(){
                var $btn = $(this);
                $.ajax({
                    url:'{{{action('FollowController@postDeleteFollow')}}}'+'/'+$btn.attr('data-follow-id'),
                    method:'post',
                    type:'json',
                    success:function(data){
                        alert(data.message);

                    }
                })
            });
        });

    </script>
</head>
<body>
    <h1>项目 {{{$project->project_name}}}</h1>
    <table>
        <tr>
            <td>项目名称</td>
            <td>{{{$project->project_name}}}</td>
        </tr>
    </table>
    <br/>
    <h1>关注</h1>
    <?php $follow = $project->follows()->where('user_id','=',Auth::id())->first() ?>
    @if($follow == null)
    <a id="follow" href="javascript:;" data-project-id="{{{$project->id}}}">关注</a>
    @else
    <a id="defollow" href="javascript:;" data-follow-id="{{{$follow->id}}}">取消关注</a>
    @endif
    <br/>
    <br/>
    <h1>投资</h1>
    <form action="{{{action('SubscriptionController@postSaveSub')}}}" method="post">
        <input type="hidden" name="project_id" value="{{{$project->id}}}">
        <input type="text" name="sub_amt" value="0">
        <button type="submit">确认</button>
    </form>

    <br/>


</body>
</html>
