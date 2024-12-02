<div class="mx-auto max-w-3xl">
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach ($members as $member)
                                @if (isset($member['father_next_english_date']['date']) || isset($member['mother_next_english_date']['date']))
                                    <tr class="flex flex-col">
                                        <td class="border-r-2 p-1 sm:px-4 sm:py-4">
                                            <div class="flex flex-col">
                                                <div class="flex flex-col justify-between sm:flex-row sm:items-center">
                                                    @if (isset($member['father_next_english_date']['date']))
                                                        <div class="basis-2/6 text-sm font-medium text-gray-900">
                                                            <h2>{{ $member['forenames'] }} {{ $member['surname'] }}</h2>
                                                        </div>
                                                        <div class="basis-1/6 text-sm font-medium text-gray-900">
                                                            <h2>Father</h2>
                                                        </div>
                                                        <div
                                                            class="basis-2/6 text-wrap text-right text-sm font-light sm:font-medium">
                                                            {{ $member['father_full_hebrew_name'] }}
                                                        </div>
                                                        <div
                                                            class="basis-2/6 text-right text-sm font-light sm:pl-1 sm:font-medium">
                                                            <p>{{ $member['father_yahrtzeit_date'] }}</p>
                                                            <p class="sm:text-gray-400">
                                                                {{ $member['father_next_english_date']['readableDate'] }}
                                                            </p>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="flex flex-col justify-between sm:flex-row sm:items-center">
                                                    @if (isset($member['mother_next_english_date']['date']))
                                                        <div class="basis-2/6 text-sm font-medium text-gray-900">
                                                            <h2>{{ $member['forenames'] }} {{ $member['surname'] }}</h2>
                                                        </div>
                                                        <div class="basis-1/6 text-sm font-medium text-gray-900">
                                                            <h2>Mother</h2>
                                                        </div>
                                                        <div
                                                            class="basis-2/6 text-wrap text-right text-sm font-light sm:font-medium">
                                                            {{ $member['mother_full_hebrew_name'] }}
                                                        </div>
                                                        <div
                                                            class="basis-2/6 text-right text-sm font-light sm:pl-1 sm:font-medium">
                                                            <p>{{ $member['mother_yahrtzeit_date'] }}</p>
                                                            <p class="sm:text-gray-400">
                                                                {{ $member['mother_next_english_date']['readableDate'] }}
                                                            </p>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
