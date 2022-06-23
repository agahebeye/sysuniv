<script lang="ts" setup>
import { Head, useForm } from '@inertiajs/inertia-vue3';
import Multiselect from 'vue-multiselect';
import ValidationErrorList from '~/components/shared/ValidationErrorList.vue';
import XButton from '~/components/shared/XButton.vue';

type Field = {
    id: number,
    name: string
}

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    website: '',
    address: '',
    faculties: [],
    institutes: [],
    departments: [],
});

function createUniversity() {
    form.transform(data => ({
        ...data,
        faculties: data.faculties.map(faculty => faculty.id),
        institutes: data.institutes.map(institute => institute.id),
        departments: data.departments.map(department => department.id),
    })).post('/universities/store');
}

defineProps<{
    faculties: Array<Field>,
    institutes: Array<Field>,
    departments: Array<Field>,
}>();
</script>

<template>
    <div class="max-w-sm">

        <Head>
            <title>Create University - Sysuniv</title>
        </Head>
        <h1>Créer une nouvelle université</h1>

        <ValidationErrorList v-if="form.hasErrors" :errors="form.errors" />

        <form @submit.prevent="createUniversity">
            <div class="mb-4">
                <label for="name">nom</label>
                <input type="text" id="name" v-model="form.name" class="input" autocomplete="off" autofocus required>
            </div>

            <div class="mb-4">
                <label for="email">email</label>
                <input type="email" id="email" v-model="form.email" class="input" autocomplete="off" required>
            </div>

            <div class="mb-4">
                <label for="password">mot de passe</label>
                <input type="password" id="password" v-model="form.password" class="input" autocomplete="off" required>
            </div>

            <div class="mb-4">
                <label for="password_confirmation">confirmer mot de passe</label>
                <input type="password" id="password_confirmation"
                    v-model="form.password_confirmation"
                    class="input"
                    autocomplete="off" required>
            </div>

            <div class="mb-4">
                <label for="email">siteweb</label>
                <input type="url" id="website" v-model="form.website" class="input" autocomplete="off" required>
            </div>

            <div class="mb-4">
                <label for="address" style="float: left">adresse</label>
                <textarea name="address" id="address"
                rows="4" class="textarea"
                 v-model="form.address" required></textarea>
            </div>


            <div class="mb-4">
                <label for="faculties">facultés</label>
                <multiselect v-model="form.faculties" placeholder="choisir facultés" :multiple="true"
                    :close-on-select="false" :options="faculties" label="name" track-by="id" required>
                </multiselect>
            </div>

            <div class="mb-4">
                <label for="institutes">instituts</label>
                <multiselect v-model="form.institutes" placeholder="choisir instituts" :multiple="true"
                    :close-on-select="false" :options="institutes" label="name" track-by="id" required>
                </multiselect>
            </div>

            <div class="mb-4">
                <label for="departments">departements</label>
                <multiselect v-model="form.departments" placeholder="choisir departmeents" :multiple="true"
                    :close-on-select="false" :options="departments" label="name" track-by="id" required>
                </multiselect>
            </div>

            <x-button>créer université</x-button>
        </form>
    </div>
</template>

<style src="vue-multiselect/dist/vue-multiselect.css">
</style>
