<script  setup>
import { reactive, ref } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { useAuth } from '~/composables/auth';
import { Inertia } from '@inertiajs/inertia';
const { isUniversity } = useAuth();

const form = useForm({
    university: null,
    gender: null,
    year: null,
    start_date: null,
    end_date: null,
    level: null,
    mention: null,
})

function applyFilters() {
    let filters = {};

    for (const [k, v] of Object.entries(form.data())) {
        if (v) {
            switch (k) {
                case 'university': filters['users.name'] = v; break;
                case 'level': filters['registrations.level'] = v; break;
                case 'mention': filters['results.level'] = v; break;
                default: filters[k] = v;
            }
        }
    }

    Inertia.get('/students', { filter: filters });
}

defineProps({
    universities: {
        type: Array,
        required: true
    }
})

</script>

<template>
    <form
        @submit.prevent="applyFilters"
        class="z-10 grid w-full min-h-full grid-cols-2 gap-6 p-6 mt-2 overflow-y-auto text-sm bg-white border shadow-lg">
        <!--filters-->
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
                <input type="checkbox" name="new_students" v-model="form.year" id="">
            </div>

            <div class="space-x-2">
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

        <div class="col-span-2 text-center">
            <button class="px-6 py-2 button">Appliquer</button>
        </div>
        <!--sort-->
    </form>
</template>

<style scoped>
input,
select {
    @apply outline-none;
}
</style>