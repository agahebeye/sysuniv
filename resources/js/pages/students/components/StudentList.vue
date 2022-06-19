<script setup>
defineProps({
    students: Array
})
</script>

<template>
    <table class="max-w-md">
        <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="pl-2 py-2">
                    firstname
                </th>
                <th scope="col" class="px-4 py-2">
                    lastname
                </th>
            </tr>
        </thead>

        <tbody>
            <tr v-for="student in students" class="cursor-pointer hover:bg-gray-100" @click="takeme(`/students/${student.id}`)" data-test="student">
                <td class="pl-2 py-1">{{ student.firstname }}</td>
                <td class="pl-2 py-1">{{ student.lastname }}</td>
            </tr>
        </tbody>

    </table>
</template>