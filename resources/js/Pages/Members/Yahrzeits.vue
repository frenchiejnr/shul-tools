<script setup>
import { router } from "@inertiajs/vue3";
import YahrzeitTableRow from "../../Shared/YahrzeitTableRow.vue";
import {
    getNextYahrzeit,
    getParentName,
    isWithinXDays,
    sortByNextYahrzeit,
} from "../../Shared/utils";
import { ref, watch } from "vue";

let props = defineProps({
    member: Object,
});

let yahrzeits = ref([]);
let yahrzeitDays = ref(7);

let filteredYahrzeits = props.member.flatMap((member) => {
    const getYahrzeit = (parent) => {
        if (!member[`${parent}_yahrtzeit_date`]) return null;
        return {
            ...member,
            [`${parent}_full_hebrew_name`]: getParentName(member, parent),
            [`${parent}_next_english_date`]: getNextYahrzeit(
                member[`${parent}_yahrtzeit_date`],
            ),
        };
    };

    return [getYahrzeit("father"), getYahrzeit("mother")].filter(Boolean);
});

watch(
    yahrzeitDays,
    (newYahrzeitDays) => {
        yahrzeits = filteredYahrzeits.filter((yahrzeit) => {
            return (
                isWithinXDays(
                    yahrzeit.father_next_english_date?.date,
                    newYahrzeitDays,
                ) ||
                isWithinXDays(
                    yahrzeit.mother_next_english_date?.date,
                    newYahrzeitDays,
                )
            );
        });
        yahrzeits.sort(sortByNextYahrzeit);
    },
    {
        immediate: true,
    },
);
</script>

<template>
    <div class="mx-auto max-w-3xl">
        <div
            class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div class="mb-2 flex items-center sm:mb-0">
                <h1 class="text-3xl">Yahrzeits</h1>
            </div>
            <div class="flex items-center">
                <label for="yahrzeitDays" class="mr-2 text-sm">
                    Yahrzeits in next
                </label>
                <input
                    v-model.number="yahrzeitDays"
                    type="text"
                    placeholder="search..."
                    class="w-16 border border-gray-400 p-1" />
                <span class="ml-2 text-sm">Days</span>
            </div>
            <button
                @click="
                    router.post('/members/sendYahrzeits', {
                        member: yahrzeits,
                    })
                "
                class="ml-2 text-sm text-blue-500 hover:text-blue-700">
                Email
            </button>
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
                                    v-for="yahrzeit in yahrzeits"
                                    :key="yahrzeit.id"
                                    class="flex flex-col border-none">
                                    <YahrzeitTableRow
                                        v-if="
                                            yahrzeit.father_next_english_date &&
                                            yahrzeit.father_next_english_date
                                                .date
                                        "
                                        :yahrzeit="yahrzeit"
                                        parent="father" />
                                    <YahrzeitTableRow
                                        v-if="
                                            yahrzeit.mother_next_english_date &&
                                            yahrzeit.mother_next_english_date
                                                .date
                                        "
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
