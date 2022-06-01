<script lang="ts" setup>
import { ref,reactive } from "vue";
import { Head } from "@inertiajs/inertia-vue3";
import {Inertia} from '@inertiajs/inertia';
import Multiselect from 'vue-multiselect';
import axios from "axios";
import { useAuth } from "~/composables/auth";

const errors = ref(null);
const isLoading = ref(false);
const domain = ref(null);

const verifiedStudent = ref(null);
const student_id = ref('');
const wasErrorCaught = ref(false);
const form = reactive({
    level: null,
    faculty_id: null,
    institute_id: null,
})

async function EnrollStudent() {
    const data = {
        level: form.level,
        user_id: useAuth().user.id,
        student_id: verifiedStudent.value.id,
        [domain.value == 0 ? 'faculty_id' : 'institute_id']: form.faculty_id?.id ?? form.institute_id?.id
    }

    Inertia.post('/registrations/store', data, {
        onError: (err) => {
            console.log(err);
            errors.value = err;
        }
    });
}

async function verifyStudent() {
    if (student_id.value.length > 0) {
        try {
            isLoading.value = true;
            await axios.get("/sanctum/csrf-cookie");
            const { data } = await axios.get(
                `/api/students/verify/${student_id.value}`
            );

            verifiedStudent.value = data;
            isLoading.value = false;
            wasErrorCaught.value = false;

        } catch (error) {
            isLoading.value = false;
            wasErrorCaught.value = true;
        }
    }
}

const props = defineProps<{
    faculties: Array<any>,
    institutes: Array<any>,
}>();

</script>

<template>
    <div>

        <Head>
            <title>Enroll new student - Sysuniv</title>
        </Head>

        <h1>Enroll new student</h1>

        <div class="errors" v-if="errors">
            <div v-for="error in errors">{{ error }}</div>
        </div>

        <form @submit.prevent>
            <p v-if="isLoading">verifying student's registration number...</p>
            <p v-if="!isLoading && wasErrorCaught">Oops! it seems you are not registered.</p>
            <label for="name" v-if="!verifiedStudent">Please enter student's registration number to verify</label><br>
            <input type="text" v-model="student_id" @keyup.enter="verifyStudent" required />
        </form>

        <form @submit.prevent="EnrollStudent" v-if="verifiedStudent">
            <div>
                <label for="domain">Choose Faculty/Institute</label>
                <select name="domain" id="domain" v-model="domain">
                    <option value="0">Faculty</option>
                    <option value="1">Institute</option>
                </select>
            </div>

            <div v-if="domain == 0">
                <label for="faculties">faculties</label>
                <multiselect v-model="form.faculty_id" placeholder="select a faculty" :options="faculties" label="name"
                    track-by="id">
                </multiselect>
            </div>

            <div v-if="domain == 1">
                <label for="institutes">institutes</label>
                <multiselect v-model="form.institute_id" placeholder="select an institute" :options="institutes"
                    label="name" track-by="id">
                </multiselect>
            </div>

            <div>
                <label for="level">Choose level</label>
                <select name="level" id="level" v-model="form.level">
                    <option value="0">BAC I</option>
                    <option value="1">BAC II</option>
                    <option value="2">BAC III</option>
                </select>
            </div>

            <button>Enroll</button>
        </form>
    </div>
</template>

<style src="vue-multiselect/dist/vue-multiselect.css">
</style>

