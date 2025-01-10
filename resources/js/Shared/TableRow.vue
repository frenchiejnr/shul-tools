<script setup lang="ts">
import TableRowData from "./TableRowData.vue";
import { router, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps<{
    data: any;
    url: string;
    keys: string[];
}>();

const isEditing = ref({});
const originalValues = ref({});

function startEdit(item) {
    originalValues.value[item.id] = { ...item };
    isEditing.value[item.id] = true;
}

function cancelEdit(item) {
    Object.keys(originalValues.value[item.id] || {}).forEach((key) => {
        item[key] = originalValues.value[item.id][key];
    });
    isEditing.value[item.id] = false;
}

let submitEdit = (item) => {
    const form = useForm(
        props.keys.reduce((acc, key) => {
            acc[key] = item[key];
            return acc;
        }, {}),
    );
    form.post(`/${props.url}/${item.id}/edit`);
};

let deleteItem = (item) => {
    if (confirm(`Are you sure you want to delete this?`)) {
        console.log(item.id + " deleted");

        router.delete(`/${props.url}/${item.id}/delete`);
    }
};
</script>

<template>
    <template v-for="item in props.data" :key="item.id">
        <div class="flex items-center justify-between">
            <div
                class="flex flex-grow flex-col justify-between sm:flex-row sm:items-center">
                <TableRowData
                    v-for="key in props.keys"
                    :key="`${item.id}-${key}`"
                    class="self-center sm:self-start">
                    <div>
                        <p class="pr-1 text-xs font-medium text-gray-400">
                            {{ key }}:
                        </p>
                        <input
                            class="mt-2 text-sm font-medium text-gray-900"
                            :class="
                                !isEditing[item.id]
                                    ? 'bg-white sm:text-left'
                                    : 'w-full rounded-md border-2 border-gray-300 px-1'
                            "
                            v-model="item[key]"
                            :disabled="!isEditing[item.id]" />
                    </div>
                </TableRowData>
            </div>
            <TableRowData class="" :right-aligned="true">
                <div
                    class="flex flex-col justify-between sm:flex-row sm:items-center">
                    <button
                        v-if="!isEditing[item.id]"
                        class="text-indigo-600 hover:text-indigo-900"
                        @click="startEdit(item)">
                        Edit
                    </button>
                    <button
                        v-if="isEditing[item.id]"
                        class="text-indigo-600 hover:text-indigo-900"
                        @click="
                            (submitEdit(item), (isEditing[item.id] = false))
                        ">
                        Save
                    </button>
                    <button
                        v-if="isEditing[item.id]"
                        class="ml-2 text-red-600 hover:text-red-900"
                        @click="cancelEdit(item)">
                        Cancel
                    </button>
                    <button
                        v-if="!isEditing[item.id]"
                        class="ml-2 text-red-600 hover:text-red-900"
                        @click="deleteItem(item)">
                        Delete
                    </button>
                </div>
            </TableRowData>
        </div>
    </template>
</template>
