<script setup lang="ts">
defineProps<{
    weeklySedra: any;
    nextCandleLighting: any;
    candleLighting: any;
    leyning: any;
    formatTanachBookName: any;
}>();
</script>

<template>
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto lg:-mx-8">
            <div class="inline-block w-full py-2 align-middle sm:px-4 lg:px-8">
                <div
                    class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                    <table
                        class="min-w-full divide-y divide-gray-200 text-xs md:text-sm lg:text-lg">
                        <tbody class="divide-y divide-gray-200 bg-white">
                            <tr
                                class="flex items-center justify-around font-medium text-gray-900">
                                <td
                                    class="basis-2/5 whitespace-nowrap px-1 py-4 text-center md:text-left">
                                    <h2
                                        class="flex items-center justify-center sm:justify-start md:items-start">
                                        Next Candle Lighting:
                                    </h2>
                                </td>
                            </tr>
                            <tr
                                class="flex items-center justify-around font-medium text-gray-900 sm:flex-col sm:justify-start">
                                <td
                                    class="basis-2/5 whitespace-nowrap px-1 py-4 text-center sm:py-1">
                                    <h2
                                        class="flex items-center justify-center">
                                        {{ nextCandleLighting() }}
                                    </h2>
                                </td>
                                <td
                                    class="basis-2/5 whitespace-nowrap px-1 py-4 text-center sm:py-1">
                                    <h2
                                        class="flex items-center justify-center">
                                        {{
                                            candleLighting[0].date.renderGematriya(
                                                true,
                                            )
                                        }}
                                    </h2>
                                </td>
                            </tr>
                            <tr
                                class="flex items-center justify-around font-medium text-gray-900 sm:flex-col sm:justify-start">
                                <td
                                    class="basis-2/5 whitespace-nowrap px-1 py-4 text-center sm:py-1">
                                    <h2
                                        class="flex items-center justify-center">
                                        {{
                                            candleLighting
                                                .filter(
                                                    (e) =>
                                                        e.desc ===
                                                        "Candle lighting",
                                                )[0]
                                                .render("ashkenazi")
                                        }}
                                    </h2>
                                </td>
                                <td
                                    class="basis-2/5 whitespace-nowrap px-1 py-4 text-center sm:py-1">
                                    <h2
                                        class="flex items-center justify-center">
                                        {{
                                            candleLighting
                                                .filter(
                                                    (e) =>
                                                        e.desc === "Havdalah",
                                                )[0]
                                                .render("ashkenazi")
                                        }}
                                    </h2>
                                </td>
                            </tr>
                            <tr
                                class="flex items-center justify-around font-medium text-gray-900 sm:flex-col sm:justify-start">
                                <td
                                    class="basis-2/5 whitespace-nowrap px-1 py-4 text-center sm:py-1">
                                    <div>
                                        <p v-if="leyning?.reason">
                                            Leyning: ({{ leyning.reason?.M }})
                                        </p>
                                        <p v-else>Leyning:</p>
                                        <p>
                                            {{
                                                formatTanachBookName(
                                                    leyning?.summary,
                                                )
                                            }}
                                        </p>
                                    </div>
                                </td>
                                <td
                                    class="basis-2/5 whitespace-nowrap px-1 py-4 text-center sm:py-1">
                                    <div v-if="leyning.haftara">
                                        <p v-if="leyning.reason">
                                            Haftarah: ({{
                                                leyning.reason.haftara
                                            }})
                                        </p>
                                        <p v-else>Haftarah:</p>
                                        <p>
                                            {{
                                                formatTanachBookName(
                                                    leyning.haftara,
                                                )
                                            }}
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
