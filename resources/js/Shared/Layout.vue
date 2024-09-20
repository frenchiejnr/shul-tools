<template>
    <Head title="My App">
        <meta
            type="description"
            content="Information about my app"
            head-key="description"
        />
    </Head>
    <section class="bg-gray-200 p-6">
        <header class="flex justify-between">
            <div class="flex items-center">
                <h1 class="text-lg font-bold">My App</h1>
                <p class="ml-4 text-sm">Welcome Back, {{ username }}!</p>
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
import { usePage } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";

const page = usePage();
let username = computed(() => page.props.auth.user.username);
</script>
