<template>
    <div>
        <h1>Detalhes da Pessoa</h1>
        <p><strong>Nome:</strong> {{ pessoa.nome }}</p>
        <p><strong>Email:</strong> {{ pessoa.email }}</p>
        <p><strong>CPF:</strong> {{ pessoa.cpf }}</p>
        <p><strong>Data de Nascimento:</strong> {{ pessoa.data_nascimento }}</p>
        <h2>Endereços</h2>
        <a :href="`/pessoas/${pessoa.id}/enderecos/create`" class="btn btn-primary">Adicionar Endereço</a>
        <table class="table">
            <thead>
            <tr>
                <th>CEP</th>
                <th>Logradouro</th>
                <th>Número</th>
                <th>Complemento</th>
                <th>Bairro</th>
                <th>Cidade</th>
                <th>Estado</th>
                <th>Tipo</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="endereco in pessoa.enderecos" :key="endereco.id">
                <td>{{ endereco.cep }}</td>
                <td>{{ endereco.logradouro }}</td>
                <td>{{ endereco.numero }}</td>
                <td>{{ endereco.complemento }}</td>
                <td>{{ endereco.bairro }}</td>
                <td>{{ endereco.cidade }}</td>
                <td>{{ endereco.estado }}</td>
                <td>{{ endereco.tipo }}</td>
                <td>
                    <a :href="`/enderecos/${endereco.id}/edit`" class="btn btn-warning">Editar</a>
                    <button @click="destroy(endereco.id)" class="btn btn-danger">Deletar</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import { router, usePage} from '@inertiajs/vue3';

export default {
    props: {
        pessoa: Object
    },
    setup() {
        const { props } = usePage();

        function destroy(id) {
            if (confirm('Tem certeza que deseja deletar este endereço?')) {
                router.delete(`/enderecos/${id}`);
            }
        }

        return { props, destroy };
    }
};
</script>
