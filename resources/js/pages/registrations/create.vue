<script lang="ts" setup>
import { ref } from "vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import Multiselect from "vue-multiselect";
import axios from "axios";

const isLoading = ref(false);

const form = useForm({
    student_number: null,
    students: [],
    level: null,
    domain: null,
});

async function verifyStudentId() {
    try {
        isLoading.value = true;
        await axios.get("/sanctum/csrf-cookie");
        await axios.get(`/api/students/registrations/${form.student_number}`);
        isLoading.value = false;
    } catch (error) {
        console.log(error);
    }
}

async function verifyStudentLevel() {
    console.log("changed");
}
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

        <form @submit.prevent="">
            <div>
                <label for="name">student</label>
                <input
                    type="text"
                    v-model="form.student_number"
                    @input="verifyStudentId"
                />
            </div>

            <div>
                <label for="domain">Choose Faculty/Institute</label>
                <select name="domain" id="domain" v-model="form.domain">
                    <option value="0">Faculty</option>
                    <option value="1">Institute</option>
                </select>
            </div>

            <div>
                <label for="level">Choose level</label>
                <select
                    @change="verifyStudentLevel"
                    name="level"
                    id="level"
                    v-model="form.level"
                >
                    <option value="0">BAC I</option>
                    <option value="1">BAC II</option>
                    <option value="2">BAC II</option>
                </select>
            </div>

            <button>Enroll</button>
        </form>
    </div>
</template>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>
