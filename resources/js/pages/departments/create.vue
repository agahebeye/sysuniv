<script lang="ts" setup>
import { Head, useForm } from '@inertiajs/inertia-vue3';
import ValidationErrorList from '~/components/shared/ValidationErrorList.vue';
import XButton from '~/components/shared/XButton.vue';

import DefaultLayout from '~/layouts/default.vue';

const form = useForm({
    name: '',
});
</script>

<template>
    <DefaultLayout>

        <Head>
            <title>Créer département - Ministère d'éducation au Burunid</title>
        </Head>

        <div class="">


            <ValidationErrorList v-if="form.hasErrors" :errors="form.errors" />

            <form @submit.prevent="form.post('/departments/store')" class="w-max">
                <h1 class="max-w-fit">Créer un nouveau département</h1>
                <div class="mb-4">
                    <label for="name">nom</label>
                    <input type="text" id="name" class="input" v-model="form.name" autocomplete="off" autofocus required>
                </div>

                <x-button :processing="form.processing">créer département</x-button>
            </form>
        </div>
    </DefaultLayout>
</template>