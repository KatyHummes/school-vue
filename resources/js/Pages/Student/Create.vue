<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref, computed } from 'vue';
import Calendar from 'primevue/calendar';
import { useToast } from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
import { useForm as useFormPrecognition } from 'laravel-precognition-vue-inertia';
import InputMask from 'primevue/inputmask';
import InputText from 'primevue/inputtext';
import Dropdown from 'primevue/dropdown';
import Button from 'primevue/button';

const toast = useToast();

const props = defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    students: Array

});

const form = useFormPrecognition('post', '/student.store', {
    name: '',
    birth: '',
    cpf: '',
    sex: '',
    address: '',
});

const submit = () => form.submit({
    preserveScroll: true,
    onSuccess: () => {
        form.reset();
        toast.success("Aluno(a) criado(a) com Sucesso!", {
            position: 'top-right',
        });
    }
});
</script>


<template>

    <AppLayout title="Criar usuário">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Criar Aluno
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <form @submit.prevent="submit">
                            <div class="grid md:grid-cols-2 gap-4">

                                <div class="flex flex-col gap-2">
                                    <label for="name">Nome*</label>
                                    <InputText id="name" v-model="form.name" />
                                </div>
                                <div class="flex flex-col gap-2">
                                    <label for="name">Nome*</label>
                                    <InputText id="name" v-model="form.name" />
                                </div>
                                <div class="flex flex-col gap-2">
                                    <label for="name">Nome*</label>
                                    <InputText id="name" v-model="form.name" />
                                </div>
                                <div class="flex flex-col gap-2">
                                    <label for="name">Nome*</label>
                                    <InputText id="name" v-model="form.name" />
                                </div>
                                <div class="flex flex-col gap-2">
                                    <label for="name">Nome*</label>
                                    <InputText id="name" v-model="form.name" />
                                </div>
                                
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template> 

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}

@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
