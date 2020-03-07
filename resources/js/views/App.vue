<template>
  <v-app>
    <Navbar />
    <v-content>
      <!--TODO: Figure out a way to keep only the companies page alive-->
      <keep-alive include="Companies">
        <router-view />
      </keep-alive>
    </v-content>
  </v-app>
</template>

<script>
import Navbar from "../components/Navbar";

export default {
  name: "App",
  components: {
    Navbar
  }
};
</script>
