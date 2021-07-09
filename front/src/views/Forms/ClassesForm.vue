<template>
    <b-container class="my-5 px-5">
        <b-row class="justify-content-md-center">
            <b-col cols="7">
                <b-card-group deck>
                    <b-card>
                        <template #header>
                            <h6 class="mb-0">Add Class</h6>
                        </template>
                        <form @submit.prevent="store" method="POST">
                        
                        <div>
                            <b-form-group
                                id="school_id"
                                label-for="input-school_id"
                            >
                                <b-form-select v-model="selected_school" :options="schools"></b-form-select>
                                <div v-if="errors.school_id">
                                    {{errors.school_id}}
                                </div>
                            </b-form-group>
                            <b-form-group
                                id="address"
                                label-for="input-address"
                            >
                                <b-form-select v-model="selected_level" :options="levels"></b-form-select>
                                <div v-if="errors.nivel_id">
                                    {{errors.nivel_id}}
                                </div>
                            </b-form-group>
                            <b-form-group
                                id="serie"
                                label-for="input-serie"
                            >
                                <b-form-input id="input-serie" v-model="school.serie" trim placeholder="Class serie"></b-form-input>
                                <div v-if="errors.serie">
                                    {{errors.serie}}
                                </div>
                            </b-form-group>
                            <b-form-group
                                id="turn"
                                label-for="input-turn"
                            >
                                <b-form-input id="input-turn" v-model="school.turn" trim placeholder="Class turn"></b-form-input>
                                <div v-if="errors.turn">
                                    {{errors.turn}}
                                </div>
                            </b-form-group>
                            <b-form-group
                                id="year"
                                label-for="input-year"
                            >
                                <b-form-input id="input-year" v-model="school.year" trim placeholder="Class year"></b-form-input>
                                <div v-if="errors.year">
                                    {{errors.year}}
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
    name: "ClassesForm",
    data(){
        this.getData()
        return {
            schools: [{value:null, text:"Select a school"}],
            levels: [{value:null, text:"Select an Educational Level"}],
            selected_school: null,
            selected_nivel: null,
            formData: {},
            errors: {},
            school: {},
        }
    },
    mounted(){
        // this.getData()
    },
    methods: {
        getData(){
            const config = {
                headers: defaultHeaders()
            }

            api.get("api/classes/create", config)
                .then(response => {
                    this.schools = response.data.schools.map(school => {
                        return { value: school.id, text: school.name};
                    });

                    this.levels = response.data.levels.map(level => {
                        return { value: level.id, text: level.description};
                    });
                })
                .catch(() => {
                    this.$toast.error(
                        "Ocorreram erros, verifique sua conexão com a internet!"
                    );
                })
        },
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
                    this.$router.push('/schools')
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