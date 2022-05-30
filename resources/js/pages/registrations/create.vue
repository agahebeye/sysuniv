<script lang="ts" setup>
import { Head, useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    student: null,
    level: null,
    domain: null,
});
</script>

<template>

    <Head>
        <title>Enroll new student - Sysuniv</title>
    </Head>
    
    <div>
        <h1>Enroll new student</h1>

        <div class="errors" v-if="form.hasErrors">
            <div v-for="error in form.errors">{{ error }}</div>
        </div>

        <form @submit.prevent="">
            <div>
                <label for="name">student</label>
                <input type="text" id="name" v-model="form.student" autocomplete="off" autofocus required>
            </div>

            <button>Enroll</button>
        </form>
    </div>
</template>