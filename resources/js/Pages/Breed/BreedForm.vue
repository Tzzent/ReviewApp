<script setup lang="ts">
enum STEPS {
    FIRST,
    SECOND,
}

import { ref } from "vue";
import { useForm, usePage } from "@inertiajs/vue3";
import { useModal } from "momentum-modal";

const { redirect } = useModal();
const {
    props: { auth },
} = usePage();

import Modal from "@/Components/Modal.vue";
import InputFile from "@/Components/Inputs/InputFile.vue";
import Input from "@/Components/Inputs/Input.vue";
import InputSelect from "@/Components/Inputs/InputSelect.vue";
import Button from "@/Components/Buttons/Button.vue";

const step = ref<STEPS>(STEPS.FIRST);

const form = useForm({
    name: "",
    description: "",
    age: "",
    state: "",
    image: "",
});

const onSubmit = () => {
    const formData = new FormData();
    formData.append("name", form.name);
    formData.append("description", form.description);
    formData.append("age", form.age);
    formData.append("state", form.state);
    formData.append("image", form.image);
    formData.append("user_id", auth.user.id);

    fetch("/api/breed/create", {
        method: "POST",

        body: formData,
    })
        .then((res) => {
            console.log("Creado!");
        })
        .catch((error) => {
            console.log("Something went wrong", error);
        });
    redirect();
};

const forwardStep = () => {
    if (step.value === STEPS.SECOND) {
        return onSubmit();
    }

    step.value++;
};

const backStep = () => {
    if (step.value === STEPS.FIRST) {
        return redirect();
    }

    step.value--;
};
</script>

<template>
    <Modal>
        <div class="text-center">
            <h1 v-if="step === STEPS.FIRST" class="font-bold text-lg">
                Agrega una mascota! 🦊
            </h1>
            <h1 v-else class="font-bold text-lg">
                Por favor, completa los datos necsarios 🦊
            </h1>
        </div>
        <div v-if="step === STEPS.FIRST" class="flex flex-col gap-5">
            <InputFile v-model="form.image" name="image" />
            <Input
                v-model="form.name"
                name="name"
                type="text"
                label="Nombre de mascota"
            />
        </div>
        <div v-else class="flex flex-col gap-5">
            <Input
                v-model="form.description"
                name="name"
                type="textarea"
                label="Descripcion"
            />
            <Input
                v-model="form.age"
                name="age"
                type="number"
                label="Edad de la mascota"
            />
            <InputSelect
                v-model="form.state"
                :options="['Available', 'Adopted', 'In progress']"
                name="state"
                label="Estado"
            />
        </div>
        <div class="flex items-center gap-5">
            <Button
                @click="backStep"
                :label="step === STEPS.FIRST ? 'Cancelar' : 'Atras'"
                :class="`
                bg-red-500
                hover:bg-red-600 
                ${step !== STEPS.FIRST && 'bg-cyan-500 hover:bg-cyan-600'}
                `"
            />
            <Button
                @click="forwardStep"
                :label="step === STEPS.FIRST ? 'Siguiente' : 'Publicar'"
                :class="`
                ${step !== STEPS.FIRST && 'bg-green-500 hover:bg-green-600'}
                `"
            />
        </div>
    </Modal>
</template>
