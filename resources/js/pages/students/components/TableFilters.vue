<script setup>
import { reactive, ref } from 'vue';
import { useAuth } from '~/composables/auth';
const { isUniversity } = useAuth();

const filters = ref({});
const placeholders = reactive({
    university: '',
    level: '',
    mention: '',
}) // select box placeholder

function applyFilters() {
    console.log(filters.value);
}

defineProps({
    universities: {
        type: Array,
        required: true
    }
})

</script>

<template>
    <div
        class="z-10 grid w-full min-h-full grid-cols-2 gap-6 p-6 mt-2 overflow-y-auto text-sm bg-white border shadow-lg">
        <!--filters-->
        <div class="flex flex-col " v-if="!isUniversity">
            <label class="mb-2 font-bold">Université</label>
            <select v-model="placeholders.univeristy" @change="filters['university'] = $event.target.value">
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
            <select v-model="placeholders.level" name="level" id="level" @change="filters['level'] = $event.target.value">
                <option value="0">BAC I</option>
                <option value="1">BAC II</option>
                <option value="2">BAC III</option>
            </select>
        </div>

        <div>
            <label class="block mb-2 font-bold" for="type">Catégorie des étudiants</label>
            <select v-model="placeholders.mention" name="type" id="type" @change="filters['mention'] = $event.target.value">
                <option value="Réussi">Réussi</option>
                <option value="Echoué">Echoué</option>
                <option value="Abandonné">Abandonné</option>
            </select>
        </div>

        <div class="col-span-2 text-center">
            <button class="px-6 py-2 button" @click="applyFilters(); isFiltered = false">Appliquer</button>
        </div>
        <!--sort-->
    </div>
</template>

<style scoped>
input,
select {
    @apply outline-none;
}
</style>