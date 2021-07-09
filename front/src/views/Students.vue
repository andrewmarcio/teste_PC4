<template>
  <div class="home">
    <!-- <img alt="Vue logo" src="../assets/logo.png" /> -->
    <b-container class="my-5 px-5" fluid>
      <b-row class="justify-content-md-center">
        <b-col cols="12">
          <div>
            <b-card-group deck>
              <b-card>
                <template #header>
                  <b-row>
                    <b-col>
                      <h3 class="mb-0 ml-3 text-left">Students</h3>
                    </b-col>
                    <b-col class="text-right">
                      <b-button> <font-awesome-icon icon="plus" /> Add Student</b-button>
                    </b-col>
                  </b-row>
                </template>
                <b-form-input
                  v-model="keyword"
                  placeholder="Search"
                ></b-form-input>
                <b-form-group class="my-1" label="" v-slot="{ ariaDescribedby }">
                    <b-form-radio-group
                        id="radio-group-1"
                        v-model="selected_field"
                        :options="searchable_fields"
                        :aria-describedby="ariaDescribedby"
                        name="radio-options"
                    ></b-form-radio-group>
                </b-form-group>
                
                <b-table
                  class="mt-3"
                  id="table-students"
                  :fields="fields"
                  :items="students.data"
                  :per-page="perPage"
                  :current-page="currentPage"
                  :busy="isLoading"
                  responsive
                >
                  <template #table-busy>
                    <div class="text-center text-danger my-2">
                      <b-spinner
                        class="align-middle"
                        variant="primary"
                      ></b-spinner>
                      <strong class="text-primary">Loading...</strong>
                    </div>
                  </template>

                  <template #cell(actions)>
                    <b-button-group>
                      <b-button size="sm" variant="warning">
                        
                        <font-awesome-icon icon="edit" />
                      </b-button>
                      <b-button size="sm" variant="danger">
                        
                        <font-awesome-icon icon="trash" />
                      </b-button>
                    </b-button-group>
                  </template>
                </b-table>

                <template #footer>
                  <b-row align-h="center">
                    <b-col cols="12" class="overflow-auto">
                      <pagination :data="students" @pagination-change-page="getStudents"></pagination>
                    </b-col>
                  </b-row>
                </template>
              </b-card>
            </b-card-group>
          </div>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
// @ is an alias to /src
import api from "../util/baseApi";
import {defaultHeaders} from "../util/constants";

export default {
  name: "Students",
  data() {
    return {
      keyword: null,
      isLoading: false,
      perPage: 0,
      currentPage: 0,
      students: {},
      fields: [
        {key: "id", label: "Cod"},
        {key: "name", label: "Name"},
        {key: "email", label: "Email"},
        "phone",
        "gender",
        "actions"
      ],
      selected_field: "id",
      searchable_fields: [
          {text: "Cod", value: "id"},
          {text: "Name", value: "name"},
          {text: "Email", value: "email"},
          {text: "Phone", value: "phone"},
          {text: "Gender", value: "gender"},
      ]
    };
  },
  mounted(){
    this.getStudents()
  },
  methods: {
    getStudents(page = 1) {
      this.togglerLoading();
      
      const config = {
        headers: defaultHeaders()
      }
      
      api
        .get(`api/students?page=${page}`, config)
        .then((response) => {
          this.students = response.data;
          this.togglerLoading();
        })
        .catch(() => {
          this.togglerLoading();
            this.$toast.error(
              "Ocorreram erros, verifique sua conexão com a internet!"
            );
        });
    },
    search(){
      this.togglerLoading();
      
      const config = {
        headers: defaultHeaders(),
      };

      const params = {
          keyword: this.keyword, 
          filter: this.selected_field
        }
      
      api
        .post(`api/students/search`, params, config)
        .then((response) => {
          this.students = response.data;
          this.togglerLoading();
        })
        .catch(() => {
          this.togglerLoading();
            this.$toast.error(
              "Ocorreram erros, verifique sua conexão com a internet!"
            );
        });
    },
    togglerLoading() {
      return (this.isLoading = !this.isLoading);
    },
  },
  computed: {
    rows() {
      return this.students.length;
    },
  },
  watch: {
        keyword() {
            this.search();
        }
    }
};
</script>
