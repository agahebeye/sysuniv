<script>
import { Head, useForm } from '@inertiajs/inertia-vue3';
import GuestLayout from '~/layouts/GuestLayout.vue';
import ValidationErrorList from '~/components/shared/ValidationErrorList.vue';
import XButton from '~/components/shared/XButton.vue';

export default {
    layout: GuestLayout,

    components: {
        Head,
        ValidationErrorList,
        XButton
    },

    setup() {
        const form = useForm({
            email: '',
            password: ''
        });

        return {
            form,
        }
    }
}



</script>

<template>
    <div class="max-w-md w-full">

        <Head>
            <title>Connexion - Ministère d'éducation du Burundi</title>
        </Head>

        <h1>Connexion</h1>


        <ValidationErrorList v-if="form.hasErrors" :errors="form.errors" />


        <form @submit.prevent="form.post('/login')">
            <div class="mb-4">
                <label for="email">email</label>
                <input type="email" id="email" v-model="form.email" class="input" autocomplete="off" autofocus required>
            </div>

            <div class="mb-4">
                <label for="password">mot de passe</label>
                <input type="password" minlength="8" id="password" v-model="form.password" class="input" autocomplete="off" autofocus
                    required>
            </div>

            <x-button :processing="form.processing">Se connecter</x-button>
        </form>
    </div>
</template>