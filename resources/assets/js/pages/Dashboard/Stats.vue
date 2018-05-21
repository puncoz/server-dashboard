<template>
    <div>
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
</template>

<script type="text/ecmascript-6">
  import StatCard from "../../components/StatCard";

  export default {
    name: "Stats",

    components: {StatCard},

    props: {
      stats: {required: true, type: Object},
    },
  };
</script>

<style scoped>

</style>
