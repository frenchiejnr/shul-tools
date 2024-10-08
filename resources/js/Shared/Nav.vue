<script setup>
import { Link } from "@inertiajs/vue3";
import NavLink from "./NavLink.vue";
</script>

<template>
    <nav
        class="mt-3 sm:ml-6 sm:mt-0 sm:space-x-6 md:flex-row md:space-x-0 md:space-y-6 lg:space-y-0">
        <ul
            class="flex justify-between space-x-6 md:flex-row md:space-x-6 md:space-y-0">
            <li>
                <NavLink href="/" :active="$page.component === 'Home'">
                    Home
                </NavLink>
            </li>

            <li>
                <NavLink href="/users" :active="$page.component === 'Users'">
                    Users
                </NavLink>
            </li>
            <li>
                <NavLink
                    href="/members"
                    :active="$page.component === 'Members'">
                    Members
                </NavLink>
            </li>

            <li>
                <NavLink
                    href="/settings"
                    :active="$page.component === 'Settings'">
                    Settings
                </NavLink>
            </li>
            <li>
                <NavLink href="/logout" method="post">Log Out</NavLink>
            </li>
        </ul>
    </nav>
</template>
