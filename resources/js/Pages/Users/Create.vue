<script setup>
import { router, Head, useForm } from "@inertiajs/vue3";
let form = useForm({
    name: "",
    email: "",
    password: "",
});

let submit = () => {
    form.post("/users");
};
</script>

<template>
    <Head title="Create User" />
    <div class="mx-auto max-w-3xl">
        <h1 class="text-3xl">Create User</h1>

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
                    for="email">
                    Email
                </label>
                <input
                    v-model="form.email"
                    class="w-full border border-gray-400 p-2"
                    type="email"
                    name="email"
                    id="email"
                    required />
                <div
                    v-if="form.errors.email"
                    class="mt-1 text-xs text-red-500"
                    v-text="form.errors.email"></div>
            </div>

            <div class="mb-6">
                <label
                    class="mb-2 block text-xs font-bold uppercase text-gray-700"
                    for="password">
                    Password
                </label>
                <input
                    v-model="form.password"
                    class="w-full border border-gray-400 p-2"
                    type="password"
                    name="password"
                    id="password"
                    required />
                <div
                    v-if="form.errors.password"
                    class="mt-1 text-xs text-red-500"
                    v-text="form.errors.password"></div>
            </div>

            <div class="mb-6">
                <button
                    type="submit"
                    class="rounded bg-blue-400 px-4 py-2 text-white hover:bg-blue-500">
                    Submit
                </button>
            </div>
        </form>
    </div>
</template>
