<script setup>
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";
const today = new Date().toISOString().split("T")[0];

const isLoading = ref(true);
const date = ref("null");

const fetchDate = async () => {
    const response = await fetch(
        `https://www.hebcal.com/converter?cfg=json&date=${today}&g2h=1&strict=1`
    );
    return await response.json();
};

const convertDate = (data) => {
    return `${data.hd} ${data.hm} ${data.hy}`;
};

const getDate = async () => {
    try {
        isLoading.value = true;
        const data = await fetchDate();
        date.value = convertDate(data);
        isLoading.value = false;
    } catch (error) {
        console.error(error);
    }
};
getDate();
</script>

<template>
    <Head title="Home">
        <meta
            type="description"
            content="Home Information"
            head-key="description" />
    </Head>
    <h1 class="text-3xl">Home</h1>
    <div>
        <h2>{{ date }}</h2>
        <ul>
            <li v-for="zman in zmanim" :key="zman.name">
                {{ zman.name }}: {{ zman.time }}
            </li>
        </ul>
    </div>
</template>
