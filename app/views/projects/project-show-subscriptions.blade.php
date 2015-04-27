<table class="am-table am-table-striped">
    <thead>
    <tr>
        <th>投资人</th>
        <th>投资金额</th>
        <th>投资股份</th>
        <th>时间</th>
    </tr>
    </thead>
    <tbody>
        @foreach($subs as $sub)
        <tr>
            <td>{{{$sub->user['nickname']}}}</td>
            <td>{{{$sub->sub_amt}}}</td>
            <td>{{{$sub->sub_share}}}%</td>
            <td>{{{$sub->created_at}}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<?php echo $subs->links(); ?>
