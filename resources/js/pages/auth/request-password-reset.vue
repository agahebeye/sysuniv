<script setup>
import { Head, useForm } from '@inertiajs/inertia-vue3';
import GuestLayout from '~/layouts/GuestLayout.vue';
import XButton from '~/components/shared/XButton.vue';

defineProps({
    status: String
})

const form = useForm({
    email: '',
});

</script>

<template>
    <GuestLayout>

        <Head>
            <title>Reset password link - Sysuniv</title>
        </Head>

        <div class="px-6 mt-10 w-max">
            <h1 class="max-w-fit">Demande de réinitialisation de mot de passe</h1>


            <div class="errors" v-if="form.hasErrors">
                <div v-for="error in form.errors">{{ error }}</div>
            </div>

            <form @submit.prevent="form.post('/request-password-reset')" class="">
                <p class="max-w-fit">
                    Informez-nous de votre email et on vous enverra le lien qui vous dirigera vers la page de réinitialisation de mot de passe
                </p>

                <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
                    {{ status }}
                </div>

                <div class="mb-4">
                    <label for="email">email</label>
                    <input id="email" type="email" v-model="form.email" class="input" required autofocus autocomplete="username" />
                </div>

                <x-button :processing="form.processing">
                    envoyer
                </x-button>
            </form>
        </div>
    </GuestLayout>
</template>