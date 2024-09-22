<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head, Link } from '@inertiajs/vue3';

    // topics props
    const props = defineProps({
        topics: Array
    });

</script>

<template>

    <Head title="Topics" />

    <AuthenticatedLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Topics</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- table start -->
                 <div class="flex justify-end p-2 m-2">
                    <Link :href="route('topics.create')" class="px-4 py-2 rounded bg-rose-500 hover:bg-rose-600 text-white">Topic Create</Link>
                 </div>
                <div
                    class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-white shadow-md rounded-lg bg-clip-border">
                    <table class="w-full text-left table-auto min-w-max">
                        <thead>
                            <tr class="border-b border-slate-300 bg-slate-50">
                                <th class="p-4 text-sm font-normal leading-none text-slate-500">#ID</th>
                                <th class="p-4 text-sm font-normal leading-none text-slate-500">Name</th>
                                <th class="p-4 text-sm font-normal leading-none text-slate-500">Image</th>
                                <th class="p-4 text-sm font-normal leading-none text-slate-500">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="hover:bg-slate-50" v-for="topic in topics" :key="topic.id">
                                <td class="p-4 border-b border-slate-200 py-5">
                                    <p class="block font-semibold text-sm text-slate-800">{{ topic.id }}</p>
                                </td>
                                <td class="p-4 border-b border-slate-200 py-5">
                                    <p class="block font-semibold text-sm text-slate-800">{{ topic.name }}</p>
                                </td>
                                <td class="p-4 border-b border-slate-200 py-5">
                                    <img :src="topic.image"
                                        :alt="topic.name" class="w-16 h-16 object-cover rounded" />
                                </td>
                                <td class="p-4 border-b border-slate-200 py-5">
                                   <button type="button" class="text-lg mx-1 bg-blue-600 text-white px-4 py-1 rounded">Edit</button>
                                   <button type="button" class="text-lg mx-1 bg-red-600 text-white px-4 py-1 rounded">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- end -->
            </div>
        </div>

    </AuthenticatedLayout>
</template>
