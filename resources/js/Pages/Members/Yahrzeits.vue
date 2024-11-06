<script setup>
import { getHebrewName, getParentName } from "../../Shared/utils";
let props = defineProps({
    member: Object,
});
console.log(props.member);
</script>

<template>
    <div class="mx-auto max-w-3xl">
        <div
            class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div class="mb-2 flex items-center sm:mb-0">
                <h1 class="text-3xl">Yahrzeits</h1>
            </div>
        </div>
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto lg:-mx-8">
                <div
                    class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <div
                        class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <tbody class="divide-y divide-gray-200 bg-white">
                                <tr
                                    v-for="yahrzeit in member"
                                    :key="member.id"
                                    class="flex flex-col">
                                    <td
                                        v-if="yahrzeit.father_yahrtzeit_date"
                                        class="border-r-2 p-1 sm:px-6 sm:py-4">
                                        <div
                                            class="flex flex-col justify-between sm:flex-row sm:items-center">
                                            <div
                                                class="basis-2/6 text-sm font-medium text-gray-900">
                                                {{ yahrzeit.forenames }}
                                                {{ yahrzeit.surname }}
                                            </div>
                                            <div
                                                class="basis-1/6 text-sm font-medium text-gray-900">
                                                Father
                                            </div>
                                            <div
                                                class="basis-2/6 text-wrap text-right text-sm font-light sm:font-medium">
                                                {{
                                                    getParentName(
                                                        yahrzeit,
                                                        "father",
                                                    )
                                                }}
                                            </div>
                                            <div
                                                class="basis-2/6 text-right text-sm font-light sm:font-medium">
                                                {{
                                                    yahrzeit.father_yahrtzeit_date
                                                }}
                                            </div>
                                        </div>
                                    </td>

                                    <td
                                        v-if="yahrzeit.mother_yahrtzeit_date"
                                        class="border-r-2 p-1 sm:px-6 sm:py-4">
                                        <div
                                            class="flex flex-col justify-between sm:flex-row sm:items-center">
                                            <div
                                                class="basis-2/6 text-sm font-medium text-gray-900">
                                                {{ yahrzeit.forenames }}
                                                {{ yahrzeit.surname }}
                                            </div>
                                            <div
                                                class="basis-1/6 text-sm font-medium text-gray-900">
                                                Mother
                                            </div>
                                            <div
                                                class="basis-2/6 text-wrap text-right text-sm font-light sm:font-medium">
                                                {{
                                                    getParentName(
                                                        yahrzeit,
                                                        "mother",
                                                    )
                                                }}
                                            </div>
                                            <div
                                                class="basis-2/6 text-right text-sm font-light sm:font-medium">
                                                {{
                                                    yahrzeit.mother_yahrtzeit_date
                                                }}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
