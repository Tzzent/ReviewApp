<script setup lang="ts">
import { ref } from "vue";

defineProps({
    modelValue: String,
    name: String,
    options: Array,
});

const isOpen = ref<boolean>(false);
const selectedOption = ref<string>("");
const emit = defineEmits(["update:modelValue"]);

const handleInput = (value: string) => {
    selectedOption.value = value;
    emit("update:modelValue", value);
    isOpen.value = false;
};
</script>

<template>
    <div class="flex flex-col relative">
        <div
            class="w-full px-5 py-3 border rounded-md cursor-pointer border-gray-500"
            @click="isOpen = !isOpen"
        >
            <span>{{ selectedOption || "Selecciona una opcion" }}</span>
            <span
                class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                    class="w-4 h-4"
                >
                    <path fill-rule="evenodd" d="M6 8l4 4 4-4" />
                </svg>
            </span>
        </div>

        <div v-show="isOpen" class="absolute top-full left-0 z-10 w-full mt-2">
            <ul class="bg-white rounded-md shadow-md divide-gray-200">
                <li
                    v-for="option in options"
                    class="px-4 py-2 cursor-pointer hover:bg-gray-100"
                    @click="() => handleInput(option as string)"
                >
                    {{ option }}
                </li>
            </ul>
        </div>
    </div>
</template>
