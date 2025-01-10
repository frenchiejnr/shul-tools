<script setup>
import { Head } from "@inertiajs/vue3";
import SettingsKeyAdd from "./Components/SettingsKeyAdd.vue";
import List from "../../Shared/List.vue";
import TableRow from "../../Shared/TableRow.vue";
import Table from "../../Shared/Table.vue";
let props = defineProps({
    settingsKeys: Object,
    tenants: Object,
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
    <SettingsKeyAdd />
    <List heading="Tenants">
        <TableRow :data="tenants" url="tenants" :keys="['name', 'domain']" />
    </List>
</template>
