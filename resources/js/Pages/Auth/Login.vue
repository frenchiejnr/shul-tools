<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import Layout from "../../Shared/Layout.vue";
defineOptions({
    layout: Layout,
});
let form = useForm({
    email: "",
    password: "",
});

let submit = () => {
    form.post("/login");
};
</script>

<template>
    <Head title="Login Page" />
    <main class="grid h-4/5 place-items-center">
        <section class="mx-auto mt-8 max-w-md rounded-xl border bg-white p-8">
            <h1 class="mb-6 text-3xl">Login</h1>
            <form @submit.prevent="submit">
                <div class="mb-6">
                    <label
                        class="mb-2 block text-xs font-bold uppercase text-gray-700"
                        for="email">
                        Email
                    </label>
                    <input
                        v-model="form.email"
                        class="w-full rounded border p-2"
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
                        class="w-full rounded border p-2"
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
                        Log In
                    </button>
                </div>
            </form>
        </section>
    </main>
</template>
