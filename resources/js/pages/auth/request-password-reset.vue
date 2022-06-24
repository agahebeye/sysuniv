<script>
import { Head, useForm } from '@inertiajs/inertia-vue3';
import GuestLayout from '~/layouts/GuestLayout.vue';
import XButton from '~/components/shared/XButton.vue';

export default {
    props: {
        status: String
    },

    layout: GuestLayout,

    components: {
        Head,
        XButton
    },

    setup() {
        const form = useForm({
            email: '',
        });

        return {
            form
        }
    }
}
</script>

<template>
    <div class="max-w-sm">

        <Head>
            <title>Reset password link - Sysuniv</title>
        </Head>

        <h1>Demande de réinitialisation de mot de passe</h1>

        <p>
            Informez-nous de votre email et on vous enverra le lien qui vous dirigera vers la page de réinitialisation de mot de passe
        </p>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <div class="errors" v-if="form.hasErrors">
            <div v-for="error in form.errors">{{ error }}</div>
        </div>

        <form @submit.prevent="form.post('/request-password-reset')">
            <div class="mb-4">
                <label for="email">email</label>
                <input id="email" type="email" v-model="form.email" class="input" required autofocus autocomplete="username" />
            </div>

            <x-button :processing="form.processing">
                lien de réinitialisation
            </x-button>
        </form>
    </div>
</template>