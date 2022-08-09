<script setup>
import { Head, useForm } from '@inertiajs/inertia-vue3';
import GuestLayout from '~/layouts/GuestLayout.vue';
import ValidationErrorList from '~/components/shared/ValidationErrorList.vue';
import XButton from '~/components/shared/XButton.vue';

const form = useForm({
    email: '',
    password: ''
});

</script>

<template>

    <Head>
        <title>Connexion - Ministère d'éducation du Burundi</title>
    </Head>

    <GuestLayout>
        <div class="px-6 mt-10">
            <h1>Connexion</h1>


            <form @submit.prevent="form.post('/login')" class="w-max">
                <ValidationErrorList class="max-w-fit" v-if="form.hasErrors" :errors="form.errors" />
                
                <div class="mb-4">
                    <label for="email">email</label>
                    <input type="email" id="email" v-model="form.email" class="input" autocomplete="off" autofocus required>
                </div>

                <div class="mb-4">
                    <label for="password">mot de passe</label>
                    <input type="password" id="password" v-model="form.password" class="input" autocomplete="off" autofocus
                        required>
                </div>

                <x-button :processing="form.processing">Se connecter</x-button>
            </form>
        </div>
    </GuestLayout>
</template>