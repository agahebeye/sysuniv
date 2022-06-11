<script>
import { Head, useForm } from '@inertiajs/inertia-vue3';

import GuestLayout from '~/layouts/GuestLayout.vue';

export default {
    props: {
        email: String,
        token: String,
    },

    layout: GuestLayout,

    components: {
        Head
    },

    setup(props) {

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

        return { form, submit }
    }
}
</script>

<template>
    <div>

        <Head>
            <title>Reset password - Sysuniv</title>
        </Head>

        <h1>Reset password</h1>

        <form @submit.prevent="submit">
            <div>
                <label for="email" value="Email">email</label>
                <input id="email" type="email" v-model="form.email" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <label for="password" value="Password">password</label>
                <input id="password" type="password" v-model="form.password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <label for="password_confirmation" value="Confirm Password">confirm password</label>
                <input id="password_confirmation" type="password" v-model="form.password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Reset Password
                </button>
            </div>
        </form>
    </div>
</template>
