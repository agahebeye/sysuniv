<script lang="ts" setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import DefaultLayout from '~/layouts/default.vue';
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

    <Head>
        <title>Edit university photo - Sysuniv</title>
    </Head>
    <DefaultLayout>
        <div class="w-max">
            <h1 class="">Ajouter une photo de l'université</h1>

            <ValidationErrorList v-if="form.hasErrors" :errors="form.errors" />

            <form @submit.prevent="updateUniversityPhoto" method="post" enctype="multipart/form-data" class="mt-10">
                <div class="mb-6">
                    <input type="file" @input="form.photo = $event.target['files']['0']" required class="input-file">
                </div>

                <x-button :processing="form.processing" class="!m-0 button-sm">Ajouter photo</x-button>

            </form>
        </div>
    </DefaultLayout>
</template>