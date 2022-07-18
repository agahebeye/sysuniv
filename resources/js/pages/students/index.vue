<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import DefaultLayout from '~/layouts/default.vue';
import { useAuth } from '~/composables/auth';
import StudentList from './components/StudentList.vue';
import { FilterIcon } from '@heroicons/vue/solid';
import StudentPagination from './components/StudentPagination.vue';
import { AdjustmentsIcon } from '@heroicons/vue/solid';
import { ref } from 'vue';

const { isUniversity } = useAuth();
const isFiltered = ref(false);

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

            <div v-if="students.data.length" class="relative flex flex-col mt-10 mb-8">
                <h2 class=""><strong>{{ students.data.length }}</strong> étudiant(s)</h2>
                <div class="relative">
                    <div @click="isFiltered = !isFiltered" class="flex mt-2 space-x-2 text-sm uppercase cursor-pointer">
                        <AdjustmentsIcon class="w-5 h-5" />
                        <span>filters</span>
                    </div>
                    
                    <div class="absolute right-0 top-2" v-if="!isFiltered">
                        <input id="search" class="max-w-[15rem] input py-1" placeholder="Rechercher..." />
                    </div>

                    <div v-if="isFiltered"
                        class="z-10 grid w-full min-h-full grid-cols-2 gap-6 p-6 mt-2 overflow-y-auto text-sm bg-white border shadow-lg">
                        <!--filters-->
                        <div class="flex flex-col ">
                            <label class="mb-2 font-bold">Université</label>
                            <select class="outline-none ">
                                <option v-for="university in universities">{{ university.name }}</option>
                            </select>
                        </div>
                        <!--universities-->
                        <div class="">
                            <label class="block mb-2 font-bold">Sexe</label>
                            <div class="flex items-center space-x-2">
                                <input type="radio" name="sexe" id=""><span>Féminin</span>
                                <input type="radio" name="sexe" id=""><span>Masculin</span>
                            </div>
                        </div>
                        <!--sexe-->
                        <div class="">
                            <label class="block mb-2 font-bold">Année</label>
                            <div class="flex items-center space-x-2">
                                <label for="">nouveaux inscripts</label>
                                <input type="checkbox" name="new_students" id="">
                            </div>
                            <div class="space-x-2">
                                <label for="start_date">inscrits entre</label>
                                <input type="text" id="start_date" class="w-10 mb-2 border-b-2 border-gray-300" />
                                <label for="end_date">et</label>
                                <input type="text" id="end_date" class="w-10 mb-2 border-b-2 border-gray-300" />
                            </div>

                        </div>
                        <!--annee-->
                        <div>
                            <label class="block mb-2 font-bold" for="level">Niveau</label>
                            <select name="level" id="level" class="outline-none">
                                <option value="0">BAC I</option>
                                <option value="1">BAC II</option>
                                <option value="2">BAC III</option>
                            </select>
                        </div>
                        <div>
                            <label class="block mb-2 font-bold" for="type">Catégorie des étudiants</label>
                            <select name="type" id="type" class="outline-none">
                                <option value="0">Réussi</option>
                                <option value="1">Echoué</option>
                                <option value="2">Abandonné</option>
                            </select>
                        </div>
                        <div class="col-span-2 text-center">
                            <button class="px-6 py-2 button" @click="isFiltered = false">Appliquer</button>
                        </div>
                        <!--sort-->
                    </div>
                </div>

            </div>

            <h2 class="mt-10 mb-8" v-else>{{ `${isUniversity ? 'Aucun étudiant a été inscrit' : 'Aucun étudiant a étéenregistré'}` }}</h2>

            <StudentPagination :data="students.data" :links="students?.meta.links" />

            <StudentList v-if="students.data.length" :students="students.data" />
        </div>
    </DefaultLayout>
</template>

<style scoped>
input {
    @apply outline-none;
}
</style>