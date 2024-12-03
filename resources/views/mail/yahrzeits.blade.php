<x-mail::layout>
    <x-mail::header logo="{{ url(Vite::asset('resources/images/candle.png')) }}" />
    <td align="center" valign="top">
        <table class="content table-content" width="100%" cellpadding="0" cellspacing="0" border="0">
            <x-mail::new-line />
            <tr>
                <td class="content__body" align="center" valign="top">
                    <table class="table table__small">
                        <thead>
                        </thead>
                        <tbody>
                            <table style="width:100%;border-collapse:collapse">
                                <thead>
                                    <tr>
                                        <th style="padding:8px;text-align:left">Name</th>
                                        <th style="padding:8px;text-align:left">Relationship</th>
                                        <th style="padding:8px;text-align:left">Hebrew Name</th>
                                        <th style="padding:8px;text-align:left">Yahrzeit Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($members as $member)
                                        @if (isset($member['father_next_english_date']['date']) || isset($member['mother_next_english_date']['date']))
                                            <tr
                                                style="font-size:0.875rem;line-height:1.25rem;font-weight: 500;border-bottom-width: 2px;border-style: solid">
                                                @if (isset($member['father_next_english_date']['date']))
                                                    <td style="padding:8px;color: #111827;font-weight: 700 ">
                                                        {{ $member['forenames'] }}
                                                        {{ $member['surname'] }}</td>
                                                    <td style="padding:8px;color: #111827">Father</td>
                                                    <td style="padding:8px">{{ $member['father_full_hebrew_name'] }}
                                                    </td>
                                                    <td style="padding:8px;text-align:right">
                                                        <p style="font-weight: 700">
                                                            {{ $member['father_yahrtzeit_date'] }}</p>
                                                        <p style="font-size:0.875rem;line-height:1.25rem;color:#9CA3AF">
                                                            {{ $member['father_next_english_date']['readableDate'] }}
                                                        </p>
                                                    </td>
                                                @endif
                                                @if (isset($member['mother_next_english_date']['date']))
                                                    <td style="padding:8px;font-weight: 700">
                                                        {{ $member['forenames'] }}
                                                        {{ $member['surname'] }}</td>
                                                    <td style="padding:8px">Mother</td>
                                                    <td style="padding:8px">{{ $member['mother_full_hebrew_name'] }}
                                                    </td>
                                                    <td style="padding:8px;text-align:right">
                                                        <p style="font-weight: 700">
                                                            {{ $member['mother_yahrtzeit_date'] }}</p>
                                                        <p style="font-size:0.875rem;line-height:1.25rem;color:#9CA3AF">
                                                            {{ $member['mother_next_english_date']['readableDate'] }}
                                                        </p>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </tbody>
                    </table>
                </td>
            </tr>
            <x-mail::new-line />
        </table>
    </td>
    </tr>
    <x-mail::footer />

</x-mail::layout>
