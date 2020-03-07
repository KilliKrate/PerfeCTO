<template>
  <v-container class="my-5">
    <v-row class="px-3 mb-1">
      <!-- Dropdown for Business Name sorting -->
      <v-menu open-on-hover offset-y>
        <template v-slot:activator="{ on }">
          <v-btn v-on="on">
            <v-icon small left>mdi-sort-alphabetical</v-icon>
            <span class="caption text-capitalize">Order by Business Name</span>
          </v-btn>
        </template>
        <v-list>
          <v-list-item @click="sort('business_name', 'asc')">
            <v-list-item-title>Ascending</v-list-item-title>
          </v-list-item>
          <v-list-item @click="sort('business_name', 'desc')">
            <v-list-item-title>Descending</v-list-item-title>
          </v-list-item>
        </v-list>
      </v-menu>
      <!-- End of Dropdown for Business Name sorting -->

      <!-- Dropdown for Business Size sorting -->
      <v-menu open-on-hover offset-y>
        <template v-slot:activator="{ on }">
          <v-btn v-on="on">
            <v-icon small left>mdi-sort-numeric</v-icon>
            <span class="caption text-capitalize">Order by Number of Employees</span>
          </v-btn>
        </template>
        <v-list>
          <v-list-item @click="sort('n_employees', 'asc')">
            <v-list-item-title>Ascending</v-list-item-title>
          </v-list-item>
          <v-list-item @click="sort('n_employees', 'desc')">
            <v-list-item-title>Descending</v-list-item-title>
          </v-list-item>
        </v-list>
      </v-menu>
      <!-- End of Dropdown for Business Size sorting -->
    </v-row>
    <v-list>
      <!-- Skeleton loaders for companies -->
      <div v-if="!companies">
        <v-card class="pa-3 mb-2" v-for="index in 10" :key="index">
          <v-skeleton-loader height="100" type="list-item-two-line"></v-skeleton-loader>
        </v-card>
      </div>
      <!-- End of Skeleton loaders for companies -->

      <!-- Company Cards -->
      <div v-for="company in companies" :key="company.id" v-else>
        <v-card
          class="pa-3 mb-2"
          elevation="4"
          :to="{ name: 'company', params: { id: company.id }}"
          :style="{borderLeft: company.relationships.main_field ? getColoredBorder(company.relationships.main_field.color) : '#eeeeee'}"
        >
          <v-container>
            <v-row align="center">
              <v-col class="text-center" md="4" sm="4" cols="4">
                <div class="caption grey--text--darken-1">Business Name</div>
                <div>{{company.attributes.business_name}}</div>
              </v-col>
              <v-divider class="hidden-sm-and-down" vertical></v-divider>
              <v-col class="text-center" md="3" sm="4" cols="4">
                <div class="caption grey--text--darken-1">Address</div>
                <div>{{company.relationships.address}}</div>
              </v-col>
              <v-col class="text-center" md="2" sm="4" cols="4">
                <div class="caption grey--text--darken-1">Company Size</div>
                <div>{{company.attributes.employees ? company.attributes.employees+" PEOPLE" : 'N/A'}}</div>
              </v-col>
              <v-col class="text-center" md="2" sm="12" cols="12">
                <v-chip
                  class="white--text"
                  :color="company.relationships.main_field ? company.relationships.main_field.color : '#424242'"
                >{{company.relationships.main_field ? company.relationships.main_field.name : 'N/A'}}</v-chip>
              </v-col>
              <v-btn icon @click="deleteCompany(company.id)">
                <v-icon>mdi-close</v-icon>
              </v-btn>
            </v-row>
          </v-container>
        </v-card>
      </div>
      <!-- End of Company Cards -->
    </v-list>

    <v-pagination
      v-model="pagination.current"
      :length="pagination.total"
      :total-visible="7"
      @input="onPageChange"
      color="indigo"
    ></v-pagination>
  </v-container>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      companies: null,
      pagination: {
        current: 1,
        total: 0
      },
      sorting: {
        field: "",
        order: ""
      }
    };
  },
  methods: {
    getCompanies() {
      this.companies = null;
      axios
        .get(
          `/api/companies?
          page=${this.pagination.current}&
          sort=${this.sorting.field}&
          order=${this.sorting.order}`
        )
        .then(response => {
          this.companies = response.data.data;
          this.pagination.current = response.data.meta.current_page;
          this.pagination.total = response.data.meta.last_page;
        });
    },
    deleteCompany(companyID) {
      let i = this.companies.map(company => company.id).indexOf(companyID);
      this.companies.splice(i, 1);
      axios.delete(`/api/companies/${companyID}`);
    },
    onPageChange() {
      this.getCompanies();
      this.companies = null;
    },
    getColoredBorder(color) {
      return "4px solid " + color;
    },
    sort(field, order) {
      this.sorting.field = field;
      this.sorting.order = order;
      this.pagination.current = 1;
      this.getCompanies();
    }
  },
  mounted() {
    this.getCompanies();
  }
};
</script>
