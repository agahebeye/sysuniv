<script lang="ts" setup>
import { useForm, Head } from "@inertiajs/inertia-vue3";
import ValidationErrorList from '~/components/shared/ValidationErrorList.vue';
import XButton from '~/components/shared/XButton.vue';

const form = useForm({
    'firstname': null,
    'lastname': null,
    'gender': null,
    'birth_date': null,
    'address': null,
})

function createStudent() {
    form.post('/students/store');
}
</script>

<template>
    <div class="max-w-sm mx-auto">

        <Head>
            <title>Create Student - Sysuniv</title>
        </Head>

        <h1>Create new student</h1>

        <div class="errors" v-if="form.hasErrors">
            <div v-for="error in form.errors">{{ error }}</div>
        </div>

        <form @submit.prevent="createStudent">
            <div class="mb-4">
                <label for="firstname">Firstname</label>
                <input type="text" id="firstname" v-model="form.firstname" class="input" autocomplete="off" autofocus required>
            </div>

            <div class="mb-4">
                <label for="lastname">Lastname</label>
                <input type="text" id="lastname" v-model="form.lastname" class="input" autocomplete="off" autofocus required>
            </div>

            <div class="mb-4">
                <label for="gender">Gender</label>
                <div class="flex items-center space-x-2">
                    <input type="radio" name="gender" value="MALE" class="radio" v-model="form.gender"><span>MALE</span>
                    <input type="radio" name="gender" value="FEMALE" class="radio" v-model="form.gender"><span>FEMALE</span>
                </div>
            </div>

            <div class="mb-4">
                <label for="birth_date">Birth date</label>
                <input type="date" id="birth_date" class="input" v-model="form.birth_date" required>
            </div>

            <div class="mb-4">
                <label for="address">Address</label>
                <textarea id="address" rows="4" class="textarea" v-model="form.address" required></textarea>
            </div>

            <x-button :processing="form.processing">Create student</x-button>
        </form>
    </div>
</template>