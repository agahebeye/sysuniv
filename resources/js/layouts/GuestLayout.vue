<template>
    <div class="flex h-[100vh] w-full">
        <header class="bg-gradient-to-b max-w-sm from-teal-200 to-white flex items-center">
             <div class="px-10 text-sm">
                <div>Republique du Burundi</div>
                <div>Ministere de l'education nationale et de la recherche scientifique</div>
            </div>
        </header>

        <main class="prose flex-grow flex items-center pl-20">
            <slot />
        </main>
    </div>
</template>