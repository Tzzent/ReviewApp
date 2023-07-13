<script setup lang="ts">
import { ref } from "vue";
defineProps({
    modelValue: File,
    name: String,
});

const previewImage = ref<string>("");
const emit = defineEmits(["update:modelValue"]);

const handleInput = (event: Event) => {
    const target = event.target as HTMLInputElement | null;

    if (!target) {
        return;
    }

    const file = target.files?.[0];
    emit("update:modelValue", file);

    if (!file) {
        return (previewImage.value = "");
    }

    previewImage.value = URL.createObjectURL(file);
};
</script>

<template>
    <label
        :for="name"
        class="flex justify-center items-center w-full h-72 border-2 border-dashed border-gray-400 rounded-2xl cursor-pointer hover:bg-gray-500/10 group overflow-hidden"
    >
        <input
            :id="name"
            :name="name"
            type="file"
            accept="image/*"
            class="hidden"
            @change="handleInput"
        />
        <img
            v-if="previewImage"
            :src="previewImage"
            alt="Breed"
            class="w-full h-full object-cover group-hover:opacity-80 duration-100"
        />
        <v-icon
            v-else
            name="bi-card-image"
            scale="10"
            class="text-gray-500 group-hover:text-gray-500/50 duration-0"
        />
    </label>
</template>
