<script setup>
import { ref, onMounted } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from 'laravel-precognition-vue-inertia';
import 'vue-toast-notification/dist/theme-sugar.css';
import InputText from 'primevue/inputtext';
import Dropdown from 'primevue/dropdown';
import Button from 'primevue/button';
import InputNumber from 'primevue/inputnumber';

const props = defineProps({
    school: Object
});

const form = useForm('put', route('school.update', { id: props.school.id }), {
    name: props.school.name,
    education: props.school.education,
    course: props.school.course,
    address: props.school.address
});
const submit = () => form.submit({
    preserveScroll: true,
    onSuccess: () => form.reset(),
});

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

onMounted(() => {
    const selectedEducation = educations.value.find(edu => edu.name === props.school.education);
    if (selectedEducation) {
        form.education = selectedEducation;
    }
});

onMounted(() => {
    const selectedEducation = educations.value.find(edu => edu.name === props.school.education);
    if (selectedEducation) {
        form.education = selectedEducation;

        switch (selectedEducation.code) {
            case 'M':
                form.course = average.value.find(course => course.name === props.school.course);
                break;
            case 'T':
                form.course = technical.value.find(course => course.name === props.school.course);
                break;
            case 'S':
                form.course = higher.value.find(course => course.name === props.school.course);
                break;
            default:
                form.course = null;
        }
    }
});
form.sex = sexes.value.find(sexo => sexo.name === props.people.sex);
                break;
</script>

<template>
    <AppLayout title="edit-school">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Editar Escola
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <form @submit.prevent="submit">
                        <div class="p-6 grid md:grid-cols-2 gap-4">
                            <div class="flex flex-col gap-2">
                                <label for="name">Nome*</label>
                                <InputText id="name" v-model="form.name" @change="form.validate('name')" />
                                <div v-if="form.invalid('name')" class="text-red-500">
                                    {{ form.errors.name }}
                                </div>
                            </div>
                            <div class="flex flex-col gap-2">
                                <label for="name">Escolaridade*{{ form.education?.code }}</label>
                                <Dropdown v-model="form.education" :options="educations" optionLabel="name"
                                    @change="form.validate('education')" placeholder="Selecione a Escolaridade"
                                    class="w-full md:w-14rem" />
                                <div v-if="form.invalid('education')" class="text-red-500">
                                    {{ form.errors.education }}
                                </div>
                            </div>
                            <div class="flex flex-col gap-2">
                                <label for="address">Endereço*</label>
                                <InputText id="address" v-model="form.address" @change="form.validate('address')" />
                                <div v-if="form.invalid('address')" class="text-red-500">
                                    {{ form.errors.address }}
                                </div>
                            </div>
                            <div class="flex flex-col gap-2">
                                <label for="name">Curso*</label>
                                <Dropdown v-if="form.education?.code == 'M'" v-model="form.course" :options="average"
                                    @change="form.validate('course')" optionLabel="name" placeholder="Selecione o curso"
                                    class="w-full md:w-14rem" />
                                <Dropdown v-if="form.education?.code == 'T'" v-model="form.course" :options="technical"
                                    @change="form.validate('course')" optionLabel="name" placeholder="Selecione o curso"
                                    class="w-full md:w-14rem" />
                                <Dropdown v-if="form.education?.code == 'S'" v-model="form.course" :options="higher"
                                    @change="form.validate('course')" optionLabel="name" placeholder="Selecione o curso"
                                    class="w-full md:w-14rem" />
                                <p v-if="form.education?.code == null">Selecione uma Escolaridade primeiro!</p>
                                <div v-if="form.invalid('course')" class="text-red-500">
                                    {{ form.errors.course }}
                                </div>
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
}</style>
