<script lang="ts" setup>
import { ref } from "vue";
import DefaultLayout from '~/layouts/default.vue';
import { Head, useForm } from "@inertiajs/inertia-vue3";
import Multiselect from 'vue-multiselect';
import axios from "axios";
import { useAuth } from "~/composables/auth";
import { Field } from "~/types/fields";
import ValidationErrorList from "~/components/shared/ValidationErrorList.vue";
import XButton from "~/components/shared/XButton.vue";

import { CheckIcon, ExclamationIcon } from '@heroicons/vue/solid';

const isLoading = ref(false);
const field = ref(null);

const registration_key = ref('');

const form = useForm({
    student: null,
    level: null,
    faculty_id: null,
    institute_id: null,
    department_id: null,
    university_id: useAuth().authedUser.id,
})

async function EnrollStudent() {
    isLoading.value = true;

    form.transform(function (data) {
        const transformedData = {
            level: data.level,
            university_id: data.university_id,
            department_id: data.department_id.id,
            [field.value == 0 ? 'faculty_id' : 'institute_id']: form.faculty_id?.id ?? form.institute_id?.id
        }

        return transformedData;
    }).post(`/registrations/${form.student.data.id}/store`);

    isLoading.value = false;
}

async function verifyStudent() {
    if (registration_key.value.length < 1)
        return;

    try {
        isLoading.value = true;
        await axios.get("/sanctum/csrf-cookie");
        const { data } = await axios.get(
            `/api/students/verify/${registration_key.value}`
        );

        form.student = data;
        isLoading.value = false;

    } catch (error) {
        isLoading.value = false;
    }
}

const props = defineProps<{
    faculties: Array<Field>,
    institutes: Array<Field>,
    departments: Array<Field>,
}>();

</script>

<template>

    <Head>
        <title>Inscrire nouvel étudiant - Ministère d'éducation au Burundi</title>
    </Head>

    <DefaultLayout>
        <div>
            <h1>Inscrire nouvel étudiant</h1>

            <ValidationErrorList v-if="form.hasErrors" :errors="form.errors" />

            <form @submit.prevent="EnrollStudent" class="w-max">
                <div v-if="!isLoading && form.student" class="">
                    <div class="flex items-center mb-4 space-x-2 text-sm font-bold" :class="{ 'alert': !form.student?.data, 'alert bg-green-300 text-green-700': form.student?.data }">
                        <Component
                            :is="form.student?.data ? CheckIcon : ExclamationIcon"
                            class="w-6 h-6" />
                        <span>{{ form.student?.message }}</span>
                    </div>
                </div>
                
                <div class="mb-4 max-w-fit">
                    <label :class="{ 'hidden': form.student?.data }">Taper le numéro matricule d'un étudiat puis appuyer sur <strong>&lt;&lt;Enter&gt;&gt;</strong></label>

                    <input type="text" class="mt-4 input"
                        v-model="registration_key"
                        @keydown.enter.prevent="verifyStudent"
                        :disabled="form.student?.data"
                        :class="{ 'border-none bg-gray-200': form.student?.data }"
                        required />

                    <svg v-if="isLoading" role="status" class="absolute right-0 inline w-4 h-4 mr-2 text-gray-200 bottom-3 animate-spin dark:text-white fill-teal-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                    </svg>
                </div>

                <div v-if="form.student?.data" class="mb-4">
                    <label for="field">choisir filière</label>
                    <div class="flex items-center space-x-2">
                        <input type="radio" class="radio" name="field" v-model="field" value="0"><span>Faculté</span>
                        <input type="radio" class="radio" name="field" v-model="field" value="1"><span>Institut</span>
                    </div>
                </div>

                <div v-if="field == 0" class="mb-4">
                    <label for="faculties">faculté</label>
                    <multiselect v-model="form.faculty_id" placeholder="choisir faculté" :options="faculties" label="name"
                        track-by="id">
                    </multiselect>
                </div>

                <div v-if="field == 1" class="mb-4">
                    <label for="institutes">institut</label>
                    <multiselect v-model="form.institute_id" placeholder="choisir institut" :options="institutes"
                        label="name" track-by="id">
                    </multiselect>
                </div>

                <div v-if="field" class="mb-4">
                    <label for="departments">department</label>
                    <multiselect v-model="form.department_id" placeholder="select a department" :options="departments"
                        label="name" track-by="id">
                    </multiselect>
                </div>

                <div v-if="form.department_id" class="mb-4">
                    <label for="level">choisir année</label>
                    <select name="level" id="level" v-model="form.level" class="bg-gray-50 border border-teal-300 text-gray-900 text-sm rounded-sm block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 outline-none dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="0">BAC I</option>
                        <option value="1">BAC II</option>
                        <option value="2">BAC III</option>
                    </select>
                </div>

                <x-button :processing="form.processing" v-if="form.level">Inscrire</x-button>
            </form>
        </div>
    </DefaultLayout>
</template>

<style src="vue-multiselect/dist/vue-multiselect.css">
</style>

