<script setup>
import Base from '@/Components/Blog/Base.vue';
import ListNav from '@/Components/Blog/ListNav.vue';
import { ArrowTopRightOnSquareIcon } from '@heroicons/vue/24/outline';

const props = defineProps([
    'copyrightYear',
    'navLinks',
    'author',
    'publications',
    'prevPageUrl',
    'nextPageUrl',
    'paginateUnitName',
]);
</script>

<template>
    <Base :copyrightYear="copyrightYear" :navLinks="navLinks" :author="author">
        <ListNav :prevPageUrl="prevPageUrl" :nextPageUrl="nextPageUrl" :unit-name="paginateUnitName"></ListNav>

        <div id="publication-list" class="container-full">
            <article v-for="publication in publications" :key="publication.title" class="mb-8 px-8 md:px-0">
                <header>
                    <h2>
                        <a :href="publication.url" target="_blank" class="leading-8 align-middle">{{ publication.title }}
                            <ArrowTopRightOnSquareIcon class="h-5 w-5 inline-block leading-8 align-middle" /></a>
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

        <ListNav :prevPageUrl="prevPageUrl" :nextPageUrl="nextPageUrl" :unit-name="paginateUnitName"></ListNav>
    </Base>
</template>
