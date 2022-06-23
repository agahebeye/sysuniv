<script lang="ts" setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import { User } from '~/types/users';

import ValidationErrorList from '~/components/shared/ValidationErrorList.vue';
import XButton from '~/components/shared/XButton.vue';

const props = defineProps<{
    university: User
}>();

const form = useForm({
    photo: null
});

function updateUniversityPhoto(e: any) {
    form
        .transform(data => ({ photo: data.photo, _method: 'put' }))
        .post(`/universities/${props.university.id}/photos/update`)

}

</script>

<template>
    <div class="max-w-sm">

        <Head>
            <title>Edit university photo - Sysuniv</title>
        </Head>

        <h1>Ajouter une photo de l'université</h1>

        <ValidationErrorList v-if="form.hasErrors" :errors="form.errors" />

        <form @submit.prevent="updateUniversityPhoto" method="post" enctype="multipart/form-data">
            <div class="mb-6">
                <input type="file" @input="form.photo = $event.target['files']['0']" required class="input-file">
                <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                    {{ form.progress.percentage }}%
                </progress>
            </div>

            <x-button :processing="form.processing" class="!m-0 button-sm">Ajouter photo</x-button>

        </form>
    </div>
</template>