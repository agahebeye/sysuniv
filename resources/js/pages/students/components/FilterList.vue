<script setup>
import { Inertia } from '@inertiajs/inertia';
import { ref, watch } from 'vue';

const selectedUniversity = ref('');

defineProps({
    universities: Array
});


function universityChanged() {
    Inertia.get('/students', {
        filter: { university: selectedUniversity.value },
        search: { name: 'hello' }
    });
}
</script>

<template>
    <div class="flex items-center text-sm">
        <div>
            <select class="p-1 outline-none" v-model="selectedUniversity" @change="universityChanged()">
                <option v-for="university in universities">{{ university.name }}</option>
            </select>
        </div>
    </div>
</template>