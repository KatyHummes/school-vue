<script setup>
import { ref, computed, } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import InputText from 'primevue/inputtext';
import { FilterMatchMode, FilterOperator } from 'primevue/api';
import Tag from 'primevue/tag';
import Dropdown from 'primevue/dropdown';
import Button from 'primevue/button';

const props = defineProps({
    schools: Array
});

const schools = computed(() => {
    return props.schools.map(school => ({
        id: school.id,
        name: school.name,
        education: school.education,
        course: school.course,
        address: school.address,
    }));
});

const filters = ref();

const initFilters = () => {
    filters.value = {
        global: { value: null, mathMode: FilterMatchMode.CONTAINS },
        name: { value: null, matchMode: FilterMatchMode.CONTAINS },
        education: { operator: FilterOperator.OR, constraints: [{ value: null, matchMode: FilterMatchMode.EQUALS }] },
        course: { value: null, matchMode: FilterMatchMode.STARTS_WITH },
        address: { value: null, matchMode: FilterMatchMode.CONTAINS },
    };
};

initFilters();

const clearFilter = () => {
    initFilters();
};

const educations = ref(['average', 'technical', 'higher']);
const courses = ref({
    'average': ['Médio', 'Médio Técnico'],
    'technical': ['Técnico em Administração', 'Técnico em Enfermagem', 'Técnico em Informática', 'Técnico em Contabilidade'],
    'higher': ['Análise e Desenvolvimento de Sistemas', 'Design Gráfico', 'Design de Jogos', 'Design de Interiores'],
});

const getSeverity = (education) => {
    switch (education) {
        case 'average':
            return { backgroundColor: '#0e11c4' };
        case 'technical':
            return { backgroundColor: '#c40eb5' };
        case 'higher':
            return { backgroundColor: '#0ec41d' };
        default:
            return {};
    }
};

</script>

<template>
    <Head title="Welcome" />

    <AppLayout title="welcome">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Escolas
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="card">
                        <DataTable v-model:filters="filters" :value="schools" paginator showGridlines :rows="10"
                            dataKey="id" filterDisplay="menu"
                            :globalFilterFields="['name', 'education', 'course', 'address']">
                            <template #header>
                                <div class="flex justify-between">
                                    <Button type="button" icon="pi pi-filter-slash" label="Limpar" outlined
                                        @click="clearFilter()" />
                                    <span class="p-input-icon-left">
                                        <i class="pi pi-search" />
                                        <InputText v-model="filters['global'].value"
                                            placeholder="Pesquise por Palavra chave" />
                                    </span>
                                </div>
                            </template>
                            <template #empty> Nenhuma Escola encontrada! </template>
                            <Column field="name" header="Nome" style="min-width: 12rem">
                                <template #body="{ data }">
                                    {{ data.name }}
                                </template>
                                <template #filter="{ filterModel }">
                                    <InputText v-model="filterModel.value" type="text" class="p-column-filter"
                                        placeholder="Pesquise o Nome" />
                                </template>
                            </Column>
                            <Column header="Educação" field="education" :filterMenuStyle="{ width: '14rem' }"
                                style="min-width: 12rem">
                                <template #body="{ data }">
                                    <Tag :value="data.education" :style="getSeverity(data.education)" />
                                </template>
                                <template #filter="{ filterModel }">
                                    <Dropdown v-model="filterModel.value" :options="educations"
                                        placeholder="Pesquise pelo nível Escolar" class="p-column-filter" showClear>
                                        <template #option="slotProps">
                                            <Tag :value="slotProps.option" :severity="getSeverity(slotProps.option)"
                                                style="background: linear-gradient(to right, var(--primary-300), var(--primary-700))" />
                                        </template>
                                    </Dropdown>
                                </template>
                            </Column>
                            <Column header="Cursos" field="course" :filterMenuStyle="{ width: '14rem' }"
                                style="min-width: 12rem">
                                <template #body="{ data }">
                                    <Tag :value="data.course" :style="getSeverity(data.course)" />
                                </template>
                                <template #filter="{ filterModel }">
                                    <Dropdown v-model="filterModel.value" :options="Object.values(courses)"
                                        placeholder="Pesquise pelos Cursos" class="p-column-filter" showClear>
                                        <template #option="slotProps">
                                            <Tag :value="slotProps.option" :severity="getSeverity(slotProps.option)"
                                                style="background: linear-gradient(to right, var(--primary-300), var(--primary-700))" />
                                        </template>
                                    </Dropdown>
                                </template>
                            </Column>
                            <Column field="address" header="Endereço" style="min-width: 12rem">
                                <template #body="{ data }">
                                    {{ data.address }}
                                </template>
                                <template #filter="{ filterModel }">
                                    <InputText v-model="filterModel.value" type="text" class="p-column-filter"
                                        placeholder="Pesquise o Endereço" />
                                </template>
                            </Column>

                            <Column headerStyle="width:4rem" header="Ações" field="actions"
                                href="{{ route('school.edit', $) }}">
                                <template #body="{ data }">
                                    <button type="submit">
                                        <Link :href="route('school.edit', data.id)">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                        </Link>
                                    </button>
                                </template>
                            </Column>

                        </DataTable>
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
