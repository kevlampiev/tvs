<div>
    @forelse(auth()->user()->unreadNotifications as $el)
        <div class="note-block">
            <strong> От пользователя {{$el->data['sender']??"Anonymous "}} {{\Carbon\Carbon::parse($el->created_at)->format('d.m.Y h:m')}} </strong>
            <br>
            <a href="{{$el->data['link']}}"> {{$el->data['subject']}}</a>
        </div>

    @empty
        нет событий
    @endforelse
{{--    @forelse($notes as $index=>$el)--}}
{{--        <div class="note-block">--}}
{{--            <p>--}}
{{--                <strong>{{$el->user->name}} {{\Carbon\Carbon::parse($el->created_at)->format('d.m.Y h:m')}} </strong>--}}
{{--                <br>--}}
{{--                @if($el->vehicle)--}}
{{--                    по единице техники {{$el->vehicle->name}}<br>--}}
{{--                @endif--}}
{{--                @if($el->agreement)--}}
{{--                    по договору {{$el->agreement->name}} № {{$el->agreement->agr_number}} от--}}
{{--                    {{\Carbon\Carbon::parse($el->agreement->date_open)->format('d.m.Y')}}--}}
{{--                    <br>--}}
{{--                @endif--}}

{{--                    <i>{{$el->note_body}}</i>--}}
{{--            </p>--}}
{{--        </div>--}}

{{--    @empty--}}
{{--        нет событий--}}
{{--    @endforelse--}}

</div>
