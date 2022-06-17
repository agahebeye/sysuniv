<script lang="ts" setup>
import { ref } from 'vue';

const shown = ref(false);

defineProps<{
    message?: string
}>()

</script>

<template>
    <div v-show="!shown" class="flex items-center px-6 py-4 dark:bg-green-800 dark:text-green-200 mb-4 md:max-w-4xl md:mx-auto">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
        </svg>

        <div class="ml-3 text-sm font-normal">{{ message }}</div>

        <button v-on:click="shown = true" type="button" class="ml-auto -mx-1.5 -my-1.5  text-gray-400 hover:text-gray-900  p-1.5  inline-flex h-8 w-8 dark:text-gray-500  dark:bg-gray-800" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
        </button>
    </div>
</template>