<script setup>
import { useForm } from "@inertiajs/vue3";
import Table from "../../../Shared/Table.vue";
import TableRowData from "../../../Shared/TableRowData.vue";
import { ref } from "vue";
const isEditing = ref({});

let props = defineProps({
    settings: Object,
});

let submit = (setting) => {
    const form = useForm({
        key: setting.key,
        value: setting.value,
    });

    form.post(`/settings/${setting.id}/edit`);
};
</script>

<template>
    <Table>
        <template #heading>
            <h1 class="text-3xl">Settings</h1>
        </template>
        <template #rows>
            <tr
                v-for="setting in settings"
                :key="setting.id"
                class="flex items-center justify-between">
                <TableRowData class="basis-3/12">
                    <input class="text-sm font-medium text-gray-900" v-model="setting.key">
                </input>
                </TableRowData>
                <TableRowData class="grow">
                    <input
                        class="w-full rounded-md border-2 border-gray-300 px-2 py-1 text-sm font-medium text-gray-900"
                        v-model="setting.value"
                        :disabled="!isEditing[setting.id]"
                        @input="isEditing[setting.id] = true" />
                </TableRowData>
                <TableRowData class="" :right-aligned="true">
                    <button
                        v-if="!isEditing[setting.id]"
                        class="text-indigo-600 hover:text-indigo-900"
                        @click="isEditing[setting.id] = !isEditing[setting.id]">
                        Edit
                    </button>
                    <button
                        v-if="isEditing[setting.id]"
                        class="text-indigo-600 hover:text-indigo-900"
                        @click="submit(setting), isEditing[setting.id] = false">
                        Save
                    </button>
                    <button
                        v-if="isEditing[setting.id]"
                        class="ml-2 text-red-600 hover:text-red-900"
                        @click="isEditing[setting.id] = false">
                        Cancel
                    </button>
                </TableRowData>
            </tr>
        </template>
    </Table>
</template>
