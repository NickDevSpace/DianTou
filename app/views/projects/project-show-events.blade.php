<div class="event-head">
    <span class="event-head-icon am-icon-signal am-icon-sm" style="color:#9fd35b"></span>
    这里记录了发起人为梦想努力的一些成果，快来看看吧~
</div>
<ul class="event-list">
    @foreach($events as $event)
    <li>
        <span class="event-time">{{{$event->event_date}}}</span>
        <span class="event-icon"></span>
        <p>{{{$event->event_desc}}}</p>
        <hr>
    </li>
    @endforeach
</ul>