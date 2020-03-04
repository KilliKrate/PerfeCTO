<template>
  <v-container class="my-5">
    <v-row class="px-3 mb-1">
      <v-btn small flat @click="sortBy('business_name')">
        <v-icon small left>mdi-sort-alphabetical-descending</v-icon>
        <span class="caption text-capitalize">Order by Business Name</span>
      </v-btn>
      <v-btn small flat @click="sortBy('employees')">
        <v-icon small left>mdi-sort-alphabetical-descending</v-icon>
        <span class="caption text-capitalize">Order by Business Name</span>
      </v-btn>
    </v-row>
    <v-list>
      <div v-if="!companies">
        <v-card class="pa-3 mb-2" v-for="index in 10" :key="index">
          <v-skeleton-loader height="100" type="list-item-two-line"></v-skeleton-loader>
        </v-card>
      </div>
      <div v-for="company in companies" :key="company.id" v-else>
        <v-card
          class="pa-3 mb-2"
          elevation="4"
          :style="{borderLeft: company.relationships.main_field ? getColoredBorder(company.relationships.main_field.colour) : '#eeeeee'}"
        >
          <v-container>
            <v-row>
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
                  class="white--text mt-1"
                  :color="company.relationships.main_field ? company.relationships.main_field.colour : '#424242'"
                >{{company.relationships.main_field ? company.relationships.main_field.name : 'N/A'}}</v-chip>
              </v-col>
            </v-row>
          </v-container>
        </v-card>
      </div>
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
      }
    };
  },
  methods: {
    getCompanies() {
      axios
        .get("/api/companies?page=" + this.pagination.current)
        .then(response => {
          this.companies = response.data.data;
          this.pagination.current = response.data.meta.current_page;
          this.pagination.total = response.data.meta.last_page;
        });
    },
    onPageChange() {
      this.getCompanies();
      this.companies = null;
    },
    getColoredBorder(color) {
      return "4px solid " + color;
    }
  },
  mounted() {
    this.getCompanies();
  }
};
</script>
