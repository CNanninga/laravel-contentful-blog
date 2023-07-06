<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps([
    'prevPageUrl',
    'nextPageUrl',
]);
</script>

<template>
    <section id="list-nav" v-if="prevPageUrl !== null || nextPageUrl !== null"
             class="container-full grid grid-cols-2 my-4">
        <span>
            <Link :href="prevPageUrl"
                  v-if="prevPageUrl !== null">
                &lt; Newer posts
            </Link>
        </span>
        <span class="text-right">
            <Link :href="nextPageUrl"
                  v-if="nextPageUrl !== null">
                Older posts &gt;
            </Link>
        </span>
    </section>
</template>
