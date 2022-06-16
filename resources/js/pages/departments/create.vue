<script lang="ts" setup>
import { Head, useForm } from '@inertiajs/inertia-vue3';
import ValidationErrorList from '~/components/shared/ValidationErrorList.vue';
import XButton from '~/components/shared/XButton.vue';

const form = useForm({
    name: '',
});
</script>

<template>

    <div class="max-w-sm mx-auto">

        <Head>
            <title>Create department - Sysuniv</title>
        </Head>

        <h1>Create new department</h1>

        <ValidationErrorList v-if="form.hasErrors" :errors="form.errors" />

        <form @submit.prevent="form.post('/departments/store')">
            <div class="mb-4">
                <label for="name">Name</label>
                <input type="text" id="name" class="input" v-model="form.name" autocomplete="off" autofocus required>
            </div>

            <x-button :processing="form.processing">create department</x-button>
        </form>
    </div>
</template>