<template>
    <div>
      <v-container>
        <v-form>
          <v-text-field
            v-model="cep"
            label="CEP"
            @blur="fetchAddress"
            placeholder="Digite o CEP"
          />
          <v-btn @click="fetchAddress">Buscar</v-btn>
  
          <v-card v-if="address">
            <v-card-title>Endereço</v-card-title>
            <v-card-subtitle>{{ address.logradouro }}, {{ address.bairro }}</v-card-subtitle>
            <v-card-text>
              {{ address.localidade }} - {{ address.uf }}
            </v-card-text>
          </v-card>
        </v-form>
      </v-container>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        cep: '',
        address: null,
      };
    },
    methods: {
      async fetchAddress() {
        if (this.cep.length === 8) {
          try {
            const response = await axios.get(`https://viacep.com.br/ws/${this.cep}/json/`);
            this.address = response.data;
          } catch (error) {
            console.error('Erro ao buscar o CEP:', error);
          }
        } else {
          alert('CEP deve ter 8 dígitos.');
        }
      },
    },
  };
  </script>
  