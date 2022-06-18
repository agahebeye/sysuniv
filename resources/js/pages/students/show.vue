<script lang="ts" setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import { useAuth } from '~/composables/auth';
import RegistrationList from './components/RegistrationList.vue';
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

        <h1>Student's Profile</h1>

        <div>
            <div class="">
                <div class="flex flex-col pb-10">
                    <div v-if="student.photo">
                        <img :src="`/avatars/${student.photo.src}`" :alt="student.firstname" />
                    </div>

                    <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ student.firstname }} {{ student.lastname }}</h5>

                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        <span>{{ student.gender }},</span> <span>lives {{ student.address }}</span>
                    </div>

                    <div class="text-sm">Born {{ student.birthDate }}</div>

                    <div class="text-sm mt-4">
                        <Link class="font-bold text-teal-700" :href="`${student.id}/results/create`">Add result for this year</Link>
                    </div>

                    <RegistrationList v-if="student.registrations.length" :registrations="student.registrations" />
                </div>
            </div>
        </div>
    </div>
</template>