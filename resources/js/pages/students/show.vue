<script lang="ts" setup>
import { computed } from 'vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import DefaultLayout from '~/layouts/default.vue';
import { useAuth } from '~/composables/auth';
import RegistrationList from './components/RegistrationList.vue';

const props = defineProps<{
    student: any,
    latestRegistration?: any,
}>();

console.log(props.latestRegistration)

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

                        <div class="mt-4" v-if="useAuth().isUniversity.value && !latestRegistration.result">
                            <Link class="link" :href="`${ student.id } /results/create`">Ajouter le resultat de cette année</Link>
                        </div>

                        <div class="mt-4" v-if="useAuth().isUniversity.value && !latestRegistration.hasAbandoned">
                            <Link class="p-2 text-white bg-red-600 border-none link" as="button" method="put" :href="`${ student.id } /abandon`">Marquer abandonné(e)</Link>
                        </div>

                        <RegistrationList v-if="student.registrations.length" :registrations="student.registrations" />
                    </div>
                </div>
            </div>
        </div>
    </DefaultLayout>
</template>