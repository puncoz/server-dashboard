<template>
    <div class="container">
        <stats :stats="stats"></stats>
    </div>
</template>

<script type="text/ecmascript-6">
  import Stats from "./Stats";

  export default {
    name: "Dashboard",

    components: {Stats},

    inject: ["prepareApiUri"],

    data() {
      return {
        stats: {
          online: {
            visitors: 0,
            users: 0,
          },
          server: {
            cpu: 0,
            memory: 0,
            datetime: {
              string: new Date().toLocaleString(),
              timezone: "",
            },
          },
        },
      };
    },

    computed: {
      onlineStatsApi() {return this.prepareApiUri("/api/stats/online");},
      serverStatsApi() {return this.prepareApiUri("/api/stats/server");},
    },

    mounted() {
      this.refreshStatsPeriodically();
    },

    destroyed() {
      clearTimeout(this.timeout);
    },

    methods: {
      loadOnlineStats() {
        return this.$http.get(this.onlineStatsApi).then(response => {
          const onlineStats = response.data.data;

          this.stats.online.users = onlineStats.users;
          this.stats.online.visitors = onlineStats.visitors;
        });
      },

      loadServerStats() {
        return this.$http.get(this.serverStatsApi).then(response => {
          const serverStats = response.data.data;

          this.stats.server.cpu = serverStats.cpu;
          this.stats.server.memory = serverStats.memory;
          this.stats.server.datetime.string = serverStats.datetime.string;
          this.stats.server.datetime.timezone = serverStats.datetime.timezone.timezone;
        });
      },

      refreshStatsPeriodically() {
        Promise.all([
          this.loadOnlineStats(),
          this.loadServerStats(),
        ]).then(() => {
          this.timeout = setTimeout(() => {
            this.refreshStatsPeriodically();
          }, 5000);
        });
      },

    },
  };
</script>

<style scoped>

</style>
