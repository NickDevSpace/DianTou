<ul class="am-pagination am-pagination-centered">

    <?php
        if($paginator->getLastPage() > 1){
            echo with(new AmazePresenter($paginator))->render();
        }
     ?>
</ul>
