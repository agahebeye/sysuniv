<script lang="ts" setup>
import { Head, useForm } from '@inertiajs/inertia-vue3';
import ValidationErrorList from '~/components/shared/ValidationErrorList.vue';
import XButton from '~/components/shared/XButton.vue';

const props = defineProps<{
    student: any
}>();

const form = useForm({
    photo: null
});

function addStudentPhoto(e: any) {
    form
        .post(`/students/${props.student.id}/photos/store`)

}

</script>

<template>
    <div class="max-w-sm">

        <Head>
            <title>Add student photo - Sysuniv</title>
        </Head>

        <h1>Add student photo</h1>

        <ValidationErrorList v-if="form.hasErrors" :errors="form.errors" />

        <form @submit.prevent="addStudentPhoto">
            <div class="mb-6">
                <input type="file" @input="form.photo = $event.target['files']['0']" required class="input-file">
            </div>

            <x-button :processing="form.processing" class="!m-0 button-sm">Add photo</x-button>
        </form>
    </div>
</template>