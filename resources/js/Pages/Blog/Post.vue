<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import Base from '@/Components/Blog/Base.vue';

const props = defineProps([
    'copyrightYear',
    'navLinks',
    'author',
    'post'
]);
</script>

<template>
    <Base :copyrightYear="copyrightYear" :navLinks="navLinks" :author="author">
        <article id="post" class="container-full text-xl mb-6 p-8 md:p-0">
            <header class="border-l-8 border-slate-500 p-6 mb-6">
                <h2 class="text-4xl">{{ post.title }}</h2>
                <div id="publish-date" class="text-2xl" v-if="post.displayDate">{{ post.publishDate }}</div>
            </header>
            <div>
                <template v-if="post.contentItems.items">
                    <div v-for="(item, index) in post.contentItems.items" :key="index">
                        <div v-if="item.__typename == 'ContentText'" v-html="item.content"></div>
                        <img v-if="item.__typename == 'ContentImage'" :alt="item.image.description"
                             :src="item.image.url"
                            class="max-w-full lg:max-w-4xl block mx-auto my-4" />
                    </div>
                </template>
            </div>
        </article>
    </Base>
</template>
