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
                      <h3 class="mb-0 ml-3 text-left">Schools</h3>
                    </b-col>
                    <b-col class="text-right">
                      <b-button to="/school/create"> <font-awesome-icon icon="plus" /> Add School</b-button>
                    </b-col>
                  </b-row>
                </template>
                <b-form-input
                  v-model="keyword"
                  placeholder="Search name"
                ></b-form-input>
                
                <b-table
                  class="mt-3"
                  id="table-schools"
                  :fields="fields"
                  :items="schools.data"
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
                      <pagination :data="schools" @pagination-change-page="getSchools"></pagination>
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
  name: "Home",
  data() {
    return {
      keyword: null,
      isLoading: false,
      perPage: 0,
      currentPage: 0,
      schools: {},
      fields: [
        {key: "id", label: "Cod"},
        "name",
        "address",
        "neighborhood",
        "number",
        "zip",
        "actions",
      ],
    };
  },
  mounted(){
    this.getSchools()
  },
  methods: {
    getSchools(page = 1) {
      this.togglerLoading();
      
      const config = {
        headers: defaultHeaders()
      }
      
      api
        .get(`api/schools?page=${page}`, config)
        .then((response) => {
          this.schools = response.data;
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
      
      api
        .post(`api/schools/search`, {keyword: this.keyword}, config)
        .then((response) => {
          this.schools = response.data;
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
      return this.schools.length;
    },
  },
  watch: {
        keyword() {
            this.search();
        }
    }
};
</script>
