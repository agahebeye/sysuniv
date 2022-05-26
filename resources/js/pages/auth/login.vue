<script lang="ts" setup>
import { Head, useForm, usePage } from '@inertiajs/inertia-vue3';

const form = useForm({
    email: '',
    password: ''
});

</script>

<template>

    <Head>
        <title>Login - Sysuniv</title>
    </Head>
    <div>
        <h1>login</h1>

        <div class="errors" v-if="form.hasErrors">
            <div v-for="error in form.errors">{{ error }}</div>
        </div>

        <form @submit.prevent="form.post('/login')">
            <div>
                <label for="email">email</label>
                <input type="email" id="email" v-model="form.email" autocomplete="off" autofocus required>
            </div>

            <div>
                <label for="password">password</label>
                <input type="password" minlength="8" id="password" v-model="form.password" autocomplete="off" autofocus required>
            </div>

            <button>Login</button>
        </form>
    </div>
</template>