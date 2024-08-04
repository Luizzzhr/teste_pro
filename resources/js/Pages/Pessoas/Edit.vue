<template>
    <div>
        <h1>Editar Pessoa</h1>
        <form @submit.prevent="submit">
            <div>
                <label>Nome</label>
                <input v-model="form.nome" type="text" required>
            </div>
            <div>
                <label>Email</label>
                <input v-model="form.email" type="email" required>
            </div>
            <div>
                <label>CPF</label>
                <input v-model="form.cpf" type="text" required>
            </div>
            <div>
                <label>Data de Nascimento</label>
                <input v-model="form.data_nascimento" type="date" required>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</template>

<script>
import { reactive } from 'vue';
import {router, usePage} from '@inertiajs/vue3';

export default {
    setup() {
        const { props } = usePage();

        const form = reactive({
            nome: props.pessoa.nome,
            email: props.pessoa.email,
            cpf: props.pessoa.cpf,
            data_nascimento: props.pessoa.data_nascimento
        });

        function submit() {
            router.put(`/pessoas/${props.pessoa.id}`, form);
        }

        return { form, submit };
    }
};
</script>
