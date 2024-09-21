<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head, Link, useForm } from '@inertiajs/vue3';

    const form = useForm({
        name: null,
        file: null,
    });

    const storeTopic = () =>{
        form.post('/topics/store')
    }

</script>

<template>
    <Head title="Topics" />
    <AuthenticatedLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Topics</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex p-2 m-2">
                    <Link :href="route('topics.index')"
                        class="px-4 py-2 rounded bg-rose-500 hover:bg-rose-600 text-white">Back</Link>
                </div>

                <!-- form start -->
                <div class="mx-auto w-full max-w-[550px] bg-white rounded">
                    <form class="py-6 px-9" @submit.prevent="storeTopic">
                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="mb-3 block text-base font-medium text-[#07074D]">
                                Name
                            </label>
                            <input type="text" name="name" id="name" placeholder="Enter your name" v-model="form.name"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                        </div>

                        <!-- Image -->
                        <div class="mb-6 pt-4">
                            <label class="mb-5 block text-xl font-semibold text-[#07074D]">
                                Upload Image
                            </label>

                            <div class="mb-8">
                                <input type="file" name="file" id="file" class="sr-only"  @input="form.file = $event.target.files[0]"/>
                                <label for="file"
                                    class="relative flex min-h-[200px] items-center justify-center rounded-md border border-dashed border-[#e0e0e0] p-12 text-center">
                                    <div>
                                        <span class="mb-2 block text-xl font-semibold text-[#07074D]">
                                            Drop files here
                                        </span>
                                        <span class="mb-2 block text-base font-medium text-[#6B7280]">
                                            Or
                                        </span>
                                        <span
                                            class="inline-flex rounded border border-[#e0e0e0] py-2 px-7 text-base font-medium text-[#07074D]">
                                            Browse
                                        </span>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div>
                            <button
                                class="hover:shadow-form w-full rounded-md bg-blue-500 hover:bg-blue-600 py-3 px-8 text-center text-base font-semibold text-white outline-none">
                                Create
                            </button>
                        </div>
                    </form>
                </div>
                <!-- end -->
            </div>
        </div>

    </AuthenticatedLayout>
</template>
