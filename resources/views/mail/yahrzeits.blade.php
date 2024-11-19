@foreach ($members as $member)
    <h2>{{ $member['forenames'] }} {{ $member['surname'] }}</h2>
    <ul>
        @if (isset($member['father_yahrtzeit_date']))
            <li>Father: {{ $member['father_yahrtzeit_date'] }}</li>
        @endif
        @if (isset($member['mother_yahrtzeit_date']))
            <li>Mother: {{ $member['mother_yahrtzeit_date'] }}</li>
        @endif
    </ul>
@endforeach
