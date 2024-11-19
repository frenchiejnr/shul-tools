@foreach ($members as $member)
{{-- if mother or father next english date is set --}}
@if (isset($member['father_next_english_date']['date']) || isset($member['mother_next_english_date']['date']))
    <h2>{{ $member['forenames'] }} {{ $member['surname'] }}</h2>
    <ul>
        @if (isset($member['father_next_english_date']['date']))
        <h2>Father</h2>
            <li>Date: {{ $member['father_yahrtzeit_date'] }}</li>
            <li>Name: {{ $member['father_full_hebrew_name'] }}</li>
            <li>Next Yahrzeit: {{ $member['father_next_english_date']['readableDate'] }}</li>
            @endif
            @if (isset($member['mother_next_english_date']['date']))
            <h2>Mother</h2>
            <li>Date: {{ $member['mother_yahrtzeit_date'] }}</li>
            <li>Name: {{ $member['mother_full_hebrew_name'] }}</li>
            <li>Next Yahrzeit: {{ $member['mother_next_english_date']['readableDate'] }}</li>
            @endif
    </ul>
@endif
@endforeach
