<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps([
    'prevPageUrl',
    'nextPageUrl',
    'unitName',
]);
</script>

<template>
    <section id="list-nav" v-if="prevPageUrl !== null || nextPageUrl !== null"
             class="container-full grid grid-cols-2 my-4 px-8 md:px-0">
        <span>
            <Link :href="prevPageUrl"
                  v-if="prevPageUrl !== null">
                &lt; Newer {{ unitName }}
            </Link>
        </span>
        <span class="text-right">
            <Link :href="nextPageUrl"
                  v-if="nextPageUrl !== null">
                Older {{ unitName }} &gt;
            </Link>
        </span>
    </section>
</template>
