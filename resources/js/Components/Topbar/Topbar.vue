<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import Logo from "@/Components/Logo.vue";
import Avatar from "../Avatar.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
</script>
<template>
    <div class="bg-indigo-600 shadow-md fixed top-0 left-0 right-0 z-10">
        <nav
            class="py-3 px-2 container mx-auto flex items-center justify-between text-white"
        >
            <Link href="/">
                <Logo />
            </Link>
            <ul class="flex items-center gap-5">
                <Link :href="route('breed.create')">
                    <li
                        class="flex items-center gap-2 mr-8 bg-slate-600/50 rounded-full py-2 px-4"
                    >
                        Encontrar Hogar
                        <v-icon name="md-pets-twotone" class="text-amber-200" />
                    </li>
                </Link>
                <li>Inicio</li>
                <li>Acerca de</li>
                |
                <li>
                    <div v-if="$page.props.auth.user" class="flex items-center">
                        <Dropdown align="right" width="48">
                            <template #trigger>
                                <span
                                    class="flex items-center gap-2 cursor-pointer"
                                >
                                    <Avatar
                                        :image="
                                            $page.props.auth.user.image
                                                ?.secure_url
                                        "
                                    />
                                    <button
                                        type="button"
                                        class="flex items-center"
                                    >
                                        {{ $page.props.auth.user?.name }}

                                        <svg
                                            class="ml-2 -mr-0.5 h-4 w-4"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </button>
                                </span>
                            </template>

                            <template #content>
                                <DropdownLink :href="route('profile.edit')">
                                    Profile
                                </DropdownLink>
                                <DropdownLink
                                    :href="route('logout')"
                                    method="post"
                                    as="button"
                                >
                                    Log Out
                                </DropdownLink>
                            </template>
                        </Dropdown>
                    </div>
                    <Link v-else :href="route('auth')">Inciar sesion</Link>
                </li>
            </ul>
        </nav>
    </div>
</template>
