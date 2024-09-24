<script setup>
import { router, Head, useForm } from "@inertiajs/vue3";
let props = defineProps({
    member: Object,
});
let form = useForm({
    name: props.member.name,
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
});

let submit = () => {
    form.post(`/members/${props.member.id}/edit`);
};
</script>

<template>
    <Head title="Edit Member" />
    <h1 class="text-3xl">Edit Member</h1>
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
        <h2 class="mb-6 text-xl">Parents</h2>
        <div class="mb-6">
            <label
                class="mb-2 block text-xs font-bold uppercase text-gray-700"
                for="fathers_hebrew_name">
                Fathers Hebrew Name
            </label>
            <input
                v-model="form.fathers_hebrew_name"
                class="w-full border border-gray-400 p-2"
                type="text"
                name="fathers_hebrew_name"
                id="fathers_hebrew_name"
                required />
            <div
                v-if="form.errors.fathers_hebrew_name"
                class="mt-1 text-xs text-red-500"
                v-text="form.errors.fathers_hebrew_name"></div>
        </div>
        <div class="flex justify-between">
            <div class="mb-6">
                <label
                    class="mb-2 block text-xs font-bold uppercase text-gray-700"
                    for="paternal_grandfather_hebrew_name">
                    Fathers Fathers Hebrew Name
                </label>
                <input
                    v-model="form.paternal_grandfather_hebrew_name"
                    class="w-full border border-gray-400 p-2"
                    type="text"
                    name="paternal_grandfather_hebrew_name"
                    id="paternal_grandfather_hebrew_name"
                    required />
                <div
                    v-if="form.errors.paternal_grandfather_hebrew_name"
                    class="mt-1 text-xs text-red-500"
                    v-text="form.errors.paternal_grandfather_hebrew_name"></div>
            </div>
            <div class="mb-6">
                <label
                    class="mb-2 block text-xs font-bold uppercase text-gray-700"
                    for="paternal_grandmother_hebrew_name">
                    Fathers Mothers Hebrew Name
                </label>
                <input
                    v-model="form.paternal_grandmother_hebrew_name"
                    class="w-full border border-gray-400 p-2"
                    type="text"
                    name="paternal_grandmother_hebrew_name"
                    id="paternal_grandmother_hebrew_name"
                    required />
                <div
                    v-if="form.errors.paternal_grandmother_hebrew_name"
                    class="mt-1 text-xs text-red-500"
                    v-text="form.errors.paternal_grandmother_hebrew_name"></div>
            </div>
        </div>
        <div class="mb-6">
            <label
                class="mb-2 block text-xs font-bold uppercase text-gray-700"
                for="mothers_hebrew_name">
                Mothers Hebrew Name
            </label>
            <input
                v-model="form.mothers_hebrew_name"
                class="w-full border border-gray-400 p-2"
                type="text"
                name="mothers_hebrew_name"
                id="mothers_hebrew_name"
                required />
            <div
                v-if="form.errors.mothers_hebrew_name"
                class="mt-1 text-xs text-red-500"
                v-text="form.errors.mothers_hebrew_name"></div>
        </div>
        <div class="flex justify-between">
            <div class="mb-6">
                <label
                    class="mb-2 block text-xs font-bold uppercase text-gray-700"
                    for="maternal_grandfather_hebrew_name">
                    Fathers Fathers Hebrew Name
                </label>
                <input
                    v-model="form.maternal_grandfather_hebrew_name"
                    class="w-full border border-gray-400 p-2"
                    type="text"
                    name="maternal_grandfather_hebrew_name"
                    id="maternal_grandfather_hebrew_name"
                    required />
                <div
                    v-if="form.errors.maternal_grandfather_hebrew_name"
                    class="mt-1 text-xs text-red-500"
                    v-text="form.errors.maternal_grandfather_hebrew_name"></div>
            </div>
            <div class="mb-6">
                <label
                    class="mb-2 block text-xs font-bold uppercase text-gray-700"
                    for="maternal_grandmother_hebrew_name">
                    Fathers Mothers Hebrew Name
                </label>
                <input
                    v-model="form.maternal_grandmother_hebrew_name"
                    class="w-full border border-gray-400 p-2"
                    type="text"
                    name="maternal_grandmother_hebrew_name"
                    id="maternal_grandmother_hebrew_name"
                    required />
                <div
                    v-if="form.errors.maternal_grandmother_hebrew_name"
                    class="mt-1 text-xs text-red-500"
                    v-text="form.errors.maternal_grandmother_hebrew_name"></div>
            </div>
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
