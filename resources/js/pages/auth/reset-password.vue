<script setup>
import { Head, useForm, Link } from '@inertiajs/inertia-vue3';
import GuestLayout from '~/layouts/GuestLayout.vue';
import ValidationErrorList from '~/components/shared/ValidationErrorList.vue';
import XButton from '~/components/shared/XButton.vue';

const props = defineProps({
    email: String,
    token: String,
})

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

function submit() {
    form.post('/reset-password', {
        onFinish: () => form.reset('password', 'password_confirmation')
    });
}

</script>

<template>

    <Head>
        <title>Reset password - Sysuniv</title>
    </Head>

    <GuestLayout>
      
        
        <div class="px-6 mt-10 w-max">  <Link href="/registrations/create" class="inline-flex items-center mb-4 text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
        </svg>
        Accueil
        </Link>
            <h1>Réinitialiser mot de passe</h1>

            <ValidationErrorList v-if="form.hasErrors" :errors="form.errors" />

            <form @submit.prevent="submit" class="">
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
