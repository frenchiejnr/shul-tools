<script setup lang="ts">
import TableRowData from "../../../Shared/TableRowData.vue";
import { router, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

defineProps<{
    setting: any;
}>();
const isEditing = ref({});
const originalValues = ref({});

function startEdit(setting) {
    originalValues.value[setting.id] = setting.value;
    isEditing.value[setting.id] = true;
}

function cancelEdit(setting) {
    setting.value = originalValues.value[setting.id];
    isEditing.value[setting.id] = false;
}

let submitEdit = (setting) => {
    const form = useForm({
        key: setting.key,
        value: setting.value,
    });

    form.post(`/settings/${setting.id}/edit`);
};

let deleteSetting = (setting) => {
    if (confirm("Are you sure you want to delete this setting?")) {
        router.delete(`/settings/${setting.id}/delete`);
    }
};
</script>

<template>
    <div :key="setting.id" class="flex items-center justify-between">
        <div
            class="flex flex-grow flex-col justify-between sm:flex-row sm:items-center">
            <TableRowData class="basis-3/12 self-center sm:self-start">
                <input
                    class="text-center text-sm font-medium text-gray-900 sm:text-left"
                    v-model="setting.key" />
            </TableRowData>
            <TableRowData class="grow">
                <input
                    class="w-full rounded-md border-2 border-gray-300 px-2 py-1 text-sm font-medium text-gray-900"
                    v-model="setting.value"
                    :disabled="!isEditing[setting.id]" />
            </TableRowData>
        </div>
        <TableRowData class="" :right-aligned="true">
            <div
                class="flex flex-col justify-between sm:flex-row sm:items-center">
                <button
                    v-if="!isEditing[setting.id]"
                    class="text-indigo-600 hover:text-indigo-900"
                    @click="startEdit(setting)">
                    Edit
                </button>
                <button
                    v-if="isEditing[setting.id]"
                    class="text-indigo-600 hover:text-indigo-900"
                    @click="
                        (submitEdit(setting), (isEditing[setting.id] = false))
                    ">
                    Save
                </button>
                <button
                    v-if="isEditing[setting.id]"
                    class="ml-2 text-red-600 hover:text-red-900"
                    @click="cancelEdit(setting)">
                    Cancel
                </button>
                <button
                    v-if="!isEditing[setting.id]"
                    class="ml-2 text-red-600 hover:text-red-900"
                    @click="deleteSetting(setting)">
                    Delete
                </button>
            </div>
        </TableRowData>
    </div>
</template>
