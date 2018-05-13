<template>
    <layout>
        <section class="mainContent">
            <div class="card">
                <div class="card-body p-0">
                    <div class="row stat-cards">
                        <stat-card class="col-md-3"
                                   title="Online Visitor"
                                   sub-title="Number of online visitors"
                                   :value="stats.online.visitors"
                                   icon="fas fa-globe"/>

                        <stat-card class="col-md-3"
                                   title="Online User"
                                   sub-title="Number of online logged-in users"
                                   :value="stats.online.users"
                                   icon="fas fa-user"/>

                        <stat-card class="col-md-3"
                                   title="CPU Usage"
                                   sub-title="CPU usage in server"
                                   :value="stats.server.cpu"
                                   icon="fas fa-microchip"/>

                        <stat-card class="col-md-3"
                                   title="Memory Usage"
                                   sub-title="Memory usage in server"
                                   :value="stats.server.memory"
                                   icon="fas fa-server"/>
                    </div>

                    <div class="row stat-cards">
                        <stat-card class="col-md-6 datetime"
                                   title="Server Time"
                                   :sub-title="stats.server.datetime.timezone"
                                   :value="stats.server.datetime.string"
                                   icon="fas fa-clock"/>
                    </div>
                </div>
            </div>
        </section>
    </layout>
</template>

<script type="text/ecmascript-6">
  import Layout   from "../layouts/MainLayout";
  import StatCard from "../components/Cards/StatCard";

  export default {
    name: "Dashboard",

    components: {Layout, StatCard},

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

    mounted() {
      document.title = "Server Dashboard";

      this.refreshStatsPeriodically();
    },

    destroyed() {
      clearTimeout(this.timeout);
    },

    methods: {
      loadOnlineStats() {
        return this.$http.get(this._prepareUrl("/api/stats/online")).then(response => {
          this.stats.online.users = response.data.users;
          this.stats.online.visitors = response.data.visitors;
        });
      },

      loadServerStats() {
        return this.$http.get(this._prepareUrl("/api/stats/server")).then(response => {
          this.stats.server.cpu = response.data.cpu;
          this.stats.server.memory = response.data.memory;
          this.stats.server.datetime.string = response.data.datetime.string;
          this.stats.server.datetime.timezone = response.data.datetime.timezone.timezone;
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

      _prepareUrl: uri => "/" + baseUri + uri,
    },
  };
</script>

<style scoped>

</style>
