<script lang="ts" setup>
import { Head, useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';
import Multiselect from 'vue-multiselect';


type Domain = {
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
    institutes: []
});

function addNewUniversity() {
    form.transform(data => ({
        ...data,
        faculties: data.faculties.map(({ id }) => id),
        institutes: data.institutes.map(({ id }) => id),
    })).post('/universities/store');
}

defineProps<{
    faculties: Array<Domain>,
    institutes: Array<Domain>,
}>();
</script>

<template>

    <Head>
        <title>Create University - Sysuniv</title>
    </Head>

    <div>
        <h1>Add new university</h1>

        <div class="errors" v-if="form.hasErrors">
            <div v-for="error in form.errors">{{ error }}</div>
        </div>

        <form @submit.prevent="addNewUniversity">
            <div>
                <label for="name">name</label>
                <input type="text" id="name" v-model="form.name" autocomplete="off" autofocus required>
            </div>

            <div>
                <label for="email">email</label>
                <input type="email" id="email" v-model="form.email" autocomplete="off" required>
            </div>

            <div>
                <label for="password">password</label>
                <input type="password" id="password" v-model="form.password" autocomplete="off" required>
            </div>

            <div>
                <label for="password_confirmation">re-enter password</label>
                <input type="password" id="password_confirmation" v-model="form.password_confirmation"
                    autocomplete="off" required>
            </div>

            <div>
                <label for="email">website</label>
                <input type="url" id="website" v-model="form.website" autocomplete="off" required>
            </div>

            <div>
                <label for="address" style="float: left">address</label>
                <textarea name="address" id="address" v-model="form.address" cols="30" rows="10"></textarea>
            </div>


            <div>
                <label for="faculties">faculties</label>
                <multiselect v-model="form.faculties" placeholder="select faculties" :multiple="true"
                    :close-on-select="false" :options="faculties" label="name" track-by="id">
                </multiselect>

            </div>

            <div>
                <label for="institutes">institutes</label>
                <multiselect v-model="form.institutes" placeholder="select institutes" :multiple="true"
                    :close-on-select="false" :options="institutes" label="name" track-by="id">
                </multiselect>

            </div>
            <button>add</button>
        </form>
    </div>
</template>

<style src="vue-multiselect/dist/vue-multiselect.css">
</style>
