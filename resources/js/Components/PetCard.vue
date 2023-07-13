<script setup lang="ts">
import { Breed } from "@/types";

defineProps({
    breed: {
        type: Object as () => Breed,
        required: true,
    },
});
</script>
<template>
    <div class="flex flex-col overflow-hidden relative group rounded-lg">
        <div class="w-full h-full">
            <img
                :src="breed.image?.secure_url"
                :alt="breed.name"
                class="w-full h-full object-cover"
            />
        </div>

        <div
            class="absolute bottom-0 left-0 right-0 bg-white translate-y-40 duration-300 group-hover:translate-y-0"
        >
            <div class="w-full bg-amber-500">
                <h1>{{ breed.name }}</h1>
            </div>

            <div class="w-full h-40 py-5">
                <p>Descripcion: {{ breed.description }}</p>
                <p>Likes: {{ breed.likes }}</p>
                <p>Edad: {{ breed.age }}</p>
            </div>
        </div>
    </div>
</template>
