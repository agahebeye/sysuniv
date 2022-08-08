<script setup>
import Armoiries from '~/../assets/images/armoiries-bi.svg';
</script>

<template>
    <header>
        <slot name="hamburger" />
        <Armoiries class="w-24 h-24" />
        <!-- <img class="w-24" :src="Armoiries" alt="armoiries du burundi" /> -->
        <div class="mt-4">
            <div class="text-base">Ministere de l'education nationale et de la recherche scientifique</div>
            <div class="font-bold uppercase">Republique du Burundi</div>
            <slot />
        </div>
    </header>
</template>