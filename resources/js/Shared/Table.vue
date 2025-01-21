<script setup lang="ts"></script>

<template>
    <div class="mx-auto max-w-3xl">
        <div
            class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div class="mb-2 flex items-center sm:mb-0">
                <slot name="heading"></slot>
                <slot name="buttons"></slot>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center">
                <slot name="options"></slot>
            </div>
        </div>

        <div v-if="$slots.rows" class="flex flex-col">
            <div class="-my-2 overflow-x-auto lg:-mx-8">
                <div
                    class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <div
                        class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <tbody class="divide-y divide-gray-200 bg-white">
                                <slot name="rows"></slot>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
