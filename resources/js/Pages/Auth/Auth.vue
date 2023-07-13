<script setup lang="ts">
enum views {
    LOGIN,
    REGISTER,
}

import { Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

import Input from "@/Components/Inputs/Input.vue";
import Button from "@/Components/Buttons/Button.vue";
import Logo from "@/Components/Logo.vue";
import Modal from "@/Components/Modal.vue";

import useAuth from "@/Stores/useAuth";

const auth = useAuth();
const view = ref<views>(views.LOGIN);

const form = useForm({
    name: "",
    email: "",
    password: "",
});

const handleOnSubmit = () => {
    if (view.value === views.LOGIN) {
        console.log(form);
        form.post(route("login"), {
            onFinish: () => {
                form.reset();
            },
        });
    }

    if (view.value === views.REGISTER) {
        // console.log(form.value.name);
        // console.log(form.value.email);
        // console.log(form.value.password);
    }
};
</script>

<template>
    <Modal>
        <div class="flex items-center justify-center gap-8 my-5">
            <Logo />
            <h1>Yo <strong>adopto!</strong></h1>
        </div>
        <form @submit.prevent="handleOnSubmit" class="flex flex-col gap-5">
            <Input
                v-if="view === views.REGISTER"
                v-model="form.name"
                name="name"
                label="Nombre"
            />
            <Input
                v-model="form.email"
                name="email"
                label="Correo electronico"
            />
            <Input
                v-model="form.password"
                name="password"
                label="Contraseña"
                type="password"
            />
            <Button
                :label="
                    view === views.REGISTER ? 'Registrate' : 'Iniciar sesion'
                "
                type="submit"
            />
        </form>

        <div class="relative bg-red-200 my-5">
            <hr />
            <div class="absolute -top-3 w-full text-center">
                <span class="bg-white px-2 text-gray-400 text-sm">
                    O continua con
                </span>
            </div>
        </div>

        <div class="flex gap-8 justify-center">
            <a href="/auth/google">
                <v-icon name="fc-google" scale="2" class="hover:scale-110" />
            </a>
            <Link href="/">
                <v-icon name="co-github" scale="2" class="hover:scale-110" />
            </Link>
            <Link href="/">
                <v-icon
                    name="bi-linkedin"
                    scale="2"
                    class="text-blue-600 hover:scale-110"
                />
            </Link>
        </div>

        <div class="flex gap-2 justify-center mt-3 text-sm">
            <p>
                {{
                    view === views.LOGIN
                        ? "No tienes cuenta?"
                        : "Ya tienes cuenta?"
                }}
            </p>
            <button
                @click="
                    view = view === views.LOGIN ? views.REGISTER : views.LOGIN
                "
                class="text-purple-600"
            >
                {{ view === views.LOGIN ? "Registrate" : "Inicia sesion" }}
            </button>
        </div>
    </Modal>
</template>
