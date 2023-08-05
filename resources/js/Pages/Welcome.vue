<script setup>
import { Head, Link } from "@inertiajs/vue3";
import FrontendLayout from "@/Layouts/Frontend.vue";
import Hero from "@/Components/Frontend/Hero.vue";
import About from "@/Components/Frontend/About.vue";
import Skill from "@/Components/Frontend/Skills.vue";
import Portfolio from "@/Components/Frontend/Portfolio.vue";
import Contact from "@/Components/Frontend/Contactme.vue";

defineProps({
    skills: Object,
    projects: Object,
});
</script>

<template>
    <Head title="Welcome to portfolio" />
    <FrontendLayout>
        <!-- Hero Primary -->
        <Hero />
        <!-- Promote Tail-100 -->
        <!-- About Secondary color-->
        <About />
        <!-- Skills tail-100 -->
        <Skill :skills="skills" />
        <!-- Portofolio Primary  -->
        <Portfolio :skills="skills" :projects="projects" />
        <!-- Services Secondary-->
        <!-- Contact Primary -->
        <Contact />
    </FrontendLayout>
</template>
