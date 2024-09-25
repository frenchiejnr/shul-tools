<template>
    <div class="mb-6">
        <label
            class="mb-2 block text-xs font-bold uppercase text-gray-700"
            for="status">
            Status
        </label>

        <div class="flex items-center">
            <div v-for="(option, index) in options" :key="index" class="mr-2">
                <input
                    type="radio"
                    :value="option.value"
                    v-model="selectedValue"
                    :name="name"
                    :id="option.value"
                    required />
                <label
                    class="ml-1 text-sm font-bold uppercase text-gray-700"
                    :for="option.value">
                    {{ option.label }}
                </label>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed } from "vue";
const emit = defineEmits(["update:modelValue"]);
const props = defineProps({
    name: String,
    modelValue: String,
});

const options = [
    { value: "kohen", label: "Kohen" },
    { value: "levi", label: "Levi" },
    { value: "yisrael", label: "Yisrael" },
];

const selectedValue = computed({
    get() {
        return props.modelValue;
    },
    set(value) {
        emit("update:modelValue", value);
    },
});
</script>
