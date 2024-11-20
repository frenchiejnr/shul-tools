<script setup>
import { router } from "@inertiajs/vue3";
import YahrzeitTableRow from "../../Shared/YahrzeitTableRow.vue";
import { getNextYahrzeit, getParentName } from "../../Shared/utils";

let props = defineProps({
    member: Object,
});

let yarhrzeits = props.member.reduce((acc, member) => {
    if (member.father_yahrtzeit_date) {
        let newMember = { ...member };
        newMember.father_full_hebrew_name = getParentName(member, "father");
        //remove all references to mother in newMember
        delete newMember.mothers_hebrew_name;
        delete newMember.maternal_grandfather_hebrew_name;
        delete newMember.maternal_status;
        delete newMember.mother_yahrtzeit_date;
        if (member.father_yahrtzeit_date) {
            newMember.father_next_english_date = getNextYahrzeit(
                member.father_yahrtzeit_date,
            );
        }
        acc.push(newMember);
    }
    if (member.mother_yahrtzeit_date) {
        let newMember = { ...member };
        newMember.mother_full_hebrew_name = getParentName(member, "mother");
        delete newMember.fathers_hebrew_name;
        delete newMember.paternal_grandfather_hebrew_name;
        delete newMember.paternal_status;
        delete newMember.father_yahrtzeit_date;
        if (member.mother_yahrtzeit_date) {
            newMember.mother_next_english_date = getNextYahrzeit(
                member.mother_yahrtzeit_date,
            );
        }
        acc.push(newMember);
    }
    return acc;
}, []);
// sort the yahrzeits by mother or father next english date
yarhrzeits.sort((a, b) => {
    let dateA =
        a.mother_next_english_date?.date || a.father_next_english_date?.date;
    let dateB =
        b.mother_next_english_date?.date || b.father_next_english_date?.date;

    return new Date(dateA) - new Date(dateB);
});
</script>

<template>
    <div class="mx-auto max-w-3xl">
        <div
            class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div class="mb-2 flex items-center sm:mb-0">
                <h1 class="text-3xl">Yahrzeits</h1>
            </div>
            <button
                @click="
                    router.post('/members/sendYahrzeits', {
                        member: yarhrzeits,
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
                                    v-for="yahrzeit in yarhrzeits"
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
