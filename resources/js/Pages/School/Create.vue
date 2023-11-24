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

const educations = ref([
    { name: 'Médio', code: 'M' },
    { name: 'Técnico', code: 'T' },
    { name: 'Superior', code: 'S' },
]);

const average = ref([
    { name: 'Médio', code: 'MN' },
    { name: 'Médio Técnico', code: 'MT' },
]);

const technical = ref([
    { name: 'Técnico em Administração', code: 'TA' },
    { name: 'Técnico em Enfermagem', code: 'TE' },
    { name: 'Técnico em Informática', code: 'TI' },
    { name: 'Técnico em Contabilidade', code: 'TC' },
]);

const higher = ref([
    { name: 'Análise e Desenvolvimento de Sistemas', code: 'ADS' },
    { name: 'Design Gráfico', code: 'DG' },
    { name: 'Design de Jogos', code: 'DJ' },
    { name: 'Design de Interiores', code: 'DI' },

]);

</script>

<template>
    <Head title="Welcome" />

    <AppLayout title="welcome">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Criar Escola
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
                            <div class="flex flex-col gap-2">
                                <label for="name">Escolaridade*{{ form.education?.code }}</label>
                                <Dropdown v-model="form.education" :options="educations" optionLabel="name"
                                    placeholder="Selecione a Escolaridade" class="w-full md:w-14rem" />
                            </div>
                            <div class="flex flex-col gap-2">
                                <label for="address">Endereço*</label>
                                <InputText id="address" v-model="form.address" />
                            </div>
                            <div class="flex flex-col gap-2">
                                <label for="name">Curso*</label>
                                <Dropdown v-if="form.education?.code == 'M'" v-model="form.course" :options="average"
                                    optionLabel="name" placeholder="Selecione o curso" class="w-full md:w-14rem" />
                                <Dropdown v-if="form.education?.code == 'T'" v-model="form.course" :options="technical"
                                    optionLabel="name" placeholder="Selecione o curso" class="w-full md:w-14rem" />
                                <Dropdown v-if="form.education?.code == 'S'" v-model="form.course" :options="higher"
                                    optionLabel="name" placeholder="Selecione o curso" class="w-full md:w-14rem" />
                                <p v-if="form.education?.code == null">Selecione uma Escolaridade primeiro!</p>
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
