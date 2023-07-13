<script setup lang="ts">
import { useModal } from "momentum-modal";

const { close, redirect } = useModal();

const leave = () => {
    redirect();
};
</script>

<template>
    <div
        class="w-full h-full flex justify-center items-center"
        @click.self="leave"
    >
        <div
            :class="`
            flex
            flex-col
            bg-white
            shadow-xl
            w-full
            max-w-md
            p-8
            rounded-lg
            gap-5
            `"
        >
            <slot />
        </div>
    </div>
</template>
