<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import List from "../../Shared/List.vue";
import TableRow from "../../Shared/TableRow.vue";
import Table from "../../Shared/Table.vue";
import TableAdd from "../../Shared/TableAdd.vue";
import { ref, watch } from "vue";
let props = defineProps({
    settingsKeys: Object,
    tenants: Object,
    users: Object,
});

const form = useForm({
    tenant: "",
    user: "",
    admin: "",
});
</script>

<template>
    <Head title="Super Admin Settings"></Head>

    <Table>
        <template #heading>
            <h1 class="text-4xl">Super Admin Settings</h1>
        </template>
    </Table>

    <List heading="Settings Keys">
        <TableRow
            :data="settingsKeys"
            url="settingsKeys"
            :keys="['key', 'label']" />
    </List>
    <TableAdd :fields="['key', 'label']" endpoint="settingsKeys" />
    <List heading="Tenants">
        <TableRow :data="tenants" url="tenants" :keys="['name', 'domain']" />
    </List>
    <TableAdd :fields="['name', 'domain']" endpoint="tenants" />

    <Table>
        <template #heading>
            <h1 class="text-3xl">Admin Users</h1>
        </template>
    </Table>
    <form @submit.prevent="form.post(`/users/${form.user}/makeAdmin`)">
        <select v-model="form.tenant">
            <option value="" disabled>Select tenant</option>
            <option
                v-for="tenant in tenants"
                :key="tenant.id"
                :value="tenant.id">
                {{ tenant.name }}
            </option>
        </select>
        <select v-model="form.user">
            <option value="" disabled>Select user</option>
            <option
                v-for="user in users.filter(
                    (user) => user.tenant_id === form.tenant,
                )"
                :key="user.id"
                :value="user.id">
                {{ user.name }}
            </option>
        </select>
        <button
            v-if="form.tenant && form.user"
            type="submit"
            class="w-1/4 rounded bg-blue-500 px-4 py-2 text-white hover:bg-blue-600"
            @click="
                form.admin = !users.find((user) => user.id === form.user).admin
            ">
            {{
                users.find((user) => user.id === form.user).admin
                    ? "Remove admin"
                    : "Make admin"
            }}
        </button>
    </form>
</template>
