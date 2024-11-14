<script setup>
import { Link } from "@inertiajs/vue3";
import YahrzeitTableRow from "../../Shared/YahrzeitTableRow.vue";
let props = defineProps({
    member: Object,
});
</script>

<template>
    <div class="mx-auto max-w-3xl">
        <div
            class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div class="mb-2 flex items-center sm:mb-0">
                <h1 class="text-3xl">Yahrzeits</h1>
            </div>
            <Link
                href="/members/sendYahrzeits"
                class="ml-2 text-sm text-blue-500">
                Email
            </Link>
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
                                    <YahrzeitTableRow
                                        v-if="yahrzeit.father_yahrtzeit_date"
                                        :yahrzeit="yahrzeit"
                                        parent="father" />
                                    <YahrzeitTableRow
                                        v-if="yahrzeit.mother_yahrtzeit_date"
                                        :yahrzeit="yahrzeit"
                                        parent="mother" />
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
