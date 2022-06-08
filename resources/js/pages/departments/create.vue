<script lang="ts" setup>
import { Head, useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    name: '',
});
</script>

<template>

    <Head>
        <title>Create Department - Sysuniv</title>
    </Head>
    
    <div>
        <h1>Create new department</h1>

        <div class="errors" v-if="form.hasErrors">
            <div v-for="error in form.errors">{{ error }}</div>
        </div>

        <form @submit.prevent="form.post('/departments/store')">
            <div>
                <label for="name">name</label>
                <input type="text" id="name" v-model="form.name" autocomplete="off" autofocus required>
            </div>

            <button>create</button>
        </form>
    </div>
</template>