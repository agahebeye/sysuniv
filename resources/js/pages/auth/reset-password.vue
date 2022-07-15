<script setup>
import { Head, useForm } from '@inertiajs/inertia-vue3';
import GuestLayout from '~/layouts/GuestLayout.vue';
import ValidationErrorList from '~/components/shared/ValidationErrorList.vue';
import XButton from '~/components/shared/XButton.vue';

defineProps({
    email: String,
    token: String,
})


const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post('/reset-password', {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
}
}
</script>

<template>

    <Head>
        <title>Reset password - Sysuniv</title>
    </Head>

    <GuestLayout>
        <div>
            <h1>Réinitialiser mot de passe</h1>

            <ValidationErrorList v-if="form.hasErrors" :errors="form.errors" />

            <form @submit.prevent="submit">
                <div class="mb-4">
                    <label for="email" value="Email">email</label>
                    <input id="email" type="email" v-model="form.email" class="input w-96" required autofocus autocomplete="username" />
                </div>

                <div class="mb-4">
                    <label for="password" value="Password">mot de passe</label>
                    <input id="password" type="password" v-model="form.password" class="input w-96" required autocomplete="new-password" />
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" value="Confirm Password">confirm mot de passe</label>
                    <input id="password_confirmation" type="password" v-model="form.password_confirmation" class="input w-96" required autocomplete="new-password" />
                </div>

                <x-button :processing="form.processing">
                    réinitialiser
                </x-button>
            </form>
        </div>
    </GuestLayout>
</template>
