<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import MemberForm from "./MemberForm.vue";

let form = useForm({
    name: "",
    hebrew_name: "",
    gender: "",
    fathers_hebrew_name: "",
    mothers_hebrew_name: "",
    paternal_grandfather_hebrew_name: "",
    paternal_grandmother_hebrew_name: "",
    maternal_grandfather_hebrew_name: "",
    maternal_grandmother_hebrew_name: "",
});
let submit = () => {
    form.post("/members");
};
</script>

<template>
    <Head title="Create Member" />
    <h1 class="text-3xl">Create Member</h1>
    <MemberForm :submit="submit" :form="form" />
</template>
