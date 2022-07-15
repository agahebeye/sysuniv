<script lang="ts" setup>
import { Head, useForm } from '@inertiajs/inertia-vue3';
import ValidationErrorList from '~/components/shared/ValidationErrorList.vue';
import XButton from '~/components/shared/XButton.vue';

import DefaultLayout from '~/layouts/default.vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    is_admin: false,
});

function createEmployee() {
    form.post('/employees/store');
}
</script>

<template>

    <Head>
        <title>Créer nouvelle employée - Ministère d'éducation du Burundi</title>
    </Head>

    <DefaultLayout>

        <div class="">

            <h1>Créer une nouvelle employée</h1>

            <ValidationErrorList v-if="form.hasErrors" :errors="form.errors" />

            <form @submit.prevent="createEmployee" class="w-max">
                <div class="mb-4">
                    <label for="name">nom complet</label>
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

                <div class="inline-flex items-center mb-4 space-x-2">
                    <input type="checkbox" class="" name="is_admin" id="is_admin" v-model="form.is_admin">
                    <label for="is_admin">créer comme admininstrateur</label>
                </div>

                <x-button>créer employée</x-button>
            </form>
        </div>
    </DefaultLayout>
</template>