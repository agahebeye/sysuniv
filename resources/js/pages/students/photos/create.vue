<script lang="ts" setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import { User } from '~/types/users';

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
    <div>

        <Head>
            <title>Add student photo - Sysuniv</title>
        </Head>

        <h1>
            <Link href="/students">Students</Link>/
            <Link :href="`/students/${student.id}`">{{ student.firstname }}</Link>/Add student photo
        </h1>

        <div class="errors" v-if="form.hasErrors">
            <div v-for="error in form.errors">{{ error }}</div>
        </div>

        <form @submit.prevent="addStudentPhoto">
            <input type="file" @input="form.photo = $event.target['files']['0']" required>
            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                {{ form.progress.percentage }}%
            </progress><br />
            <button type="submit">Add</button>
        </form>
    </div>
</template>