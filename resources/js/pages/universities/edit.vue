<script lang="ts" setup>
import { Head, useForm } from '@inertiajs/inertia-vue3';
import Multiselect from 'vue-multiselect';
import { User } from '~/types/users';

type Domain = {
    id: number,
    name: string
}

const props = defineProps<{
    university: User,
    faculties: Array<Domain>,
    institutes: Array<Domain>,
}>();

const form = useForm({
    name: props.university.name,
    email: props.university.email,
    password: null,
    password_confirmation: null,
    website: props.university.website,
    address: props.university.address,
    faculties: [],
    institutes: []
});

function updateUniversity() {
    form
        .transform((data) => ({
            ...data, faculties: data.faculties.map(faculty => faculty.id),
            institutes: data.institutes.map(institute => institute.id),
        }))
        .put(`/universities/${props.university.id}/update`);
}

</script>

<template>


    <div>

        <Head>
            <title>Update University - Sysuniv</title>
        </Head>

        <h1>Update university</h1>

        <div class="errors" v-if="form.errors">
            <div v-for="error in form.errors">{{ error }}</div>
        </div>

        <form @submit.prevent="updateUniversity">
            <div>
                <label for="name">name</label>
                <input type="text" id="name" v-model="form.name" autocomplete="off" autofocus>
            </div>

            <div>
                <label for="email">email</label>
                <input type="email" id="email" v-model="form.email" autocomplete="off">
            </div>

            <div>
                <label for="password">password</label>
                <input type="password" id="password" v-model="form.password" autocomplete="off">
            </div>

            <div>
                <label for="password_confirmation">re-enter password</label>
                <input type="password" id="password_confirmation" v-model="form.password_confirmation"
                    autocomplete="off">
            </div>

            <div>
                <label for="email">website</label>
                <input type="url" id="website" v-model="form.website" autocomplete="off">
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

            <button>update</button>
        </form>
    </div>
</template>

<style src="vue-multiselect/dist/vue-multiselect.css">
</style>
