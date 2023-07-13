<script setup lang="ts">
defineProps({
    modelValue: String,
    type: String,
    name: String,
    label: String,
    placeholder: String,
});

const emit = defineEmits(["update:modelValue"]);

const handleInput = (event: Event) => {
    const inputValue = (event.target as HTMLInputElement).value;
    emit("update:modelValue", inputValue);
};
</script>

<template>
    <div class="flex flex-col relative">
        <textarea
            v-if="type === 'textarea'"
            :id="name"
            :name="name"
            :value="modelValue"
            @input="handleInput"
            autocomplete="off"
            rows="5"
            class="p-3 peer w-full block border rounded-md resize-none"
        />
        <input
            v-else
            :id="name"
            :name="name"
            :type="type"
            :placeholder="placeholder"
            class="p-3 peer w-full block border rounded-md"
            :value="modelValue"
            @input="handleInput"
            autocomplete="off"
        />
        <label
            :for="name"
            :class="`
            absolute
            top-0 
            mb-0
            origin-[0_0]
            mt-3
            px-1
            left-4 
            flex 
            items-center 
            justify-center
            text-gray-500
            peer-focus:-translate-y-[1.4rem]
            peer-focus:scale-75
            peer-focus:text-black
            truncate
            bg-white
            duration-300
            ${modelValue && '-translate-y-[1.4rem] scale-75'}
            `"
        >
            {{ label }}
        </label>
    </div>
</template>
