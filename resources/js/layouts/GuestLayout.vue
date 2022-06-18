<template>
    <div class="flex h-[100vh] w-full">
        <header class="bg-gradient-to-b w-96 from-teal-200 to-white flex items-center">
             <div class="px-10 text-sm space-y-3">
                <div>Republique du Burundi</div>
                <div>Ministère de l'éducation nationale et de la recherche scientifique</div>
            </div>
        </header>

        <main class="prose max-w-none flex items-center pl-20 pr-6">
            <slot />
        </main>
    </div>
</template>