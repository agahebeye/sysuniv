<script lang="ts" setup>
import { ref } from "vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from '@inertiajs/inertia';
import Multiselect from 'vue-multiselect';
import axios from "axios";
import { useAuth } from "~/composables/auth";
import { Field } from "~/types/fields";

const isLoading = ref(false);
const field = ref(null);

const registration_key = ref('');

const form = useForm({
    student: '',
    level: null,
    faculty_id: null,
    institute_id: null,
    department_id: null,
    university_id: useAuth().user.id,
})

async function EnrollStudent() {
    form.transform(function (data) {
        const transformedData = {
            level: data.level,
            university_id: data.university_id,
            department_id: data.department_id.id,
            [field.value == 0 ? 'faculty_id' : 'institute_id']: form.faculty_id?.id ?? form.institute_id?.id
        }

        return transformedData;
    }).post(`/registrations/${form.student}/store`);
}

async function verifyStudent() {
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
    <div>

        <Head>
            <title>Enroll new student - Sysuniv</title>
        </Head>

        <h1>Enroll new student</h1>

        <div class="errors" v-if="form.errors">
            <div v-for="error in form.errors">{{ error }}</div>
        </div>

        <form @submit.prevent="EnrollStudent">
            <div>
                <p v-if="isLoading">Verifying...</p>
                <label for="name" v-if="!form.student">Please enter a student's registration number</label><br>
                <input type="text" v-model="registration_key" @keydown.enter.prevent="verifyStudent"
                    :disabled="form.student.length > 0" required />
            </div>

            <div v-if="form.student">
                <label for="field">Choose field</label><br />
                <input type="radio" name="field" v-model="field" value="0">Faculty
                <input type="radio" name="field" v-model="field" value="1">Institute
            </div>

            <div v-if="field == 0">
                <label for="faculties">faculties</label>
                <multiselect v-model="form.faculty_id" placeholder="select a faculty" :options="faculties" label="name"
                    track-by="id">
                </multiselect>
            </div>

            <div v-if="field == 1">
                <label for="institutes">institutes</label>
                <multiselect v-model="form.institute_id" placeholder="select an institute" :options="institutes"
                    label="name" track-by="id">
                </multiselect>
            </div>

            <div v-if="field">
                <label for="departments">departments</label>
                <multiselect v-model="form.department_id" placeholder="select a department" :options="departments"
                    label="name" track-by="id">
                </multiselect>
            </div>

            <div v-if="form.faculty_id || form.institute_id">
                <label for="level">Choose level</label>
                <select name="level" id="level" v-model="form.level">
                    <option value="0">BAC I</option>
                    <option value="1">BAC II</option>
                    <option value="2">BAC III</option>
                </select>
            </div>

            <button v-if="form.level">Enroll</button>
        </form>
    </div>
</template>

<style src="vue-multiselect/dist/vue-multiselect.css">
</style>

