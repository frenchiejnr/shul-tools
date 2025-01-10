<script setup>
import { Head } from "@inertiajs/vue3";
import SettingsKeyRow from "./Components/SettingsKeyRow.vue";
import SettingsKeyAdd from "./Components/SettingsKeyAdd.vue";
import List from "../../Shared/List.vue";
import TableRow from "../../Shared/TableRow.vue";
let props = defineProps({
    settingsKeys: Object,
    tenants: Object,
});
</script>

<template>
    <Head title="Super Admin Settings"></Head>
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
