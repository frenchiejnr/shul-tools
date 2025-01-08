<script setup>
import Table from "../../../Shared/Table.vue";
import TableRowData from "../../../Shared/TableRowData.vue";
import { useForm } from "@inertiajs/vue3";

let form = useForm({
    key: "",
    label: "",
});

let submit = () => {
    form.post("/settingsKeys", {
        onSuccess: () => {
            form.reset();
        },
    });
};
</script>

<template>
    <Table>
        <template #rows>
            <TableRowData>
                <form @submit.prevent="submit" class="w-full">
                    <div class="flex justify-between">
                        <input
                            v-model="form.key"
                            name="key"
                            id="key"
                            placeholder="Enter key"
                            class="mr-2 w-1/2" />
                        <input
                            type="text"
                            v-model="form.label"
                            placeholder="Enter label"
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
