<script lang="ts" setup>
import { Inertia } from '@inertiajs/inertia';

defineProps<{
    students: any
}>()

function takeme(url: string) {
    Inertia.visit(url);
}
</script>

<template>
    <table class="w-[540px] table-fixed">
        <thead class="text-xs text-gray-700 uppercase bg-black dark:bg-gray-700 dark:text-gray-400">
            <tr class="text-left text-white">
                <th scope="col" class="pl-2 py-2">
                   nom 
                </th>
                <th scope="col" class="pl-2 py-2">
                   prénom 
                </th>
                <th scope="col" class="pl-2 py-2">
                   sexe
                </th>
                <th scope="col" class="pl-2 py-2">
                   Année de naissance
                </th>
            </tr>
        </thead>

        <tbody>
            <tr v-for="student in students" class="cursor-pointer hover:bg-gray-400 text-sm odd:bg-white even:bg-gray-200" @click="takeme(`/students/${student.id}`)" data-test="student">
                <td class="pl-2 py-2">{{ student.firstname }}</td>
                <td class="pl-2 py-2">{{ student.lastname }}</td>
                <td class="pl-2 py-2">{{ student.gender }}</td>
                <td class="pl-2 py-2">{{ student.birthDate }}</td>
            </tr>
        </tbody>

    </table>
</template>