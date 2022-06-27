<script lang="ts" setup>
import { Head, useForm } from '@inertiajs/inertia-vue3';
import ValidationErrorList from '~/components/shared/ValidationErrorList.vue';
import XButton from '~/components/shared/XButton.vue';

const form = useForm({
    notes: '',
    credits: '',
});

defineProps<{
    student: any
}>()
</script>

<template>

    <div class="max-w-sm">

        <Head>
            <title>Create faculty - Sysuniv</title>
        </Head>

        <h1>Créer le resultat de {{ student.firstname }} {{ student.lastname }}</h1>

        <div class="text-xs mb-4">
            <span class="font-bold">Note: </span>Cet resultat fait réference à l'inscription de cette année
        </div>

        <ValidationErrorList v-if="form.hasErrors" :errors="form.errors" />

        <form @submit.prevent="form.put(`/students/${student.id}/results/update`)">
            <div class="mb-4">
                <label for="name">Notes (%)</label>
                <input type="text" id="name" class="input" v-model="form.notes" autocomplete="off" autofocus required>
            </div>

            <div class="mb-4">
                <label for="name">Complément(s)</label>
                <input type="text" id="name" class="input" v-model="form.credits" autocomplete="off" autofocus required>
            </div>

            <x-button :processing="form.processing">Créer resultat</x-button>
        </form>
    </div>
</template>