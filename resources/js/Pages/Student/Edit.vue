<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref, computed, onMounted } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import InputText from 'primevue/inputtext';
import Calendar from 'primevue/calendar';
import 'vue-toast-notification/dist/theme-sugar.css';
import { useForm as useFormPrecognition } from 'laravel-precognition-vue-inertia';
import InputMask from 'primevue/inputmask';
import Dropdown from 'primevue/dropdown';
import Button from 'primevue/button';


const props = defineProps({
    student: Object,
    classrooms: Array,
});

const form = useFormPrecognition('put', route('student.update', { id: props.student.id }), {
    name: props.student.name,
    birth: props.student.birth,
    cpf: props.student.cpf,
    sex: props.student.sex,
    address: props.student.address,
    classroom_id: props.student.classroom_id,
});

const submit = () => form.submit({
    preserveScroll: true,
    onSuccess: () => {
        // toast.success("Aluno(a) atualizado(a) com Sucesso!", {
        //     position: 'top-right',
        // });
    }
});

const sexs = ref([
    { name: 'Masculino', code: 'M' },
    { name: 'Feminino', code: 'F' },
    { name: 'Outro', code: 'O' },
]);

onMounted(() => {
    const selectedSex = sexs.value.find(rot => rot.name === props.student.sex);

    if (selectedSex) {
        form.sex = selectedSex;
    }
});

onMounted(() => {
    const selectedClassroom = props.classrooms.find(sch => sch.id === props.student.classroom_id);
    if (selectedClassroom) {
        form.classroom_id = selectedClassroom;
    }
});
</script>

<template>
    <Head title="Welcome" />

    <AppLayout title="welcome">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Editar Aluno{{ }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">

                    <form @submit.prevent="submit">
                        <div class="grid md:grid-cols-2 gap-4">

                            <div class="flex flex-col gap-2">
                                <label for="name">Nome*</label>
                                <InputText id="name" v-model="form.name" @change="form.validate('name')" />
                                <div v-if="form.invalid('name')" class="text-red-500">
                                    {{ form.errors.name }}
                                </div>
                            </div>
                            <div class="flex flex-col gap-2 card justify-content-center">
                                <label for="birth">Data de Nascimento*</label>
                                <Calendar id="birth" v-model="form.birth" showIcon @change="form.validate('birth')"
                                    placeholder="Selecione a Data" />
                                <div v-if="form.invalid('birth')" class="text-red-500">
                                    {{ form.errors.birth }}
                                </div>
                            </div>
                            <div class="flex flex-col gap-2">
                                <label for="cpf">CPF*</label>
                                <InputMask id="cpf" v-model="form.cpf" mask="999.999.999-99" placeholder="999.999.999-99"
                                    @change="form.validate('cpf')" />
                                <div v-if="form.invalid('cpf')" class="text-red-500">
                                    {{ form.errors.cpf }}
                                </div>
                            </div>
                            <div class="flex flex-col gap-2">
                                <label for="sex">Sexo*</label>
                                <Dropdown v-model="form.sex" :options="sexs" optionLabel="name"
                                    placeholder="Selecione o Sexo" @change="form.validate('sex')"
                                    class="w-full md:w-14rem" />
                                <div v-if="form.invalid('sex')" class="text-red-500">
                                    {{ form.errors.sex }}
                                </div>
                            </div>
                            <div class="flex flex-col gap-2">
                                <label for="address">Endereço*</label>
                                <InputText id="address" v-model="form.address" placeholder="Digite o Endereço"
                                    @change="form.validate('address')" />
                                <div v-if="form.invalid('address')" class="text-red-500">
                                    {{ form.errors.address }}
                                </div>
                            </div>
                            <div class="flex flex-col gap-2">
                                <label for="classroom_id">Turmas*</label>
                                <Dropdown v-model="form.classroom_id" :options="classrooms" optionLabel="name"
                                    @change="form.validate('classroom_id')" placeholder="Selecione a Escola"
                                    class="w-full md:w-14rem" />
                                <div v-if="form.invalid('classroom_id')" class="text-red-500">
                                    {{ form.errors.classroom_id }}
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
}
</style>
