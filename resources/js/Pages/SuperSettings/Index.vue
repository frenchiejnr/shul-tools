<script setup>
import { Head } from "@inertiajs/vue3";
import Table from "../../Shared/Table.vue";
import SettingsKeyRow from "./Components/SettingsKeyRow.vue";
let props = defineProps({
    settingsKeys: Object,
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
        </template>
    </Table>
</template>
