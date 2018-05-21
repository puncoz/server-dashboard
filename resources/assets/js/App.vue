<template>
    <layout>
        <main-content>
            <transition name="fade">
                <keep-alive>
                    <router-view/>
                </keep-alive>
            </transition>
        </main-content>
    </layout>
</template>

<script type="text/ecmascript-6">
  import Layout      from "./layouts/MainLayout";
  import MainContent from "./layouts/MainContent";

  export default {
    name: "App",

    components: {MainContent, Layout},

    provide() {
      return {
        prepareApiUri: this.prepareApiUri,
      };
    },

    data() {
      return {};
    },

    methods: {
      prepareApiUri: uri => "/" + baseUri + uri,
    },
  };
</script>

<style scoped>

</style>
