<script setup>
import { router, Head, useForm } from "@inertiajs/vue3";
import MemberForm from "./MemberForm.vue";
let props = defineProps({
    member: Object,
});
let form = useForm({
    forenames: props.member.forenames,
    surname: props.member.surname,
    hebrew_name: props.member.hebrew_name,
    gender: props.member.gender,
    fathers_hebrew_name: props.member.fathers_hebrew_name,
    mothers_hebrew_name: props.member.mothers_hebrew_name,
    paternal_grandfather_hebrew_name:
        props.member.paternal_grandfather_hebrew_name,
    paternal_grandmother_hebrew_name:
        props.member.paternal_grandmother_hebrew_name,
    maternal_grandfather_hebrew_name:
        props.member.maternal_grandfather_hebrew_name,
    maternal_grandmother_hebrew_name:
        props.member.maternal_grandmother_hebrew_name,
    paternal_status: props.member.paternal_status,
    maternal_status: props.member.maternal_status,
    contact_email: props.member.contact_email,
});

let submit = () => {
    form.post(`/members/${props.member.id}/edit`);
};
</script>

<template>
    <Head title="Edit Member" />
    <h1 class="text-3xl">Edit Member</h1>
    <MemberForm :submit="submit" :form="form" />
</template>
