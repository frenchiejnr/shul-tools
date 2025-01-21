<script setup>
import Table from "../Shared/Table.vue";
import TableRowData from "../Shared/TableRowData.vue";
import { useForm } from "@inertiajs/vue3";
const props = defineProps({
    fields: Array,
    endpoint: String,
});

const form = useForm(
    props.fields.reduce((acc, field) => ({ ...acc, [field]: "" }), {}),
);

let submit = () => {
    form.post(`/${props.endpoint}`, {
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
                        <div class="flex basis-10/12 flex-col sm:flex-row">
                            <input
                                v-for="field in fields"
                                :key="field"
                                v-model="form[field]"
                                :name="field"
                                :id="field"
                                :placeholder="`Enter ${field}`"
                                class="mr-2 mt-2 sm:w-1/2" />
                        </div>
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
