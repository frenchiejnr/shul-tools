<script setup>
let props = defineProps({
    member: Object,
});
console.log(props.member);
</script>

<template>
    {{ props.member }}
</template>
