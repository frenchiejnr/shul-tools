<script setup>
import { Link, Head, router } from "@inertiajs/vue3";
import Pagination from "@/Shared/Pagination.vue";
import { ref, watch } from "vue";
import debounce from "lodash/debounce";
let props = defineProps({
    users: Object,
    filters: Object,
    can: Object,
});

let search = ref(props.filters.search);

watch(
    search,
    debounce((value) => {
        router.get(
            "/users",
            { search: value },
            { replace: true, preserveState: true },
        );
    }, 500),
);
</script>

<template>
    <Head title="Users"></Head>
    <div class="mx-auto max-w-3xl">
        <div class="mb-6 flex justify-between">
            <div class="flex items-center">
                <h1 class="text-3xl">Users</h1>
                <Link
                    v-if="can.createUser"
                    href="/users/create"
                    class="ml-2 text-sm text-blue-500">
                    New User
                </Link>
            </div>
            <input
                type="text"
                placeholder="search..."
                class="rounded-lg border px-2"
                v-model="search" />
        </div>

        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto lg:-mx-8">
                <div
                    class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <div
                        class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <tbody class="divide-y divide-gray-200 bg-white">
                                <tr v-for="user in users.data" :key="user.id">
                                    <td
                                        class="whitespace-nowrap px-1 py-4 sm:px-6">
                                        <div class="flex items-center">
                                            <div
                                                class="text-sm font-medium text-gray-900">
                                                {{ user.name }}
                                            </div>
                                        </div>
                                    </td>
                                    <td
                                        v-if="user.can.edit"
                                        class="whitespace-nowrap px-1 py-4 text-right text-sm font-medium sm:px-6">
                                        <Link
                                            href="`/users/${user.id}/edit`"
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
        <Pagination :links="users.links" class="mt-6" />
    </div>
</template>
