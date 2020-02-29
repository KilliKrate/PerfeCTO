<template>
  <v-container class="my-5">
    <v-list v-if="companies">
      <v-card class="pa-3 mb-2" elevation="4" v-for="company in companies" :key="company.id">
        <v-container>
          <v-row wrap>
            <v-col xs="12" md="3">
              <div class="caption grey--text--darken-1">Business Name</div>
              <div>{{company.attributes.business_name}}</div>
            </v-col>
            <v-divider class="hidden-sm-and-down" vertical></v-divider>
            <v-col class="text-center" xs="6" md="2">
              <div class="caption grey--text--darken-1">Address</div>
              <div>{{company.relationships.address.name}}</div>
            </v-col>
            <v-col class="text-center" xs="6" md="2">
              <div class="caption grey--text--darken-1">Primary Field</div>
              <div>{{company.relationships.type.name}}</div>
            </v-col>
            <v-col class="text-center hidden-sm-and-down" md="2">
              <div class="caption grey--text--darken-1">Company Size</div>
              <div>{{company.attributes.employees ? company.attributes.employees+" people" : 'N/A'}}</div>
            </v-col>
            <v-col class="text-center hidden-sm-and-down" md="2">
              <div class="caption grey--text--darken-1">Ateco</div>
              <div>{{company.attributes.ateco ? company.attributes.ateco : 'N/A'}}</div>
            </v-col>
          </v-row>
        </v-container>
      </v-card>
    </v-list>

    <v-pagination
      v-if="companies"
      v-model="pagination.current"
      :length="pagination.total"
      :total-visible="7"
      @input="onPageChange"
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
    }
  },
  mounted() {
    this.getCompanies();
  }
};
</script>
