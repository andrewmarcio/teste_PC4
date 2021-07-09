<template>
    <b-container class="my-5 px-5">
        <b-row class="justify-content-md-center">
            <b-col cols="7">
                <b-card-group deck>
                    <b-card>
                        <template #header>
                            <h6 class="mb-0">Add Student</h6>
                        </template>
                        <form @submit.prevent="store" method="POST">
                        
                        <div>
                            <b-form-group
                                id="class_id"
                                label-for="input-class_id"
                            >
                                <b-form-select v-model="formData.class_id" :options="classes"></b-form-select>
                                <div v-if="errors.class_id">
                                    {{errors.class_id}}
                                </div>
                            </b-form-group>
                            <b-form-group
                                id="name"
                                label-for="input-name"
                            >
                                <b-form-input id="input-name" v-model="formData.name" trim placeholder="Student name"></b-form-input>
                                <div v-if="errors.name">
                                    {{errors.name}}
                                </div>
                            </b-form-group>
                            <b-form-group
                                id="email"
                                label-for="input-email"
                            >
                                <b-form-input id="input-email" v-model="formData.email" trim placeholder="Student email"></b-form-input>
                                <div v-if="errors.email">
                                    {{errors.email}}
                                </div>
                            </b-form-group>
                            <b-form-group
                                id="phone"
                                label-for="input-phone"
                            >
                                <b-form-input id="input-phone" v-model="formData.phone" trim placeholder="Student phone"></b-form-input>
                                <div v-if="errors.phone">
                                    {{errors.phone}}
                                </div>
                            </b-form-group>
                            <b-form-group
                                id="birthday"
                                label-for="input-birthday"
                            >
                                <b-form-input type="date" id="input-birthday" v-model="formData.birthday" trim placeholder="Student birthday"></b-form-input>
                                <div v-if="errors.birthday">
                                    {{errors.birthday}}
                                </div>
                            </b-form-group>
                            <b-form-group
                                id="gender"
                                label-for="input-gender"
                            >
                                <b-form-select v-model="formData.gender" :options="genders"></b-form-select>
                                <div v-if="errors.gender">
                                    {{errors.gender}}
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
    name: "StudentForm",
    data(){

        let classes = [{value:null, text:"Select a class"}];
        let genders = [{value:null, text:"Select a gender"}, {value: "M", text: "Male"}, {value: "F", text: "Famale"}, {value: "O", text: "Others"}];

        this.getData((error, data) => {
            if(error)
            {
                this.$toast.error(
                    "Ocorreram erros, verifique sua conexão com a internet!"
                );
                return
            }

            data.classes.map(classe => {
                classes.push({ value: classe.id, text: `${classe.school.name} - 
                                                        ${classe.level.description} - 
                                                        ${classe.serie} - ${classe.turn} - ${classe.year}`});
            });
        })
        return {
            classes,
            genders,
            formData: {
                class_id: null,
                gender: null,
            },
            errors: {},
        }
    },
    methods: {
        getData(callback){
            const config = {
                headers: defaultHeaders()
            }

            api.get("api/students/create", config)
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

            api.post("api/students", params, config)
                .then(response => {
                    this.$toast.success(
                        response.data.message
                    );
                    this.$router.push('/students')
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