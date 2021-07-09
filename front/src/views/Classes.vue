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
                      <h3 class="mb-0 ml-3 text-left">Classes</h3>
                    </b-col>
                    <b-col class="text-right">
                      <b-button to="/classes/create"> <font-awesome-icon icon="plus" /> Add Class</b-button>
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
                  id="table-classes"
                  :fields="fields"
                  :items="classes.data"
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
                      <pagination :data="classes" @pagination-change-page="getClasses"></pagination>
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
  name: "Classes",
  data() {
    return {
      keyword: null,
      isLoading: false,
      perPage: 0,
      currentPage: 0,
      classes: {},
      fields: [
        {key: "id", label: "Cod"},
        {key: "school.name", label: "School"},
        {key: "level.description", label: "Educational Level"},
        "serie",
        "turn",
        "year",
        "actions"
      ],
      selected_field: "id",
      searchable_fields: [
          {text: "Cod", value: "id"},
          {text: "School", value: "school_id"},
          {text: "Educational Level", value: "nivel_id"},
          {text: "Serie", value: "serie"},
          {text: "Turn", value: "turn"},
          {text: "Year", value: "year"},
      ]
    };
  },
  mounted(){
    this.getClasses()
  },
  methods: {
    getClasses(page = 1) {
      this.togglerLoading();
      
      const config = {
        headers: defaultHeaders()
      }
      
      api
        .get(`api/classes?page=${page}`, config)
        .then((response) => {
          this.classes = response.data;
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
        .post(`api/classes/search`, params, config)
        .then((response) => {
          this.classes = response.data;
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
      return this.classes.length;
    },
  },
  watch: {
        keyword() {
            this.search();
        }
    }
};
</script>
