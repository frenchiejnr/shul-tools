<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import TableRowData from "../../Shared/TableRowData.vue";
import Table from "../../Shared/Table.vue";
defineProps<{
    tenants: Record<string, any> | undefined;
    users: Record<string, any> | undefined;
}>();
let tenant = ref("");
const form = useForm({
    user: "",
    admin: "",
});
</script>

<template>
    <Table>
        <template #rows>
            <TableRowData>
                <form
                    @submit.prevent="form.post(`/users/${form.user}/makeAdmin`)"
                    class="w-full">
                    <div class="flex justify-between">
                        <div
                            class="flex basis-10/12 flex-col justify-between sm:flex-row">
                            <select v-model="tenant" class="mr-2 sm:w-1/2">
                                <option value="" disabled>Select tenant</option>
                                <option
                                    v-for="tenant in tenants"
                                    :key="tenant.id"
                                    :value="tenant.id">
                                    {{ tenant.name }}
                                </option>
                            </select>
                            <select v-model="form.user" class="mr-2 sm:w-1/2">
                                <option value="" disabled>Select user</option>
                                <option
                                    v-for="user in users.filter(
                                        (user) => user.tenant_id === tenant,
                                    )"
                                    :key="user.id"
                                    :value="user.id">
                                    {{ user.name }}
                                </option>
                            </select>
                        </div>
                        <button
                            type="submit"
                            class="w-1/4 text-wrap rounded bg-blue-500 px-4 py-2 text-white hover:bg-blue-600"
                            :class="{
                                'cursor-not-allowed opacity-50':
                                    !tenant || !form.user,
                            }"
                            :disabled="!tenant || !form.user"
                            @click="
                                form.admin = !users.find(
                                    (user) => user.id === form.user,
                                ).admin
                            ">
                            {{
                                users.find((user) => user.id === form?.user)
                                    ?.admin
                                    ? "Remove admin"
                                    : "Make admin"
                            }}
                        </button>
                    </div>
                </form>
            </TableRowData>
        </template>
    </Table>
</template>
