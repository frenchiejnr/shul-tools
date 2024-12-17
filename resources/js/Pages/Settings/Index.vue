<script setup>
import { Head, useForm } from "@inertiajs/vue3";
let props = defineProps({
    settings: Object,
    settingsKeys: Object,
    can: Object,
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
    <h1 class="text-3xl">Settings</h1>
    <ul>
        <li v-for="setting in settings" :key="setting.id">
            {{ setting.key }}: {{ setting.value }}
        </li>
    </ul>
    <!-- TODO Only show if admin -->
    <form @submit.prevent="submit" v-if="can.addSetting">
        <div class="flex items-center">
            <select v-model="form.key" name="key" id="key" class="mr-2">
                <option
                    v-for="key in settingsKeys"
                    :key="key.id"
                    :value="key.key">
                    {{ key.label }}
                </option>
            </select>
            <input
                type="text"
                v-model="form.value"
                placeholder="Enter value"
                class="mr-2" />
            <button
                type="submit"
                class="rounded bg-blue-500 px-4 py-2 text-white hover:bg-blue-600">
                Save
            </button>
        </div>
    </form>
</template>
