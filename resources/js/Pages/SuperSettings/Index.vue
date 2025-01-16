<script setup>
import { Head } from "@inertiajs/vue3";
import List from "../../Shared/List.vue";
import TableRow from "../../Shared/TableRow.vue";
import Table from "../../Shared/Table.vue";
import TableAdd from "../../Shared/TableAdd.vue";
import MakeAdminUsers from "./MakeAdminUsers.vue";
let props = defineProps({
    settingsKeys: Object,
    tenants: Object,
    users: Object,
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
    <MakeAdminUsers :tenants="tenants" :users="users" />
</template>
