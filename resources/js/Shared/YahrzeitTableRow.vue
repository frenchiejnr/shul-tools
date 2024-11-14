<script setup>
import { getParentName } from "../Shared/utils";
import { HebrewCalendar, HDate } from "@hebcal/core";
import { getIndexByJewishMonth } from "jewish-date";
const props = defineProps({
    yahrzeit: Object,
    parent: String,
});

const parentName = getParentName(props.yahrzeit, props.parent);
const hebrewDate = props.yahrzeit[`${props.parent}_yahrtzeit_date`];
const nextYahrzeit = HebrewCalendar.getYahrzeit(
    5785,
    new HDate(
        hebrewDate.split("-")[0],
        hebrewDate.split("-")[1],
        hebrewDate.split("-")[2],
    ),
)?.greg();
const previousEvening = new Date(nextYahrzeit?.getTime() - 1000 * 60 * 60 * 24)
    .toLocaleDateString("en-GB", {
        weekday: "short",
        day: "numeric",
    })
    .replace(/(\w{3})/, "$1 Night,");
</script>

<template>
    <td class="border-r-2 p-1 sm:px-4 sm:py-4">
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
                <p>
                    {{ hebrewDate }}
                </p>
                <p v-if="nextYahrzeit" class="sm:text-gray-400">
                    {{
                        `${previousEvening} -
                        ${nextYahrzeit?.toLocaleDateString("en-GB", {
                            weekday: "short",
                            day: "numeric",
                            year: "numeric",
                            month: "short",
                        })}`
                    }}
                </p>
            </div>
        </div>
    </td>
</template>
