<script lang="ts" setup>
import { computed } from 'vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import DefaultLayout from '~/layouts/default.vue';
import { useAuth } from '~/composables/auth';
import RegistrationList from './components/RegistrationList.vue';
import { ExclamationCircleIcon } from '@heroicons/vue/solid';

const { isUniversity, auth } = useAuth();

const props = defineProps<{
    student: any,
    latestRegistration?: any,
}>();

const avatarPlaceHolder = computed(() =>
    props.student.gender == 'Masculin' ? 'man_placeholder.png'
        : 'woman_placeholder.png'
);

</script>

<template>

    <Head>
        <title>Etudiant {{ student.firstname }} - Ministère d'éducation au Burundi</title>
    </Head>
    <DefaultLayout>
        <div>
            <h1>Profil étudiant</h1>

            <div>
                <div class="">
                    <div class="flex flex-col pb-10">
                        <div class="rounded-full">
                            <img class="max-w-full rounded-full w-36"
                                :src="`/storage/${student.photo?.src ?? 'avatars/' + avatarPlaceHolder}`"
                                :alt="student.firstname" />
                        </div>

                        <h2 class="">{{ student.firstname }} {{ student.lastname }}</h2>

                        <div class="space-y-1">
                            <div>Sexe: {{ student.gender }}</div>
                            <div>Habite à {{ student.address }}</div>
                            <div class="text-sm">Né(e) {{ student.birthDate }}</div>
                        </div>

                        <template v-if="isUniversity && auth.id === latestRegistration?.university_id">
                                <div class="mt-4 space-y-4" v-if="latestRegistration && !latestRegistration?.result && !latestRegistration.has_abandoned">
                                    <Link class="block link w-max" :href="`${student.id} /results/create`">Ajouter le resultat de cette année</Link>
                                    <Link class="p-2 text-white bg-red-600 bl border-noke link" as="button" method="put" :href="`${student.id}/abandon`">Marquer abandonné(e)</Link>
                                </div>

                                <div class="mt-4" v-if="!latestRegistration?.result && latestRegistration?.has_abandoned">
                                    <Link class="text-gray-800 link" as="button" method="put" :href="`${student.id}/abandon`">Marquer pas abandonné(e)</Link>
                                </div>
                        </template>

                        <RegistrationList v-if="student.registrations.length" :registrations="student.registrations" />
                        <div class="flex mt-4 space-x-2 text-sm font-bold text-gray-600" v-else>
                            <ExclamationCircleIcon class="w-5 h-5" />
                            <p>Cet étudiant n'a fréquenté aucune université</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </DefaultLayout>
</template>