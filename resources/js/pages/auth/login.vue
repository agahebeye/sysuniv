<script>
import { Head, useForm } from '@inertiajs/inertia-vue3';
import GuestLayout from '~/layouts/GuestLayout.vue';

export default {
    layout: GuestLayout,

    components: {
        Head
    },

    setup() {
        const form = useForm({
            email: '',
            password: ''
        });

        return {
            form
        }
    }
}



</script>

<template>
    <div class="prose mx-auto max-w-md">

        <Head>
            <title>Login - Sysuniv</title>
        </Head>

        <h1>login</h1>

        <div class="errors" v-if="form.hasErrors">
            <div v-for="error in form.errors">{{ error }}</div>
        </div>

        <form @submit.prevent="form.post('/login')">
            <div class="mb-4">
                <label for="email">email</label>
                <input type="email" id="email" v-model="form.email" class="input input-bordered w-full" autocomplete="off" autofocus required>
            </div>

            <div class="mb-4">
                <label for="password">password</label>
                <input type="password" minlength="8" id="password" v-model="form.password" class="input input-bordered w-full" autocomplete="off" autofocus
                    required>
            </div>

            <div class="text-center">
                <button class="btn btn-primary btn-wide">Login</button>
            </div>
        </form>
    </div>
</template>