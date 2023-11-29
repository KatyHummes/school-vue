<script setup>
import { ref, onMounted } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from 'laravel-precognition-vue-inertia';
import InputText from 'primevue/inputtext';
import Dropdown from 'primevue/dropdown';
import InputNumber from 'primevue/inputnumber';

const props = defineProps({
    schools: Array
});

const form = useForm('post', route('classroom.store'), {
    name: '',
    rotation: '',
    max_students: '',
    school_id: ''
});
const submit = () => form.submit({
    preserveScroll: true,
    onSuccess: () => form.reset(),
});

const rotations = ref([
    { name: 'Manhã', code: 'M' },
    { name: 'Tarde', code: 'T' },
    { name: 'Noite', code: 'N' },
]);

const schools = ref([]);
for (const school of props.schools) {
    schools.value.push({ id: school.id, name: school.name });
}
</script>

<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Criar Turma
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
                                    <InputText id="name" v-model="form.name" @change="form.validate('name')" />
                                    <div v-if="form.invalid('name')" class="text-red-500">
                                        {{ form.errors.name }}
                                    </div>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <label for="rotation">Turno*{{ form.rotation?.code }}</label>
                                    <Dropdown v-model="form.rotation" :options="rotations" optionLabel="name"
                                        @change="form.validate('rotation')" placeholder="Selecione o Turno"
                                        class="w-full md:w-14rem" />
                                    <div v-if="form.invalid('rotation')" class="text-red-500">
                                        {{ form.errors.rotation }}
                                    </div>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <label for="school_id">Escola*</label>
                                    <Dropdown v-model="form.school_id" :options="schools" optionLabel="name"
                                        @change="form.validate('school_id')" placeholder="Selecione a Escola"
                                        class="w-full md:w-14rem" />
                                    <div v-if="form.invalid('school_id')" class="text-red-500">
                                        {{ form.errors.school_id }}
                                    </div>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <label for="minmax-buttons" class="font-bold block mb-2">Número de Alunos*</label>
                                    <InputNumber id="max_students" v-model="form.max_students" inputId="minmax-buttons"
                                        mode="decimal" showButtons @change="form.validate('max_students')" :min="0"
                                        :max="50" />
                                    <div v-if="form.invalid('max_students')" class="text-red-500">
                                        {{ form.errors.max_students }}
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="py-2 px-4 m-5 rounded-lg bg-green-600 text-white">Enviar</button>
                        </form>
                    </div>
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