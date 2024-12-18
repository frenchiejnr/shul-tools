<script setup>
const props = defineProps({
    rightAligned: Boolean,
});
</script>

<template>
    <td class="whitespace-nowrap px-1 py-4 sm:px-6">
        <div class="flex items-center" :class="{ 'justify-end': rightAligned }">
            <slot />
        </div>
    </td>
</template>
