<script setup>
import { router, Head, useForm } from "@inertiajs/vue3";
let form = useForm({
    name: "",
    hebrew_name: "",
    gender: "",
});

let submit = () => {
    form.post("/members");
};
</script>

<template>
    <Head title="Create Member" />
    <h1 class="text-3xl">Create Member</h1>

    <form @submit.prevent="submit" class="mx-auto mt-8 max-w-md">
        <div class="mb-6">
            <label
                class="mb-2 block text-xs font-bold uppercase text-gray-700"
                for="name">
                Name
            </label>
            <input
                v-model="form.name"
                class="w-full border border-gray-400 p-2"
                type="text"
                name="name"
                id="name"
                required />
            <div
                v-if="form.errors.name"
                class="mt-1 text-xs text-red-500"
                v-text="form.errors.name"></div>
        </div>

        <div class="mb-6">
            <label
                class="mb-2 block text-xs font-bold uppercase text-gray-700"
                for="hebrew_name">
                Hebrew Name
            </label>
            <input
                v-model="form.hebrew_name"
                class="w-full border border-gray-400 p-2"
                type="text"
                name="hebrew_name"
                id="hebrew_name"
                required />
            <div
                v-if="form.errors.hebrew_name"
                class="mt-1 text-xs text-red-500"
                v-text="form.errors.hebrew_name"></div>
        </div>
        <div class="mb-6">
            <label
                class="mb-2 block text-xs font-bold uppercase text-gray-700"
                for="gender">
                Gender
            </label>
            <select
                v-model="form.gender"
                class="w-full border border-gray-400 p-2"
                name="gender"
                id="gender"
                required>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
            <div
                v-if="form.errors.gender"
                class="mt-1 text-xs text-red-500"
                v-text="form.errors.gender"></div>
        </div>

        <div class="mb-6">
            <button
                type="submit"
                class="rounded bg-blue-400 px-4 py-2 text-white hover:bg-blue-500">
                Submit
            </button>
        </div>
    </form>
</template>
