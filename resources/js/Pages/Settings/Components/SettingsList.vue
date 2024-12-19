<script setup>
import Table from "../../../Shared/Table.vue";
import SettingsRow from "./SettingsRow.vue";

let props = defineProps({
    settings: Object,
});
</script>

<template>
    <Table>
        <template #heading>
            <h1 class="text-3xl">Settings</h1>
        </template>
        <template #rows>
            <SettingsRow v-for="setting in settings" :setting="setting" />
        </template>
    </Table>
</template>
