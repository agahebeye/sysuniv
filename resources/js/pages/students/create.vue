<script lang="ts" setup>
import { useForm, Head } from "@inertiajs/inertia-vue3";
import DefaultLayout from '~/layouts/default.vue';
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

    <Head>
        <title>Create Student - Sysuniv</title>
    </Head>
    <DefaultLayout>

        <div class="">
            <h1>Créer un nouveau étudiant</h1>

            <ValidationErrorList v-if="form.hasErrors" :errors="form.errors" />

            <form @submit.prevent="createStudent" class="w-max">
                <div class="mb-4">
                    <label for="firstname">nom</label>
                    <input type="text" id="firstname" v-model="form.firstname" class="input" autocomplete="off" autofocus required>
                </div>

                <div class="mb-4">
                    <label for="lastname">prénom</label>
                    <input type="text" id="lastname" v-model="form.lastname" class="input" autocomplete="off" autofocus required>
                </div>

                <div class="mb-4">
                    <label for="gender">sexe</label>
                    <div class="flex items-center space-x-2">
                        <input type="radio" name="gender" value="Masculin" class="radio" v-model="form.gender"><span>masculin</span>
                        <input type="radio" name="gender" value="Féminin" class="radio" v-model="form.gender"><span>féminin</span>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="birth_date">Année de naissance</label>
                    <input type="date" id="birth_date" class="input" v-model="form.birth_date" required>
                </div>

                <div class="mb-4">
                    <label for="address">adresse</label>
                    <textarea id="address" rows="4" class="resize-none input" v-model="form.address" required></textarea>
                </div>

                <x-button :processing="form.processing">créer étudiant</x-button>
            </form>
        </div>
    </DefaultLayout>
</template>