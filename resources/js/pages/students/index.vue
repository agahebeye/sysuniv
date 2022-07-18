<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import DefaultLayout from '~/layouts/default.vue';
import { useAuth } from '~/composables/auth';
import StudentList from './components/StudentList.vue';
import { FilterIcon } from '@heroicons/vue/solid';
import FilterList from './components/FilterList.vue';
import StudentPagination from './components/StudentPagination.vue';

const { isUniversity } = useAuth();

const props = defineProps({
    students: Object,
    universities: Array,
});

</script>

<template>

    <Head>
        <title>Etudiants - Ministère d'éducation au Burundi</title>
    </Head>
    <DefaultLayout>

        <div>

            <h1>Etudiants</h1>

            <Link v-if="!isUniversity" href="/students/create" class="link">Enregistrer un nouveau étudiant</Link>
            <Link v-if="isUniversity" href="/registrations/create" class="link">Inscrire un nouveau étudiant</Link>

            <div v-if="students.data.length" class="flex flex-col mt-10 mb-8">
                <h2 class=""><strong>{{ students.data.length }}</strong> étudiant(s)</h2>
               <FilterList :universities="universities" /> 
            </div>

            <h2 class="mt-10 mb-8" v-else>{{ `${isUniversity ? 'Aucun étudiant a été inscrit' : 'Aucun étudiant a été enregistré'}` }}</h2>

            <StudentPagination :data="students.data" :links="students?.meta.links" />

            <StudentList v-if="students.data.length" :students="students.data" />
        </div>
    </DefaultLayout>
</template>