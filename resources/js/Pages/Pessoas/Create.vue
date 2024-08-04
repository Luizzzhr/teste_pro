<template>
    <div>
        <h1>Criar Pessoa</h1>
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
import { router } from '@inertiajs/vue3'

export default {
    setup() {
        const form = reactive({
            nome: '',
            email: '',
            cpf: '',
            data_nascimento: ''
        });

        function submit() {
            router.post('/pessoas', form);
        }

        return { form, submit };
    }
};
</script>
