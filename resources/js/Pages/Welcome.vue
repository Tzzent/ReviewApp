<script setup lang="ts">
import axios from "axios";
import { ref, onMounted } from "vue";
import { Modal } from "momentum-modal";

import Topbar from "@/Components/Topbar/Topbar.vue";
import Aside from "@/Components/Aside/Aside.vue";
import Banner from "@/Components/Banner/Banner.vue";
import PetCard from "@/Components/PetCard.vue";
import Logo from "@/Components/Logo.vue";

import { Breed } from "@/types";

defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
    laravelVersion: string;
    phpVersion: string;
}>();

const breeds = ref<Breed[]>([]);

const fetchData = async () => {
    try {
        const response = await fetch(`/api/breeds`);
        const data = await response.json();
        breeds.value = data.breeds;
    } catch (error) {
        console.error(error);
    }
};

onMounted(() => {
    fetchData();
});
</script>

<template>
    <div class="bg-gray-100 h-full relative">
        <Topbar />
        <div class="container mx-auto px-2 pt-24 flex gap-5">
            <Aside />
            <main class="bg-white flex-1 shadow-sm rounded-lg overflow-hidden">
                <Banner />
                <div class="container mx-auto px-2 py-5">
                    <div class="grid grid-cols-4 gap-5">
                        <PetCard v-for="breed in breeds" :breed="breed" />
                    </div>
                </div>
            </main>
        </div>
        <footer
            class="bg-white w-full container mx-auto mt-10 px-5 py-4 rounded-t-3xl flex justify-between items-center"
        >
            <p>Here will be the footer body</p>
            <Logo />
        </footer>
        <Modal
            class="fixed z-40 top-0 left-0 bottom-0 right-0 bg-gray-900/70"
        />
    </div>
</template>

<!-- <div
    v-if="canLogin"
    class="sm:fixed sm:top-0 sm:right-0 p-6 text-right"
>
    <Link
        v-if="$page.props.auth.user"
        :href="route('dashboard')"
        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
        >Dashboard</Link
    >

    <template v-else>
        <Link
            :href="route('login')"
            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
            >Log in</Link
        >

        <Link
            v-if="canRegister"
            :href="route('register')"
            class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
            >Register</Link
        >
    </template>
</div> -->
