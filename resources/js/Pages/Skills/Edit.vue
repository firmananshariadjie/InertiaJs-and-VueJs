<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
// import { Inertia } from "@inertiajs/inertia";
import { router } from "@inertiajs/vue3";
import { Head, Link, useForm } from "@inertiajs/vue3";

const props = defineProps({
    skill: Object,
});

const form = useForm({
    name: props.skill?.name,
    image: null,
});

const submit = () => {
    router.post(`/skills/${props.skill.id}`, {
        _method: "put",
        name: form.name,
        image: FormData.image,
    });
};
</script>

<template>
    <Head title="Edit Skills" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Skills
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-md mx-auto sm:px-6 sm:py-6 lg:px-8 bg-white">
                <form @submit.prevent="submit" class="p-4">
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
                            v-value="skill.name"
                        />

                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
                    <div class="pt-2">
                        <InputLabel for="image" value="Image" />
                        <img
                            :src="skill.image"
                            class="w-12 h-12 rounded-full"
                        />
                        <TextInput
                            id="image"
                            type="file"
                            class="mt-1 block w-full"
                            @input="form.image = $event.target.files[0]"
                        />

                        <InputError class="mt-2" :message="form.errors.image" />
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
    </AuthenticatedLayout>
</template>
