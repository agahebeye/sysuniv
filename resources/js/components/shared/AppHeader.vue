<template>
    <header>
        <slot name="hamburger" />
        <img class="w-24" src="/storage/images/armoiries-bi.png" alt="armoiries du burundi" />
        <div class="mt-4">
            <div class="text-base">Ministere de l'education nationale et de la recherche scientifique</div>
            <div class="font-bold uppercase">Republique du Burundi</div>
            <slot />
        </div>
    </header>
</template>