@foreach ($notifications as $item)
    <li>
        <div class="media">
            <div class="media-body">
                <h5> <a class="f-14 m-0" href="{{ $item->data['link'] }}">{{ $item->data['title'] }}</a></h5>
                <p>{{ \Illuminate\Support\Str::limit($item->data['body'], 32, $end = '...') }}</p>
                <span>{{ dateTimeFormat($item->created_at) }}</span>
            </div>
        </div>
    </li>
@endforeach
