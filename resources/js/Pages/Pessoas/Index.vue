<template>
    <v-card class="mx-auto">
        <v-card-title>
            <v-toolbar flat>
                <v-toolbar-title>Consultar</v-toolbar-title>
                <v-spacer></v-spacer>
                <a href="/pessoas/create">
                    <v-btn color="primary">Criar Pessoa</v-btn>
                </a>
            </v-toolbar>
        </v-card-title>

        <v-card-text class="bg-surface-light pt-4">
            <v-container>
                <!-- Barra de Pesquisa -->
                <v-row>
                    <v-col cols="12" md="4">
                        <v-text-field
                            v-model="search.id"
                            label="Pesquisar por ID"
                            append-icon="mdi-magnify"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="4">
                        <v-text-field
                            v-model="search.nome"
                            label="Pesquisar por Nome"
                            append-icon="mdi-magnify"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="4">
                        <v-text-field
                            v-model="search.cpf"
                            label="Pesquisar por CPF"
                            append-icon="mdi-magnify"
                        ></v-text-field>
                    </v-col>
                </v-row>

                <!-- Tabela de Pessoas -->
                <v-data-table
                    :headers="headers"
                    :items="filteredPessoas"
                    item-key="id"
                    class="bg-surface-light"
                >
                    <template v-slot:item.actions="{ item }">
                        <v-btn @click="view(item.id)" color="info" class="mr-2">Ver</v-btn>
                        <v-btn @click="edit(item.id)" color="warning" class="mr-2">Editar</v-btn>
                        <v-btn @click="destroy(item.id)" color="danger">Deletar</v-btn>
                    </template>
                </v-data-table>
            </v-container>
        </v-card-text>
    </v-card>
</template>

<script>
import { ref, computed } from 'vue';
import { usePage, router, Link } from '@inertiajs/vue3';

export default {
    props: {
        pessoas: Array
    },
    setup() {
        const { props } = usePage();

        const search = ref({
            id: '',
            nome: '',
            cpf: ''
        });

        const headers = [
            { text: 'Nome', value: 'nome' },
            { text: 'Email', value: 'email' },
            { text: 'CPF', value: 'cpf' },
            { text: 'Data de Nascimento', value: 'data_nascimento' },
            { text: 'Ações', value: 'actions', sortable: false }
        ];

        const filteredPessoas = computed(() => {
            return props.pessoas.filter(pessoa => {
                return (!search.value.id || pessoa.id.toString().includes(search.value.id)) &&
                       (!search.value.nome || pessoa.nome.toLowerCase().includes(search.value.nome.toLowerCase())) &&
                       (!search.value.cpf || pessoa.cpf.includes(search.value.cpf));
            });
        });

        function view(id) {
            router.get(`/pessoas/${id}`);
        }

        function edit(id) {
            router.get(`/pessoas/${id}/edit`);
        }

        function destroy(id) {
            if (confirm('Tem certeza que deseja deletar esta pessoa?')) {
                router.delete(`/pessoas/${id}`);
            }
        }

        return { search, filteredPessoas, destroy, view, edit, headers };
    }
};
</script>

<style scoped>
.v-data-table th, .v-data-table td {
    padding: 16px;
}
</style>
