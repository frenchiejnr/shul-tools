<script setup>
import { getParentName } from "../Shared/utils";
import { getNextYahrzeit } from "../Shared/utils";
const props = defineProps({
    yahrzeit: Object,
    parent: String,
});

const parentName = getParentName(props.yahrzeit, props.parent);
const hebrewDate = props.yahrzeit[`${props.parent}_yahrtzeit_date`];

const nextYahrzeit = getNextYahrzeit(hebrewDate);
</script>

<template>
    <td class="border-b-2 border-r-2 p-1 sm:px-4 sm:py-4">
        <div class="flex flex-col justify-between sm:flex-row sm:items-center">
            <div class="basis-2/6 text-sm font-medium text-gray-900">
                {{ yahrzeit.forenames }}
                {{ yahrzeit.surname }}
            </div>
            <div class="basis-1/6 text-sm font-medium text-gray-900">
                {{ parent.charAt(0).toUpperCase() + parent.slice(1) }}
            </div>
            <div
                class="basis-2/6 text-wrap text-right text-sm font-light sm:font-medium">
                {{ parentName }}
            </div>
            <div
                class="basis-2/6 text-right text-sm font-light sm:pl-1 sm:font-medium">
                <div>
                    <p>
                        {{ hebrewDate }}
                    </p>
                    <p class="sm:text-gray-400">
                        {{ nextYahrzeit.readableDate }}
                    </p>
                </div>
            </div>
        </div>
    </td>
</template>
