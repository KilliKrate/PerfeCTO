<template>
  <nav>
    <v-app-bar flat app>
      <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
      <v-toolbar-title>
        <span class="font-weight-medium float-left">P</span>
        <span class="font-weight-light float-left">erfe</span>
        <span class="font-weight-medium float-left">CTO</span>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn text>
        <span>Sign out</span>
        <v-icon right>mdi-logout-variant</v-icon>
      </v-btn>
    </v-app-bar>

    <v-navigation-drawer app v-model="drawer" dark color="indigo">
      <v-list dense nav class="mt-1">
        <v-list-item v-for="link in links" :key="link.text" :to="link.route" exact>
          <v-list-item-icon>
            <v-icon>{{link.icon}}</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>{{link.text}}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
  </nav>
</template>

<script>
export default {
  data() {
    return {
      drawer: false,
      links: [
        {
          icon: "mdi-view-dashboard",
          text: "Dashboard",
          route: "/app/dashboard"
        },
        {
          icon: "mdi-domain",
          text: "Companies",
          route: "/app"
        },
        {
          icon: "mdi-information-outline",
          text: "About",
          route: "/app/about"
        }
      ]
    };
  }
};
</script>
