<script setup>
import { Link, Head, router } from "@inertiajs/vue3";
import Pagination from "@/Shared/Pagination.vue";
import { ref, watch } from "vue";
import debounce from "lodash/debounce";
let props = defineProps({
    members: Object,
    filters: Object,
    can: Object,
    sort: String,
    direction: String,
});

const direction = ref("asc");
const selectedSort = ref("member_id");

const sort = (column) => {
    router.get(
        "/members",
        {
            sort: column,
            direction: direction.value,
        },
        { replace: true, preserveState: true }
    );
};
let search = ref(props.filters.search);

watch(
    search,
    debounce((value) => {
        router.get(
            "/members",
            { search: value },
            { replace: true, preserveState: true }
        );
    }, 500)
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
    <div class="mx-auto max-w-3xl">
        <div
            class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div class="mb-2 flex items-center sm:mb-0">
                <h1 class="text-3xl">Members</h1>
                <Link
                    v-if="can.createMember"
                    href="/members/create"
                    class="ml-2 text-sm text-blue-500">
                    New Member
                </Link>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center">
                <input
                    type="text"
                    placeholder="search..."
                    class="mb-2 w-full rounded-lg border px-2 sm:mb-0 sm:mr-2 sm:w-auto"
                    v-model="search" />
                <div class="flex justify-end sm:ml-auto">
                    <select
                        v-model="selectedSort"
                        @change="sort(selectedSort)"
                        class="mr-2 rounded-lg border px-2">
                        <option value="member_id">ID</option>
                        <option value="forenames">First Name</option>
                        <option value="surname">Surname</option>
                        <option value="hebrew_name">Hebrew Name</option>
                    </select>
                    <select
                        v-model="direction"
                        @change="sort(selectedSort)"
                        class="rounded-lg border px-2">
                        <option value="asc">A-Z</option>
                        <option value="desc">Z-A</option>
                    </select>
                </div>
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
                                    v-for="member in members.data"
                                    :key="member.id">
                                    <td
                                        class="whitespace-nowrap border-r-2 p-1 sm:px-6 sm:py-4">
                                        <div
                                            class="flex flex-col justify-between sm:flex-row sm:items-center">
                                            <div
                                                class="text-sm font-medium text-gray-900">
                                                {{ member.forenames }}
                                                {{ member.surname }}
                                            </div>
                                            <div
                                                class="text-right text-sm font-light sm:font-medium">
                                                <div class="text-gray-900">
                                                    {{
                                                        getHebrewName(
                                                            member,
                                                            "father"
                                                        )
                                                    }}
                                                </div>
                                                <div class="text-gray-400">
                                                    {{
                                                        getHebrewName(
                                                            member,
                                                            "mother"
                                                        )
                                                    }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td
                                        v-if="member.can.edit"
                                        class="whitespace-nowrap px-1 py-4 text-center text-sm font-medium sm:px-6">
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
    </div>
</template>
