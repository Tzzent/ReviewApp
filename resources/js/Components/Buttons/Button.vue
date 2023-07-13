<script setup lang="ts">
defineProps({
    label: String,
});
</script>

<template>
    <button
        :class="`
        bg-purple-500
        p-3 
        w-full 
        rounded-md 
        text-white 
        font-bold
        hover:bg-purple-600
        hover:scale-105
        `"
    >
        {{ label }}
    </button>
</template>
