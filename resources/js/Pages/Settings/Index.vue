<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import Table from "../../Shared/Table.vue";
import TableRowData from "../../Shared/TableRowData.vue";
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
    <div class="mx-auto max-w-3xl">
        <div></div>
    </div>
    <Table>
        <template #heading>
            <h1 class="text-3xl">Settings</h1>
        </template>
        <template #rows>
            <tr v-for="setting in settings" :key="setting.id">
                <TableRowData>
                    <div class="text-sm font-medium text-gray-900">
                        {{ setting.key }}
                    </div>
                </TableRowData>
                <TableRowData :right-aligned="true">
                    <div class="text-sm font-medium text-gray-900">
                        {{ setting.value }}
                    </div>
                </TableRowData>
            </tr>
        </template>
    </Table>
    <Table v-if="props.settingsKeys.length">
        <template #rows>
            <TableRowData>
                <form @submit.prevent="submit" class="w-full">
                    <div class="flex justify-between">
                        <select
                            v-model="form.key"
                            name="key"
                            id="key"
                            class="mr-2 w-1/2">
                            <option value="" disabled>Select setting</option>
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
                            class="mr-2 w-1/2" />
                        <button
                            type="submit"
                            class="w-1/4 rounded bg-blue-500 px-4 py-2 text-white hover:bg-blue-600">
                            Save
                        </button>
                    </div>
                </form>
            </TableRowData>
        </template>
    </Table>
</template>
