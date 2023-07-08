<script setup>
import Base from '@/Components/Blog/Base.vue';
import ListNav from '@/Components/Blog/ListNav.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps([
    'copyrightYear',
    'navLinks',
    'author',
    'publications',
    'prevPageUrl',
    'nextPageUrl',
]);
</script>

<template>
    <Base :copyrightYear="copyrightYear" :navLinks="navLinks" :author="author">
        <ListNav :prevPageUrl="prevPageUrl" :nextPageUrl="nextPageUrl" unit-name="publications"></ListNav>

        <div id="publication-list" class="container-full">
            <article v-for="publication in publications" :key="publication.title" class="mb-8 px-8 md:px-0">
                <header>
                    <h2>
                        <Link :href="publication.url">{{ publication.title }}</Link>
                    </h2>
                    <div class="bg-slate-500 inline-block text-sm text-white py-1 px-2 rounded-md font-bold">
                        {{ publication.type }}
                    </div>
                    <div class="font-bold">Published on {{ publication.publishDate }} @ {{ publication.source }}</div>
                </header>
                <div v-html="publication.description">
                </div>
            </article>
        </div>

        <ListNav :prevPageUrl="prevPageUrl" :nextPageUrl="nextPageUrl" unit-name="publications"></ListNav>
    </Base>
</template>
