<script setup>
import { Link } from '@inertiajs/inertia-vue3';
defineProps({
    data: Array,
    links: Array
})
</script>
<template>
    <div class="mb-2 pagination" v-if="data.length > 15">
        <Component
            :is="link.url ? Link : 'span'"
            v-for="link in links"
            :href="link.url"
            v-html="link.label"
            class="px-1 text-xs no-underline"
            :class="{ 'text-black': link.url, 'font-bold': link.active }" />
    </div>
</template>