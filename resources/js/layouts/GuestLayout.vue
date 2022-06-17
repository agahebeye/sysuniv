<template>
    <div class="flex h-[100vh]">
        <header class="bg-gradient-to-b from-teal-200 to-white flex items-center">
             <div class="px-10 text-xs mt-4">
                <div>Republique du Burundi</div>
                <div>Ministere de l'education nationale et de la recherche scientifique</div>
            </div>
        </header>

        <main class="prose">
            <slot />
        </main>
    </div>
</template>