<script setup>
import { Link, Head, router } from "@inertiajs/vue3";
import Pagination from "@/Shared/Pagination.vue";
import { ref, watch } from "vue";
import debounce from "lodash/debounce";
let props = defineProps({
    members: Object,
    filters: Object,
    can: Object,
});

let search = ref(props.filters.search);

watch(
    search,
    debounce((value) => {
        router.get(
            "/members",
            { search: value },
            { replace: true, preserveState: true },
        );
    }, 500),
);

function getHebrewName(member, parent) {
    const prefix = member.gender === "male" ? "ben" : "bas";
    const status =
        member.paternal_status === "yisrael"
            ? ""
            : `Ha${member.paternal_status}`;

    return `${member.hebrew_name} ${prefix} ${
        parent === "father"
            ? `${member.fathers_hebrew_name} ${status}`
            : member.mothers_hebrew_name
    }`;
}
</script>

<template>
    <Head title="Members"></Head>
    <div class="mb-6 flex justify-between">
        <div class="flex items-center">
            <h1 class="text-3xl">Members</h1>
            <Link
                v-if="can.createMember"
                href="/members/create"
                class="ml-2 text-sm text-blue-500">
                New Member
            </Link>
        </div>
        <input
            type="text"
            placeholder="search..."
            class="rounded-lg border px-2"
            v-model="search" />
    </div>

    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div
                class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <tbody class="divide-y divide-gray-200 bg-white">
                            <tr v-for="member in members.data" :key="member.id">
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div
                                        class="flex items-center justify-between">
                                        <div
                                            class="text-sm font-medium text-gray-900">
                                            {{ member.forenames }}
                                            {{ member.surname }}
                                        </div>
                                        <div class="text-right">
                                            <div
                                                class="text-sm font-medium text-gray-900">
                                                {{
                                                    getHebrewName(
                                                        member,
                                                        "father",
                                                    )
                                                }}
                                            </div>
                                            <div
                                                class="text-sm font-medium text-gray-400">
                                                {{
                                                    getHebrewName(
                                                        member,
                                                        "mother",
                                                    )
                                                }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td
                                    v-if="member.can.edit"
                                    class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                    <Link
                                        :href="`/members/${member.id}/edit`"
                                        class="text-indigo-600 hover:text-indigo-900">
                                        Edit
                                    </Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Paginator -->
    <Pagination :links="members.links" class="mt-6" />
</template>
