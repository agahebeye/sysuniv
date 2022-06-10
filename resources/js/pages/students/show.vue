<script lang="ts" setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import { useAuth } from '~/composables/auth';
import { User } from '~/types/users';
const { isAdmin, isEmployee } = useAuth();

const props = defineProps<{
    student: any
}>();

</script>

<template>
    <div>

        <Head>
            <title>Students/{{ student.firstname }} - Sysuniv</title>
        </Head>

        <p v-if="isAdmin || isEmployee">
            <Link :href="`/students/${student.id}/edit`">Edit this student</Link>
        </p>

        <h1>
            <Link href="/students">Students</Link> / {{ student.firstname }} {{ student.lastname }}
        </h1>

        <div>{{ student }}</div>
    </div>
</template>