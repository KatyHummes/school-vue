<script setup>
import { ref, onMounted } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import Dropdown from 'primevue/dropdown';
import InputText from 'primevue/inputtext';

defineProps({

});

const form = useForm({
    name: '',
    education: '',
    address: '',
    course: '',
});

const createSchool = () => {
    form.post(route('school.create'), {
        onFinish: () => form.reset(),
    });
};

const sexes = ref([
    { name: 'Masculino', code: 'M' },
    { name: 'Feminino', code: 'F' },
    { name: 'Outro', code: 'O' },
]);



</script>

<template>
    <Head title="Welcome" />

    <AppLayout title="welcome">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Criar Aluno
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <form @submit.prevent="createSchool">
                        <div class="p-6 grid md:grid-cols-2 gap-4">
                            <div class="flex flex-col gap-2">
                                <label for="name">Nome*</label>
                                <InputText id="name" v-model="form.name" />
                            </div>
                            <div class="form-control w-full ">
                            <label class="label">
                                <span class="label-text">Nome:*</span>
                            </label>
                            <InputText type="text" placeholder="Nome Completo" v-model="formCreatePeople.name"
                                @change="formCreatePeople.validate('name')" />
                            <span v-if="formCreatePeople.invalid('name')" class="text-base text-red-500">
                                {{ formCreatePeople.errors.name }}
                            </span>
                        </div>

                        <div class="form-control w-full ">
                            <label class="label">
                                <span class="label-text">Data de Nascimento:*</span>
                            </label>
                            <!-- <input type="date" v-model="formCreatePeople.birth"> -->
                            <Calendar v-model="formCreatePeople.birth" dateFormat="dd/mm/yy" showIcon
                                @change="formCreatePeople.validate('birth')" placeholder="Clique para Selecionar" />
                            <span v-if="formCreatePeople.invalid('birth')" class="text-base text-red-500">
                                {{ formCreatePeople.errors.birth }}
                            </span>
                        </div>

                        <div class="form-control w-full ">
                            <label class="label">
                                <span class="label-text">Cpf:*</span>
                            </label>
                            <InputMask v-model="formCreatePeople.cpf" mask="999.999.999-99" placeholder="000.000.000-00"
                                @change="formCreatePeople.validate('cpf')" />

                            <span v-if="formCreatePeople.invalid('cpf')" class="text-base text-red-500">
                                {{ formCreatePeople.errors.cpf }}
                            </span>
                        </div>
                        <div class="form-control w-full ">
                            <label class="label">
                                <span class="label-text">Sexo:*</span>
                            </label>
                            <div class="card flex justify-content-center">
                                <Dropdown v-model="formCreatePeople.sex" :options="sexes" optionLabel="name"
                                    placeholder="Clique para Selecionar" class="w-full md:w-14rem"
                                    @change="formCreatePeople.validate('sex')" />
                            </div>
                            <span v-if="formCreatePeople.invalid('sex')" class="text-base text-red-500">
                                {{ formCreatePeople.errors.sex }}
                            </span>
                        </div>
                            <div class="flex flex-col gap-2">
                                <label for="address">Endereço*</label>
                                <InputText id="address" v-model="form.address" />
                            </div>
                            

                        </div>
                        <button type="submit" class="py-2 px-4 m-5 rounded-lg bg-green-600 text-white">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style>
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
