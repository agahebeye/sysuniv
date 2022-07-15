<script lang="ts" setup>
import { Head, useForm } from '@inertiajs/inertia-vue3';
import DefaultLayout from '~/layouts/default.vue';
import ValidationErrorList from '~/components/shared/ValidationErrorList.vue';
import XButton from '~/components/shared/XButton.vue';

const form = useForm({
    name: '',
});
</script>

<template>

    <Head>
        <title>Créer institut - Ministère de l'education au Burundi</title>
    </Head>
    
    <DefaultLayout>

        <div class="">
            <h1>Créer un nouveau institut</h1>

            <ValidationErrorList v-if="form.hasErrors" :errors="form.errors" />

            <form @submit.prevent="form.post('/institutes/store')" class="w-max">
                <div class="mb-4">
                    <label for="name">nom</label>
                    <input type="text" id="name" class="input" v-model="form.name" autocomplete="off" autofocus required>
                </div>

                <x-button :processing="form.processing">Créer institut</x-button>
            </form>
        </div>
    </DefaultLayout>
</template>