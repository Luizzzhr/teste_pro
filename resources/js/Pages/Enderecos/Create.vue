<template>
    <div>
        <h1>Adicionar Endereço</h1>
        <form @submit.prevent="submit">
            <div>
                <label>CEP</label>
                <input v-model="form.cep" type="text" required @blur="fetchAddress" placeholder="Digite o CEP">
            </div>
            <div>
                <label>Logradouro</label>
                <input v-model="form.logradouro" type="text" :readonly="readonlyFields.logradouro" required>
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
                <input v-model="form.bairro" type="text" :readonly="readonlyFields.bairro" required>
            </div>
            <div>
                <label>Cidade</label>
                <input v-model="form.cidade" type="text" :readonly="readonlyFields.cidade" required>
            </div>
            <div>
                <label>Estado</label>
                <input v-model="form.estado" type="text" :readonly="readonlyFields.estado" required>
            </div>
            <div>
                <label>Tipo</label>
                <select v-model="form.tipo" required>
                    <option value="residencial">Residencial</option>
                    <option value="comercial">Comercial</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</template>

<script>
import { reactive } from 'vue';
import { router, usePage } from '@inertiajs/vue3';
import axios from 'axios';

export default {
    setup() {
        const { props } = usePage();

        const form = reactive({
            cep: '',
            logradouro: '',
            numero: '',
            complemento: '',
            bairro: '',
            cidade: '',
            estado: '',
            tipo: 'residencial'
        });

        const readonlyFields = reactive({
            logradouro: false,
            bairro: false,
            cidade: false,
            estado: false
        });

        async function fetchAddress() {
            if (form.cep.length === 8) {
                try {
                    const response = await axios.get(`https://viacep.com.br/ws/${form.cep}/json/`);
                    const data = response.data;
                    
                    // Atualize o formulário com os dados recebidos
                    form.logradouro = data.logradouro || '';
                    form.bairro = data.bairro || '';
                    form.cidade = data.localidade || '';
                    form.estado = data.uf || '';

                    // Defina os campos como readonly se a API retornar dados
                    readonlyFields.logradouro = !!data.logradouro;
                    readonlyFields.bairro = !!data.bairro;
                    readonlyFields.cidade = !!data.localidade;
                    readonlyFields.estado = !!data.uf;
                } catch (error) {
                    console.error('Erro ao buscar o CEP:', error);
                }
            } else {
                alert('CEP deve ter 8 dígitos.');
            }
        }

        function submit() {
            router.post(`/pessoas/${props.pessoa.id}/enderecos`, form);
        }

        return { form, submit, fetchAddress, readonlyFields };
    }
};
</script>
