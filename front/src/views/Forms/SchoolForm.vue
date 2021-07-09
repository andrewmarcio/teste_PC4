<template>
    <b-container class="my-5 px-5">
        <b-row class="justify-content-md-center">
            <b-col cols="7">
                <b-card-group deck>
                    <b-card>
                        <template #header>
                            <h6 class="mb-0">Add School</h6>
                        </template>
                        <form @submit.prevent="store" method="POST">
                        
                        <div>
                            <b-form-group
                                id="name"
                                label-for="input-name"
                            >
                                <b-form-input id="input-name" v-model="school.name" :state="state" trim placeholder="School name"></b-form-input>
                                <div v-if="errors.name">
                                    {{errors.name}}
                                </div>
                            </b-form-group>
                            <b-form-group
                                id="address"
                                label-for="input-address"
                            >
                                <b-form-input id="input-address" v-model="school.address" :state="state" trim placeholder="School address"></b-form-input>
                                <div v-if="errors.address">
                                    {{errors.address}}
                                </div>
                            </b-form-group>
                            <b-form-group
                                id="neighborhood"
                                label-for="input-neighborhood"
                            >
                                <b-form-input id="input-neighborhood" v-model="school.neighborhood" :state="state" trim placeholder="School neighborhood"></b-form-input>
                                <div v-if="errors.neighborhood">
                                    {{errors.neighborhood}}
                                </div>
                            </b-form-group>
                            <b-form-group
                                id="number"
                                label-for="input-number"
                            >
                                <b-form-input id="input-number" v-model="school.number" :state="state" trim placeholder="School number"></b-form-input>
                                <div v-if="errors.number">
                                    {{errors.number}}
                                </div>
                            </b-form-group>
                            <b-form-group
                                id="zip"
                                label-for="input-zip"
                            >
                                <b-form-input id="input-zip" v-model="school.zip" :state="state" trim placeholder="School zip"></b-form-input>
                                <div v-if="errors.zip">
                                    {{errors.zip}}
                                </div>
                            </b-form-group>

                            <b-button block variant="success" type="submit">Send</b-button>
                        </div>
                        </form>
                    </b-card>
                </b-card-group>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
import api from '../../util/baseApi';

import {defaultHeaders, mapErrors} from "../../util/constants";

export default {
    name: "SchoolForm",
    data(){
        return {
            errors: {},
            school: {},
        }
    },
    methods: {
        store(){
            const config = {
                headers: defaultHeaders()
            }
            const params = this.school

            api.post("api/schools", params, config)
                .then(response => {
                    this.$toast.success(
                        response.data.message
                    );
                    this.$router.push('/')
                })
                .catch(error => {
                    this.errors = mapErrors(error) 
                    this.$toast.error(
                        "Ocorreram erros, verifique sua conexão com a internet!"
                    );
                })
        }
    }
}
</script>