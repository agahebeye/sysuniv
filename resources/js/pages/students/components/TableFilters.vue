<script  setup>
import { onMounted, ref, watch } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { useAuth } from '~/composables/auth';
import { Inertia } from '@inertiajs/inertia';
import { AdjustmentsIcon, ExclamationIcon } from '@heroicons/vue/solid';
import axios from 'axios';

const { isUniversity } = useAuth();

const props = defineProps({
    filters: Object
});

const filters = ref(props.filters);
const isFiltered = ref(false);
const universities = ref([]);
const search = ref(filters.value['search'])

const form = useForm({
    university: filters.value['universities.name'] ?? null,
    gender: filters.value['gender'] ?? null,
    freshmen: filters.value['freshmen'] ?? null,
    start_date: filters.value['registrations.start_date'] ?? null,
    end_date: filters.value['registrations.end_date'] ?? null,
    level: filters.value['registrations.level'] ?? null,
    mention: filters.value['results.mention'] ?? null,
})

watch(search, value => {
    if (value.length > 0)
        Inertia.get('/students', { search: value }, { preserveState: true })
    else
        Inertia.get('/students')
})

function applyFilters() {
    let filters = {};

    if (form.isDirty) {
        for (const [k, v] of Object.entries(form.data())) {
            if (v) {
                switch (k) {
                    case 'university': filters['universities.name'] = v; break;
                    case 'level': filters['registrations.level'] = v; break;
                    case 'mention': filters['results.mention'] = v; break;
                    case 'start_date': filters['registrations.start_date'] = v; break;
                    case 'end_date': filters['registrations.end_date'] = v; break;
                    default: filters[k] = v;
                }
            }
        }

        isFiltered.value = false;
        Inertia.get('/students', { filter: filters }, { preserveState: true });
    }
}

function clearFilters() {
    form.reset();
}

onMounted(async () => {
    await axios.get("/sanctum/csrf-cookie");
    const { data } = await axios.get(`/api/universities`);

    universities.value = data;
});
</script>

<template>
    <div class="relative flex flex-col mb-8">
        <div @click="isFiltered = !isFiltered" class="flex mt-2 space-x-2 text-sm uppercase cursor-pointer">
            <AdjustmentsIcon class="w-5 h-5" />
            <span>filters</span>
        </div>

        <form class="absolute right-0 top-2" v-if="!isFiltered">
            <input id="search"
                class="max-w-[15rem] input py-1"
                placeholder="Rechercher..."
                v-model="search" />
        </form>

        <form
            v-if="isFiltered"
            @submit.prevent=""
            class="z-10 grid w-full min-h-full grid-cols-2 gap-6 p-6 mt-2 overflow-y-auto text-sm bg-white border shadow-lg">
            <!--filters-->
            <div v-if="form.hasErrors" class="flex items-center col-span-2 mb-4 space-x-2 text-sm font-medium alert">
                <ExclamationIcon class="w-6 h-6" />
                {{ form.errors.filters }}
            </div>

            <div class="flex flex-col " v-if="!isUniversity">
                <label class="mb-2 font-bold">Université</label>
                <select v-model="form.university">
                    <option v-for="university in universities">{{ university.name }}</option>
                </select>
            </div>
            <!--universities-->
            <div class="">
                <label class="block mb-2 font-bold">Sexe</label>
                <div class="flex items-center space-x-2">
                    <input type="radio" name="sexe" id="" v-model="form.gender" value="Féminin"><span>Féminin</span>
                    <input type="radio" name="sexe" id="" v-model="form.gender" value="Masculin"><span>Masculin</span>
                </div>
            </div>
            <!--sexe-->
            <div class="">
                <label class="block mb-2 font-bold">Année</label>
                <div class="flex items-center space-x-2">
                    <label for="">nouveaux inscripts</label>
                    <input type="checkbox" name="new_students" v-model="form.freshmen" id="">
                </div>

                <div class="space-x-2" v-if="!form.freshmen">
                    <label for="start_date">inscrits entre</label>
                    <input type="text" id="start_date" v-model="form.start_date" class="w-10 mb-2 border-b-2 border-gray-300" />
                    <label for="end_date">et</label>
                    <input type="text" id="end_date" v-model="form.end_date" class="w-10 mb-2 border-b-2 border-gray-300" />
                </div>

            </div>
            <!--annee-->
            <div>
                <label class="block mb-2 font-bold" for="level">Niveau</label>
                <select v-model="form.level" name="level" id="level">
                    <option value="0">BAC I</option>
                    <option value="1">BAC II</option>
                    <option value="2">BAC III</option>
                </select>
            </div>

            <div>
                <label class="block mb-2 font-bold" for="type">Catégorie des étudiants</label>
                <select v-model="form.mention" name="type" id="type">
                    <option value="Réussi">Réussi</option>
                    <option value="Echoué">Echoué</option>
                    <option value="Abandonné">Abandonné</option>
                </select>
            </div>

            <div class="col-span-2 space-x-4 text-center">
                <button class="px-6 py-2 button" type="button" @click="applyFilters">Appliquer</button>
                <button class="px-6 py-1.5 border border-teal-600" type="button" @click="clearFilters">Effacer</button>
            </div>
            <!--sort-->
        </form>
    </div>
</template>

<style scoped>
input,
select {
    @apply outline-none;
}
</style>