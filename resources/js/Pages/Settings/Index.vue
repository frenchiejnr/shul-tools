<script setup>
import { Head } from "@inertiajs/vue3";
let props = defineProps({
    settings: Object,
    settingsKeys: Object,
});
</script>

<template>
    <Head title="Settings"></Head>
    <h1 class="text-3xl">Settings</h1>
    <ul>
        <li v-for="setting in settings" :key="setting.id">
            {{ setting.key }}: {{ setting.value }}
        </li>
    </ul>
    <select name="key" id="key">
        <option v-for="key in settingsKeys" :key="key.id" :value="key.key">
            {{ key.label }}
        </option>
    </select>
</template>
