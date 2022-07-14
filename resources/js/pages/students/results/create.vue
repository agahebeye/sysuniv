<script lang="ts" setup>
import { Head, useForm } from '@inertiajs/inertia-vue3';
import ValidationErrorList from '~/components/shared/ValidationErrorList.vue';
import XButton from '~/components/shared/XButton.vue';

const form = useForm({
    document: null,
    notes: '',
    mention: '',
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
            <div class="mb-4 space-y-4 mt-10">
                <label for="name" class="">Ajouter le bulettin</label>
                <input type="file" @input="form.document = $event.target['files']['0']" required class="input-file">
            </div>

            <div class="mb-4">
                <label for="notes">Notes (%)</label>
                <input type="text" id="notes" class="input" v-model="form.notes" autocomplete="off" autofocus required>
            </div>

            <div class="mb-4 space-y-2">
                <label for="mention">Mention</label>
                <div class="flex flex-col mt-2 space-y-2">
                    <div class="space-x-2">
                        <input type="radio" name="mention" value="Réussi" class="radio" v-model="form.mention"><span>Réussi</span>
                    </div>
                    <div class="space-x-2">
                        <input type="radio" name="mention" value="Réussi avec complément(s)" class="radio" v-model="form.mention"><span>Réussi avec complément(s)</span>
                    </div>
                    <div class="space-x-2">
                        <input type="radio" name="mention" value="Echoué" class="radio" v-model="form.mention"><span>Echoué</span>
                    </div>
                </div>
            </div>

            <x-button :processing="form.processing">Créer resultat</x-button>
        </form>
    </div>
</template>