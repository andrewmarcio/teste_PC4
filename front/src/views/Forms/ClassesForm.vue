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
                                <b-form-select v-model="formData.school_id" :options="schools"></b-form-select>
                                <div v-if="errors.school_id">
                                    {{errors.school_id}}
                                </div>
                            </b-form-group>
                            <b-form-group
                                id="address"
                                label-for="input-address"
                            >
                                <b-form-select v-model="formData.nivel_id" :options="levels"></b-form-select>
                                <div v-if="errors.nivel_id">
                                    {{errors.nivel_id}}
                                </div>
                            </b-form-group>
                            <b-form-group
                                id="turn"
                                label-for="input-turn"
                            >
                                <b-form-select v-model="formData.turn" :options="turns"></b-form-select>
                                <div v-if="errors.turn">
                                    {{errors.turn}}
                                </div>
                            </b-form-group>
                            <b-form-group
                                id="serie"
                                label-for="input-serie"
                            >
                                <b-form-input id="input-serie" v-model="formData.serie" trim placeholder="Class serie"></b-form-input>
                                <div v-if="errors.serie">
                                    {{errors.serie}}
                                </div>
                            </b-form-group>
                            <b-form-group
                                id="year"
                                label-for="input-year"
                            >
                                <b-form-input id="input-year" v-model="formData.year" trim placeholder="Class year"></b-form-input>
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

        let schools = [{value:null, text:"Select a school"}];
        let levels = [{value:null, text:"Select an Educational Level"}];
        let turns = [{value:null, text:"Select a turn"}, {value: "M", text: "Morning"}, {value: "T", text: "Afternoon"}, {value: "N", text: "Night"}];

        this.getData((error, data) => {
            if(error)
            {
                this.$toast.error(
                    "Ocorreram erros, verifique sua conexão com a internet!"
                );
                return
            }

            data.schools.map(school => {
                schools.push({ value: school.id, text: school.name});
            });

            data.levels.map(level => {
                levels.push({ value: level.id, text: level.description});
            });
        })
        return {
            schools,
            levels,
            turns,
            formData: {
                school_id: null,
                nivel_id: null,
                turn: null,
            },
            errors: {},
        }
    },
    methods: {
        getData(callback){
            const config = {
                headers: defaultHeaders()
            }

            api.get("api/classes/create", config)
                .then(response => {
                    callback(undefined, response.data)
                })
                .catch(error => {
                    callback(error, undefined)
                })
        },
        store(){
            const config = {
                headers: defaultHeaders()
            }
            const params = this.formData

            api.post("api/classes", params, config)
                .then(response => {
                    this.$toast.success(
                        response.data.message
                    );
                    this.$router.push('/classes')
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