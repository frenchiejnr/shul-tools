<script setup>
import { Head } from "@inertiajs/vue3";
import Table from "../../Shared/Table.vue";
import SettingsKeyRow from "./Components/SettingsKeyRow.vue";
import SettingsKeyAdd from "./Components/SettingsKeyAdd.vue";
let props = defineProps({
    settingsKeys: Object,
    tenants: Object,
});
</script>

<template>
    <Head title="Super Admin Settings"></Head>
    <Table>
        <template #heading>
            <h1 class="text-3xl">Super Admin Settings</h1>
        </template>
        <template #rows>
            <SettingsKeyRow
                v-for="setting in props.settingsKeys"
                :setting="setting" />
            <SettingsKeyAdd />
            <div v-for="tenant in props.tenants">
                <p class="text-3xl">Tenant: {{ tenant.name }}</p>
                <p class="text-3xl">Domain: {{ tenant.domain }}</p>
            </div>
        </template>
    </Table>
</template>
