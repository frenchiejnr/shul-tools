<script setup>
import Table from "./Table.vue";

let props = defineProps({
    heading: String,
});
</script>

<template>
    <Table>
        <template #heading>
            <h1 class="text-3xl">{{ props.heading }}</h1>
        </template>
        <template #rows>
            <slot />
        </template>
    </Table>
</template>
