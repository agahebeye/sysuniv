<script lang="ts" setup>
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { useAuth } from '~/composables/auth';
import StudentList from './components/StudentList.vue';
const { isAdmin, isEmployee, isUniversity } = useAuth();

const props = defineProps<{
    students: any
}>();

function takeme(url: string) {
    Inertia.visit(url);
}

</script>

<template>
    <div>

        <Head>
            <title>Students - Sysuniv</title>
        </Head>

        <h1>Etudiants</h1>

        <Link v-if="isAdmin || isEmployee" href="/students/create" class="link">Enregistrer un nouveau étudiant</Link>
        <Link v-if="isUniversity" href="/registrations/create" class="link">Inscrire un nouveau étudiant</Link>

        <h2 class="mt-10 mb-8" v-if="students.data.length"><strong>{{ students.data.length }}</strong> étudiant(s)</h2>
        <h2 class="mt-10 mb-8" v-else>Aucun étudiant a été enregistré</h2>

        <div class="pagination mb-2" v-if="students.data.length > 1">
            <Component
                :is="link.url ? Link : 'span'"
                v-for="link in students.meta.links"
                :href="link.url"
                v-html="link.label"
                class="px-1 text-xs no-underline"
                :class="{ 'text-black': link.url, 'font-bold': link.active }" />
        </div>

        <StudentList v-if="students.data.length" :students="students.data" />
    </div>
</template>