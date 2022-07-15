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
            <title>Create faculty - Sysuniv</title>
        </Head>

        <div class="">

            <h1>Créer une nouvelle faculté</h1>

            <ValidationErrorList v-if="form.hasErrors" :errors="form.errors" />

            <form @submit.prevent="form.post('/faculties/store')" class="w-max">
                <div class="mb-4">
                    <label for="name">nom</label>
                    <input type="text" id="name" class="input" v-model="form.name" autocomplete="off" autofocus required>
                </div>

                <x-button :processing="form.processing">créer faculté</x-button>
            </form>
        </div>
    </DefaultLayout>
</template>