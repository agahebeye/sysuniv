<script lang="ts" setup>
import { ref } from "vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import Multiselect from 'vue-multiselect';
import axios from "axios";
import { useAuth } from "~/composables/auth";

const isLoading = ref(false);
const domain = ref(null);

const verifiedStudent = ref(null);
const student_id = ref(null);
const wasErrorCaught = ref(false);

const form = useForm({
    level: null,
    faculty_id: null,
    institute_id: null,
});

async function EnrollStudent() {
    form.transform((data) => ({
        level: data.level,
        user_id: useAuth().user.id,
        student_id: verifiedStudent.value.id
    })).post('/registrations/store');
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

        <div class="errors" v-if="form.hasErrors">
            <div v-for="error in form.errors">{{ error }}</div>
        </div>

        <div>
            <p v-if="isLoading">verifying student's registration number...</p>
            <p v-if="!isLoading && wasErrorCaught">Oops! it seems you are not registered.</p>
            <label for="name">student</label>
            <input type="text" v-model="student_id" @keyup.enter="verifyStudent" required />
        </div>

        <form @submit.prevent="EnrollStudent">


            <div>
                <label for="domain">Choose Faculty/Institute</label>
                <select name="domain" id="domain" v-model="domain">
                    <option value="0">Faculty</option>
                    <option value="1">Institute</option>
                </select>
            </div>

            <div v-if="domain == 0">
                <label for="faculties">faculties</label>
                <multiselect v-model="form.faculty_id" placeholder="select a faculty" :close-on-select="false"
                    :options="faculties" label="name" track-by="id">
                </multiselect>
            </div>

            <div v-if="domain == 1">
                <label for="institutes">institutes</label>
                <multiselect v-model="form.institute_id" placeholder="select an institute" :close-on-select="false"
                    :options="institutes" label="name" track-by="id">
                </multiselect>
            </div>

            <div>
                <label for="level">Choose level</label>
                <select name="level" id="level" v-model="form.level">
                    <option value="0">BAC I</option>
                    <option value="1">BAC II</option>
                    <option value="2">BAC II</option>
                </select>
            </div>

            <button>Enroll</button>
        </form>
    </div>
</template>

<style src="vue-multiselect/dist/vue-multiselect.css">
</style>

