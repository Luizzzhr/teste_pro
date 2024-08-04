<template>
    <v-card>
        <h1>Criar Pessoa</h1>
        <v-form v-model="valid" @submit.prevent="submit">
            <v-container>
                <v-row>
                    <v-col
                        cols="12"
                        md="4"
                    >
                        <v-text-field
                            v-model="form.nome"
                            :counter="10"
                            :rules="nameRules"
                            label="Name"
                            hide-details
                            required
                        ></v-text-field>
                    </v-col>

                    <v-col
                        cols="12"
                        md="4"
                    >
                        <v-text-field
                            v-model="form.email"
                            :counter="10"
                            :rules="emailRules"
                            label="Email"
                            hide-details
                            required
                        ></v-text-field>
                    </v-col>

                    <v-col
                        cols="12"
                        md="4"
                    >
                        <v-text-field
                            v-model="form.cpf"
                            :counter="10"
                            :rules="nameRules"
                            label="CPF"
                            hide-details
                            required
                        ></v-text-field>
                    </v-col>
                </v-row>
            </v-container>
            <v-btn
                class="mt-2"
                text="Submit"
                type="submit"
                block
            ></v-btn>
            
        </v-form>
    </v-card>
</template>

<script>
import { reactive } from 'vue';
import { router } from '@inertiajs/vue3'

export default {
    data: () => ({
        valid: false,
        nameRules: [
            value => {
                if (value) return true

                return 'Name is required.'
            },
            value => {
                if (value?.length <= 10) return true

                return 'Name must be less than 10 characters.'
            },
        ],
        emailRules: [
            value => {
                if (value) return true

                return 'E-mail is requred.'
            },
            value => {
                if (/.+@.+\..+/.test(value)) return true

                return 'E-mail must be valid.'
            },
        ],
    }),

    setup() {
        const form = reactive({
            nome: '',
            email: '',
            cpf: ''
        });

        function submit() {
            router.post('/pessoas', form);
        }

        return { form, submit };
    }
};
</script>
