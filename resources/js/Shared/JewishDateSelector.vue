<script setup>
import { calcDaysInMonth, getJewishMonthsInOrder } from "jewish-date";
import { ref, watch } from "vue";
const model = defineModel();
console.log(model.value);

const daysInMonth = ref(null);
const months = ref(null);

watch(
    () => model.value[1],
    () => {
        daysInMonth.value = Array.from(
            {
                length: calcDaysInMonth(model.value[2], model.value[1]),
            },
            (_, i) => i + 1,
        );
    },
    { immediate: true },
);
watch(
    () => model.value[2],
    () => {
        months.value = getJewishMonthsInOrder(model.value[2]);
    },
    { immediate: true },
);
</script>

<template>
    <div>
        <slot></slot>
        <div class="flex">
            <div class="mr-6 flex flex-col">
                <label
                    class="mb-2 block text-xs font-bold text-gray-400"
                    for="date">
                    Day
                </label>
                <select v-model="model[0]">
                    <option value="None">None</option>
                    <option v-for="day in daysInMonth" :key="day" :value="day">
                        {{ day }}
                    </option>
                </select>
            </div>
            <div class="mr-6 flex flex-col">
                <label
                    class="mb-2 block text-xs font-bold text-gray-400"
                    for="date">
                    Month
                </label>
                <select v-model="model[1]">
                    <option v-for="month in months" :key="month" :value="month">
                        {{ month }}
                    </option>
                </select>
            </div>
            <div class="flex flex-col">
                <label
                    class="mb-2 block text-xs font-bold text-gray-400"
                    for="date">
                    Year
                </label>
                <input
                    type="number"
                    v-model="model[2]"
                    :min="5785 - 100"
                    :max="5785 + 100"
                    placeholder="5785" />
            </div>
        </div>
    </div>
</template>
