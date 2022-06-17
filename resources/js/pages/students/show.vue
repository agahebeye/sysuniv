<script lang="ts" setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import { useAuth } from '~/composables/auth';
import ManIcon from '~/../assets/icons/Man.svg'
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
                    <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ student.firstname }} {{ student.lastname }}</h5>
                    <span class="text-sm text-gray-500 dark:text-gray-400">Visual Designer</span>
                    <div class="flex mt-4 space-x-3 lg:mt-6">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>