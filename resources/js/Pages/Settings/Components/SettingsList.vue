<script setup lang="ts">
import Table from "../../../Shared/Table.vue";
import TableRowData from "../../../Shared/TableRowData.vue";
defineProps<{
    settings: Record<string, any> | undefined;
}>();
</script>

<template>
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
</template>
