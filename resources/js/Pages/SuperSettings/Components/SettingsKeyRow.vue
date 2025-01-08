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
    originalValues.value[setting.id] = {
        key: setting.key,
        label: setting.label,
    };
    isEditing.value[setting.id] = true;
}

function cancelEdit(setting) {
    setting.key = originalValues.value[setting.id].key;
    setting.label = originalValues.value[setting.id].label;
    isEditing.value[setting.id] = false;
}

let submitEdit = (setting) => {
    const form = useForm({
        key: setting.key,
        label: setting.label,
    });

    form.post(`/settingsKeys/${setting.id}/edit`);
    // form.post(`/settings/${setting.id}/edit`);
};

let deleteSetting = (setting) => {
    if (confirm("Are you sure you want to delete this setting?")) {
        console.log(setting.id);

        router.delete(`/settingsKeys/${setting.id}/delete`);
    }
};
</script>

<template>
    <div :key="setting.id" class="flex items-center justify-between">
        <div
            class="flex flex-grow flex-col justify-between sm:flex-row sm:items-center">
            <TableRowData class="self-center sm:self-start">
                <div>
                    <p class="pr-1 text-xs font-medium text-gray-400">Key:</p>
                    <input
                        class="mt-2 text-sm font-medium text-gray-900"
                        :class="
                            !isEditing[setting.id]
                                ? 'bg-white sm:text-left'
                                : 'w-full rounded-md border-2 border-gray-300 px-1'
                        "
                        v-model="setting.key"
                        :disabled="!isEditing[setting.id]" />
                </div>
            </TableRowData>
            <TableRowData class="grow self-center sm:self-start">
                <div>
                    <p class="pr-1 text-xs font-medium text-gray-400">Label:</p>
                    <input
                        class="mt-2 text-sm font-medium text-gray-900"
                        :class="
                            !isEditing[setting.id]
                                ? 'bg-white sm:text-left'
                                : 'w-full rounded-md border-2 border-gray-300 px-1'
                        "
                        v-model="setting.label"
                        :disabled="!isEditing[setting.id]" />
                </div>
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
