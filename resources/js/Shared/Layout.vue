<template>
    <Head title="My App">
        <meta
            type="description"
            content="Information about my app"
            head-key="description" />
    </Head>
    <section class="bg-gray-200 p-2 sm:p-6">
        <header
            class="flex flex-col justify-between sm:flex-row sm:items-center">
            <div class="flex flex-col items-center sm:flex-row">
                <h1 class="text-lg font-bold">My App</h1>
                <p v-if="username" class="text-sm sm:ml-4">
                    Welcome Back, {{ username }}!
                </p>
            </div>
            <Nav />
        </header>
    </section>
    <section class="p-6">
        <div class="mx-auto max-w-3xl">
            <slot />
        </div>
    </section>
</template>

<script setup>
import Nav from "./Nav.vue";
import { computed } from "vue";
import { Head, usePage } from "@inertiajs/vue3";

const page = usePage();
let username = computed(() => page.props.auth?.user?.username || null);
</script>
