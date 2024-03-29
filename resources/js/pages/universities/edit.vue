<script lang="ts" setup>
import { Head, useForm } from '@inertiajs/inertia-vue3';
import Multiselect from 'vue-multiselect';

import ValidationErrorList from '~/components/shared/ValidationErrorList.vue';
import XButton from '~/components/shared/XButton.vue';

import { User } from '~/types/users';
import { Field } from '~/types/fields';

const props = defineProps<{
    university: User,
    faculties: Array<Field>,
    institutes: Array<Field>,
    departments: Array<Field>,
}>();

const form = useForm({
    name: props.university.name,
    email: props.university.email,
    website: props.university.website,
    address: props.university.address,
    faculties: props.university['faculties'],
    institutes: props.university['institutes'],
    departments: props.university['departments'],
});

function updateUniversity() {
    form
        .transform((data) => ({
            ...data, faculties: data.faculties.map(faculty => faculty.id),
            institutes: data.institutes.map(institute => institute.id),
            departments: data.departments.map(department => department.id),
        }))
        .put(`/universities/${props.university.id}/update`);
}

</script>

<template>
    <div class="max-w-sm mx-auto">

        <Head>
            <title>Update University - Sysuniv</title>
        </Head>

        <h1>Update university</h1>

        <ValidationErrorList v-if="form.hasErrors" :errors="form.errors" />

        <form @submit.prevent="updateUniversity">
            <div class="mb-4">
                <label for="name">Name</label>
                <input type="text" id="name" v-model="form.name" class="input" autocomplete="off" autofocus>
            </div>

            <div class="mb-4">
                <label for="email">Email</label>
                <input type="email" id="email" v-model="form.email" class="input" autocomplete="off">
            </div>

            <div class="mb-4">
                <label for="email">Website</label>
                <input type="url" id="website" v-model="form.website" class="input" autocomplete="off">
            </div>

            <div class="mb-4">
                <label for="address" style="float: left">Address</label>
                <textarea name="address" id="address" rows="3" class="textarea" v-model="form.address"></textarea>
            </div>


            <div class="mb-4">
                <label for="faculties">Faculties</label>
                <multiselect v-model="form.faculties" placeholder="select faculties" :multiple="true"
                    :close-on-select="false" :options="faculties" label="name" track-by="id">
                </multiselect>
            </div>

            <div class="mb-4">
                <label for="institutes">Institutes</label>
                <multiselect v-model="form.institutes" placeholder="select institutes" :multiple="true"
                    :close-on-select="false" :options="institutes" label="name" track-by="id">
                </multiselect>
            </div>

            <div class="mb-4">
                <label for="departments">Departments</label>
                <multiselect v-model="form.departments" placeholder="select departments" :multiple="true"
                    :close-on-select="false" :options="departments" label="name" track-by="id" required>
                </multiselect>
            </div>

            <x-button :processing="form.processing">update university</x-button>
        </form>
    </div>
</template>

<style src="vue-multiselect/dist/vue-multiselect.css">
</style>
