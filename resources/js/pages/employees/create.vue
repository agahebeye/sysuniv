<script lang="ts" setup>
import { Head, useForm } from '@inertiajs/inertia-vue3';
import ValidationErrorList from '~/components/shared/ValidationErrorList.vue';
import XButton from '~/components/shared/XButton.vue';


const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

function createEmployee() {
    form.post('/employees/store');
}
</script>

<template>
    <div class="max-w-sm">

        <Head>
            <title>Créer nouvelle employée - Ministère d'éducation du Burundi</title>
        </Head>
        <h1>Créer une nouvelle employée</h1>

        <ValidationErrorList v-if="form.hasErrors" :errors="form.errors" />

        <form @submit.prevent="createEmployee">
            <div class="mb-4">
                <label for="name">nom</label>
                <input type="text" id="name" v-model="form.name" class="input" autocomplete="off" required>
            </div>

            <div class="mb-4">
                <label for="email">email</label>
                <input type="email" id="email" v-model="form.email" class="input" autocomplete="off" required>
            </div>

            <div class="mb-4">
                <label for="password">mot de passe</label>
                <input type="password" id="password" v-model="form.password" class="input" autocomplete="off" required>
            </div>

            <div class="mb-4">
                <label for="password_confirmation">confirmer le mot de passe</label>
                <input type="password" id="password_confirmation"
                    v-model="form.password_confirmation"
                    class="input"
                    autocomplete="off" required>
            </div>

            <x-button>créer employée</x-button>
        </form>
    </div>
</template>