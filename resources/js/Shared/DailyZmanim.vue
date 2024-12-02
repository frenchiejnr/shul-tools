<script setup lang="ts">
defineProps<{
    zmanim: any;
}>();
</script>

<template>
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto lg:-mx-8">
            <div
                class="inline-block min-w-full py-2 align-middle sm:px-4 lg:px-8">
                <div
                    class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <tbody class="divide-y divide-gray-200 bg-white">
                            <tr
                                v-for="zman in zmanim"
                                :key="zman.name"
                                class="flex items-center justify-between text-sm font-medium text-gray-900">
                                <td
                                    class="hidden basis-2/5 whitespace-nowrap px-1 py-4 sm:block">
                                    <p class="px-2">
                                        {{ zman.name }}
                                    </p>
                                </td>
                                <td
                                    class="hidden whitespace-nowrap px-1 py-4 sm:block">
                                    <p>
                                        {{ zman.time }}
                                    </p>
                                </td>
                                <td
                                    class="hidden basis-2/5 whitespace-nowrap text-wrap px-1 py-4 text-right sm:block">
                                    <p>
                                        {{ zman.hebrewName }}
                                    </p>
                                </td>
                                <td
                                    class="block whitespace-nowrap px-1 py-4 sm:hidden">
                                    <p>
                                        {{ zman.hebrewName }}
                                    </p>
                                    <p>
                                        {{ zman.name }}
                                    </p>
                                </td>
                                <td
                                    class="block whitespace-nowrap px-1 py-4 sm:hidden">
                                    {{ zman.time }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
