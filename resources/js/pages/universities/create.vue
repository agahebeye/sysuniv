<script lang="ts" setup>
import { Head, useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    website: '',
    address: '',
});
</script>

<template>

    <Head>
        <title>Create University - Sysuniv</title>
    </Head>
    
    <div>
        <h1>Add new university</h1>

        <div class="errors" v-if="form.hasErrors">
            <div v-for="error in form.errors">{{ error }}</div>
        </div>

        <form @submit.prevent="form.post('/universities/store')">
            <div>
                <label for="name">name</label>
                <input type="text" id="name" v-model="form.name" autocomplete="off" autofocus required>
            </div>

             <div>
                <label for="email">email</label>
                <input type="email" id="email" v-model="form.email" autocomplete="off" required>
            </div>

            <div>
                <label for="password">password</label>
                <input type="password" id="password" v-model="form.password" autocomplete="off" required>
            </div>

            <div>
                <label for="password_confirmation">re-enter password</label>
                <input type="password" id="password_confirmation" v-model="form.password_confirmation" autocomplete="off" required>
            </div>

            <div>
                <label for="email">website</label>
                <input type="url" id="website" v-model="form.website" autocomplete="off" required>
            </div>

            <div>
                <label for="address" style="float: left">address</label>
                <textarea name="address" id="address" v-model="form.address" cols="30" rows="10"></textarea>
            </div>

            <button>add</button>
        </form>
    </div>
</template>