<script lang="ts" setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import { User } from '~/types/users';

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
    <div>

        <Head>
            <title>Edit university photo - Sysuniv</title>
        </Head>

        <h1>
            <Link href="/universities">Universities</Link>/
            <Link :href="`/universities/${university.id}`">{{ university.name }}</Link>/Edit university photo
        </h1>

        <div class="errors" v-if="form.hasErrors">
            <div v-for="error in form.errors">{{ error }}</div>
        </div>

        <form @submit.prevent="updateUniversityPhoto" method="post" enctype="multipart/form-data">
            <input type="file" @input="form.photo = $event.target['files']['0']" required>
            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                {{ form.progress.percentage }}%
            </progress><br />
            <button type="submit">update</button>
        </form>
    </div>
</template>