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

        <h1>Request password reset</h1>

        <p>
            Let us know your email address and we will email you a password reset link that will allow you to choose a new
            one.
        </p>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <div class="errors" v-if="form.hasErrors">
            <div v-for="error in form.errors">{{ error }}</div>
        </div>

        <form @submit.prevent="form.post('/request-password-reset')">
            <div class="mb-4">
                <label for="email">Email</label>
                <input id="email" type="email" v-model="form.email" class="input" required autofocus autocomplete="username" />
            </div>

            <x-button :processing="form.processing">
                Email password reset link
            </x-button>
        </form>
    </div>
</template>