<script setup>
import { Head } from '@inertiajs/vue3'

defineProps({ test: Object })
</script>

<template>
    <Layout>
        <Head />
        <h1>Welcome</h1>
        <p>Hello {{ test }}, welcome to your first Inertia app!</p>
    </Layout>
</template>
