<script setup>
import { usePage } from "@inertiajs/vue3";
import NavLink from "./NavLink.vue";
import { computed } from "vue";

const page = usePage();

const isLoggedIn = computed(() => !!page.props.auth?.user?.username);
console.log(isLoggedIn.value);
</script>

<template>
    <nav
        class="mt-3 sm:ml-6 sm:mt-0 sm:space-x-6 md:flex-row md:space-x-0 md:space-y-6 lg:space-y-0">
        <ul
            class="flex justify-around space-x-6 md:flex-row md:space-x-6 md:space-y-0">
            <li>
                <NavLink href="/" :active="$page.component === 'Home'">
                    Home
                </NavLink>
            </li>

            <li v-if="isLoggedIn">
                <NavLink href="/users" :active="$page.component === 'Users'">
                    Users
                </NavLink>
            </li>
            <li v-if="isLoggedIn">
                <NavLink
                    href="/members"
                    :active="$page.component === 'Members'">
                    Members
                </NavLink>
            </li>

            <li v-if="isLoggedIn">
                <NavLink
                    href="/settings"
                    :active="$page.component === 'Settings'">
                    Settings
                </NavLink>
            </li>
            <li v-if="isLoggedIn">
                <NavLink href="/logout" method="post">Log Out</NavLink>
            </li>
            <li v-if="!isLoggedIn">
                <NavLink href="/login">Log In</NavLink>
            </li>
        </ul>
    </nav>
</template>
