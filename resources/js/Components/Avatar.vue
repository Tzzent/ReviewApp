<script setup lang="ts">
defineProps({
    image: String,
    label: String,
});
</script>
<template>
    <div class="max-w-[2rem] rounded-full overflow-hidden">
        <img
            :src="image || '/images/user-placeholder.jpg'"
            :alt="label || 'Avatar'"
            class="w-full h-full"
        />
    </div>
</template>
