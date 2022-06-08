<script lang="ts" setup>
import { useForm, Head } from "@inertiajs/inertia-vue3";

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
    <div>

        <Head>
            <title>Create Student - Sysuniv</title>
        </Head>

        <h1>Create new student</h1>

        <div class="errors" v-if="form.hasErrors">
            <div v-for="error in form.errors">{{ error }}</div>
        </div>

        <form @submit.prevent="createStudent">
            <div>
                <label for="firstname">firstname</label>
                <input type="text" id="firstname" v-model="form.firstname" autocomplete="off" autofocus required>
            </div>

            <div>
                <label for="lastname">lastname</label>
                <input type="text" id="lastname" v-model="form.lastname" autocomplete="off" autofocus required>
            </div>

            <div>
                <label for="gender">gender</label>
                <input type="radio" name="gender" value="MALE" v-model="form.gender">MALE
                <input type="radio" name="gender" value="FEMALE" v-model="form.gender">FEMALE
            </div>

            <div>
                <label for="birth_date">birth date</label>
                <input type="date" id="birth_date" v-model="form.birth_date" required>
            </div>

            <div>
                <label for="address">address</label>
                <textarea id="address" v-model="form.address" required></textarea>
            </div>

            <button>create</button>
        </form>
    </div>
</template>