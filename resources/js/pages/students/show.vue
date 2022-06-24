<script lang="ts" setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import { useAuth } from '~/composables/auth';
import RegistrationList from './components/RegistrationList.vue';
const { isAdmin, isEmployee, isUniversity } = useAuth();

const props = defineProps<{
    student: any
}>();

</script>

<template>
    <div>

        <Head>
            <title>Students/{{ student.firstname }} - Sysuniv</title>
        </Head>

        <h1>Profile d'un étudiant</h1>

        <div>
            <div class="">
                <div class="flex flex-col pb-10">
                    <div class="rounded-full">
                        <img class="rounded-full w-36 max-w-full" :src="`/storage/${student.photo?.src ?? 'avatars/avatar-placeholder.jpeg'}`" :alt="student.firstname" />
                    </div>

                    <h2 class="">{{ student.firstname }} {{ student.lastname }}</h2>

                    <div class="space-y-1">
                        <div>Sexe: {{ student.gender }}</div>
                        <div>Habite à {{ student.address }}</div>
                        <div class="text-sm">Né(e) {{ student.birthDate }}</div>
                    </div>

                    <div class="mt-4" v-if="isUniversity">
                        <Link class="link" :href="`${student.id}/results/create`">Ajouter le resultat de cette année</Link>
                    </div>

                    <RegistrationList v-if="student.registrations.length" :registrations="student.registrations" />
                </div>
            </div>
        </div>
    </div>
</template>