<h2>How are you</h2>


@foreach($user as $id => $u)
    <h3>{{ $id }} {{$u['name']}} | {{ $u['phone'] }} | {{ $u['city'] }}</h3>
@endforeach


