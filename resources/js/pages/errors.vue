<script lang="ts" setup>
import { ref } from 'vue';

const title = ref({
    503: '503: Service Unavailable',
    500: '500: Server Error',
    404: '404: Page Not Found',
    403: '403: Forbidden',
});

const description = ref({
    503: 'Sorry, we are doing some maintenance. Please check back soon.',
    500: 'Whoops, something went wrong on our servers.',
    404: 'Sorry, the page you are looking for could not be found.',
    403: 'Sorry, you are forbidden from accessing this page.',
});

defineProps({
    status: Number
});
</script>

<template>
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                    {{ title[status] }}
                </div>

                <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                    {{ description[status] }}
                </div>
            </div>
        </div>
    </div>
</template>
