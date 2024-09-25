<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { reactive } from 'vue';
import Swal from 'sweetalert2';

    const form = reactive({
        content: null
    });

    // Add Todo
    const handleAdd = async() =>{
        try{

            if(form.content != null){

                await router.post('/todos', form, {
                    onSuccess: (page) =>{
                        Swal.fire({
                            title: page.props.flash.success,
                            icon: "success",
                            showConfirmButton: true,
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                        });
                    }
                });
                
                form.content = null; // after submit form value will be null
            }
            
        }catch(err){
            console.log(err)
        }
    }
    // Props Define
    const props = defineProps({
        todos: Array
    })

    // Status Update True 0 to 1
    const handleStatus = async (todo) =>{
       try {
            await router.put('/todos/' + todo.id + '/update');
       } catch (error) {
            console.log(error);
       }
    }

    

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Todo
            </h2>
        </template>
         <!-- component -->
         <div class="h-100 w-full flex items-center justify-center bg-teal-lightest font-sans">
            <div class="bg-white rounded shadow p-6 m-4 w-full lg:w-3/4 lg:max-w-lg">
                <div class="mb-4">
                    <h1 class="text-grey-darkest text-xl">Todo List</h1>
                    <div class="flex mt-4">

                        <input class="shadow appearance-none border rounded w-full py-2 px-3 mr-4 text-grey-darker" placeholder="Add Todo" v-model="form.content">

                        <button class="flex-no-shrink p-2 border-2 rounded-lg text-teal border-teal text-white bg-blue-500 hover:bg-blue-700" @click="handleAdd()">Add</button>
                    </div>
                </div>
                <div>
                    <div class="flex mb-4 items-center" v-for="todo in todos" :key="todo.id">
                        <p class="w-full text-grey-darkest">{{ todo.content }}</p>

                        <button v-if="todo.isDone"  class="flex-no-shrink w-1/3 p-2 ml-4 mr-2 border-2 rounded-lg border-grey" @click="handleStatus(todo)">Not Done</button>

                        <button v-else class="flex-no-shrink p-2 ml-4 mr-2 border-2 rounded-lg border-green text-white bg-green-500 hover:bg-green-700" @click="handleStatus(todo)">Done</button>
              

                        <button class="flex-no-shrink p-2 ml-2 border-2 rounded-lg text-red border-red text-white bg-red-500 hover:bg-red-700">Remove</button>
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
