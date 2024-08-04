<template>
    <div>
        <h1>Editar Endereço</h1>
        <form @submit.prevent="submit">
            <div>
                <label>CEP</label>
                <input v-model="form.cep" type="text" required>
            </div>
            <div>
                <label>Logradouro</label>
                <input v-model="form.logradouro" type="text" required>
            </div>
            <div>
                <label>Número</label>
                <input v-model="form.numero" type="text" required>
            </div>
            <div>
                <label>Complemento</label>
                <input v-model="form.complemento" type="text">
            </div>
            <div>
                <label>Bairro</label>
                <input v-model="form.bairro" type="text" required>
            </div>
            <div>
                <label>Cidade</label>
                <input v-model="form.cidade" type="text" required>
            </div>
            <div>
                <label>Estado</label>
                <input v-model="form.estado" type="text" required>
            </div>
            <div>
                <label>Tipo</label>
                <select v-model="form.tipo" required>
                    <option value="Residencial">Residencial</option>
                    <option value="Comercial">Comercial</option>
                </select>
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
            cep: props.endereco.cep,
            logradouro: props.endereco.logradouro,
            numero: props.endereco.numero,
            complemento: props.endereco.complemento,
            bairro: props.endereco.bairro,
            cidade: props.endereco.cidade,
            estado: props.endereco.estado,
            tipo: props.endereco.tipo
        });

        function submit() {
            router.put(`/enderecos/${props.endereco.id}`, form);
        }

        return { form, submit };
    }
};
</script>
