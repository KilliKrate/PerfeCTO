<template>
  <v-container v-if="company">
    <v-row align="center" class="pl-2">
      <h1 class="display-2">{{company.attributes.business_name}}</h1>
      <v-chip
        class="ml-5 white--text"
        :color="company.relationships.main_field ? company.relationships.main_field.color : '#424242'"
      >{{company.relationships.main_field ? company.relationships.main_field.name : 'N/A'}}</v-chip>
    </v-row>
    <v-row class="pl-2">
      <v-chip
        small
        class="mt-2 mr-2"
        color="primary"
        v-for="field in company.relationships.secondary_fields"
        :key="field.id"
      >Informatica</v-chip>
    </v-row>

    <div
      class="mt-5"
    >Lorem ipsum dolor, sit amet consectetur adipisicing elit. Autem ad asperiores, doloribus earum distinctio veritatis numquam exercitationem repellat sed officia? Praesentium totam numquam veritatis illum. Iusto reprehenderit corporis maxime nisi nam quaerat. Reprehenderit aspernatur a neque odio, sint officiis iste itaque labore. Maxime perspiciatis quas aperiam veritatis, qui assumenda vitae.</div>
  </v-container>
</template>
<script>
import axios from "axios";

export default {
  data() {
    return {
      company: null
    };
  },
  methods: {
    getCompany(id) {
      axios.get(`/api/companies/${this.$route.params.id}`).then(response => {
        this.company = response.data.data;
      });
    }
  },
  mounted() {
    this.getCompany();
  }
};
</script>
