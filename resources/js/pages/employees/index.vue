<script lang="ts" setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import { User } from '~/types/users';
import { useAuth } from '~/composables/auth';
import DefaultLayout from '~/layouts/default.vue';

const { isAdmin, isEmployee } = useAuth();

defineProps<{
    employees: any[]
}>();

</script>

<template>

    <Head>
        <title>Employées - Ministère d'éducation du Burundi</title>
    </Head>

    <DefaultLayout>
        <div>
            <h1>Employées</h1>

            <Link v-if="isAdmin || isEmployee" href="/employees/create" class="link">Créer une nouvelle employée</Link>

            <h2 class="mt-10 mb-8" v-if="employees.length"><strong>{{ employees.length }}</strong> employée(s)</h2>
            <h2 class="mt-10 mb-8" v-else>Aucune employée enregistrée à la base</h2>

            <div class="grid grid-cols-2 gap-6">
                <div v-for="employee in employees" class="flex items-center space-x-3" data-test="employee">
                    <img class="w-10 max-w-full rounded-full"
                        :src="`/storage/${employee.photo?.src ?? 'avatars/man_placeholder.png'}`"
                        :alt="employee.name" />
                    <div class="text-base">
                        {{ employee.name }}
                    </div>
                </div>
            </div>
        </div>
    </DefaultLayout>
</template>