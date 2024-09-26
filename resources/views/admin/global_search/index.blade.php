
<ul class="list-group search-results" id="top_search_dropdown">
    @foreach ($datas as $data)
        <li class="dropdown-header">{{ $lable[$data['table']] ?? $data['table'] }}</li>
        @foreach ($data['data'] as $d)
            <li><a href="{{ route($all_route[$data['table']], $d->id) }}">
                    @foreach ($show_column[$data['table']] as $show)
                        {{ ((array) $d)[$show] }},
                    @endforeach
                </a></li>
        @endforeach
        <li role="separator" class="divider"></li>
    @endforeach

</ul>
