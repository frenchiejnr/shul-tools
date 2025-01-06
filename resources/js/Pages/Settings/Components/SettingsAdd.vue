<script setup>
import Table from "../../../Shared/Table.vue";
import TableRowData from "../../../Shared/TableRowData.vue";

let props = defineProps({
    submit: Function,
    form: Object,
    settingsKeys: Object,
});
</script>

<template>
    <Table v-if="settingsKeys?.length">
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
