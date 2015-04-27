<div class="comment-create-wrapper am-g">
    <textarea style="height:150px;width: 100%;resize:none;"  id="comment-content"></textarea>
    <button id="comment-btn" type="button" class="am-btn am-btn-success" style="margin-top:10px;float:right">发表回复</button>
</div>
<div class="comment-list">
    @foreach ($comments as $c)
    <article class="am-comment" style="margin-top:10px"> <!-- 评论容器 -->
        <a href="">
            <img class="am-comment-avatar" alt="" src="http://s0.meituan.net/www/img/user-avatar.v9bfc4a71.png"/>
        </a>

        <div class="am-comment-main"> <!-- 评论内容容器 -->
            <header class="am-comment-hd">
                <!--<h3 class="am-comment-title">评论标题</h3>-->
                <div class="am-comment-meta"> <!-- 评论元数据 -->
                    <a href="#link-to-user" class="am-comment-author">{{{$c->user->nickname}}}</a> <!-- 评论者 -->
                    评论于 <time datetime="">{{{$c->created_at}}}</time>
                </div>
            </header>

            <div class="am-comment-bd">{{{$c->content}}}</div>
        </div>
    </article>
    @endforeach
    <?php echo $comments->links(); ?>
</div>