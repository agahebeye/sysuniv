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
    <div>
        <H1>{{ title[status] }}</H1>
        <div>{{ description[status] }}</div>
    </div>
</template>
