<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import SettingsList from "./Components/SettingsList.vue";
import SettingsAddSetting from "./Components/SettingsAdd.vue";
let props = defineProps({
    settings: Object,
    settingsKeys: Object,
});

let form = useForm({
    key: "",
    value: "",
    tenant: "",
});

let submit = () => {
    form.post("/settings", {
        onSuccess: () => {
            form.reset();
        },
    });
};
</script>

<template>
    <Head title="Settings"></Head>
    <SettingsList :settings="settings" />
    <SettingsAddSetting
        :submit="submit"
        :form="form"
        :settingsKeys="settingsKeys" />
</template>
