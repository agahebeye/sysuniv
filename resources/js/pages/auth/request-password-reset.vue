<script setup>
import { Head, useForm, Link } from '@inertiajs/inertia-vue3';
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
            <Link href="/registrations/create" class="inline-flex items-center mb-4 text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
            </svg>
            Accueil
            </Link>
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