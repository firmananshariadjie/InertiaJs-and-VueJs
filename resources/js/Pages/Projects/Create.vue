<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

defineProps({
    skills: Array,
});

const form = useForm({
    name: "",
    image: null,
    proeject_url: "",
    skill_id: " ",
});

const submit = () => {
    form.post(route("projects.store"));
};
</script>

<template>
    <Head title="Create Project" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Project
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-md mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form @submit.prevent="submit" class="p-4">
                        <div class="pt-2">
                            <select
                                v-model="form.skill_id"
                                name="skill_id"
                                id="skill_id"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indogo-500 focus:ring-border-indigo-500 sm:text-sm rounded-md"
                            >
                                <option
                                    v-for="skill in skills"
                                    :key="skill.id"
                                    :value="skill.id"
                                >
                                    {{ skill.name }}
                                </option>
                            </select>
                        </div>

                        <div class="pt-2">
                            <InputLabel for="name" value="Name" />

                            <TextInput
                                id="name"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.name"
                                required
                                autofocus
                                autocomplete="name"
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.name"
                            />
                        </div>

                        <div class="pt-2">
                            <InputLabel for="proeject_url" value="URL" />

                            <TextInput
                                id="proeject_url"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.proeject_url"
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.proeject_url"
                            />
                        </div>

                        <div class="pt-2">
                            <InputLabel for="image" value="Image" />

                            <TextInput
                                id="image"
                                type="file"
                                class="mt-1 block w-full"
                                @input="form.image = $event.target.files[0]"
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.image"
                            />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <PrimaryButton
                                class="ml-4"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Save
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
