<template>
    <div class="container">
        <div class="table-refresh">
            <i class="fas fa-sync-alt"
               data-toggle="tooltip" data-placement="top" title="Refresh database table"
               @click="refreshDBTable"></i>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Table</th>
                    <th scope="col">Row Counts</th>
                    <th scope="col">Last Updated</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(table, index) in dbTables">
                    <th scope="row" v-text="index + 1"></th>
                    <td v-text="table.name"></td>
                    <td v-text="table.row_count"></td>
                    <td v-text="table.last_updated_at"></td>
                </tr>

                <tr v-if="dbTables.length === 0">
                    <td colspan="4" v-text="'No table found.'"></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script type="text/ecmascript-6">
  export default {
    name: "Database",

    components: {},

    inject: ["prepareApiUri"],

    data() {
      return {
        dbTables: [],
      };
    },

    computed: {
      dbTableStatsApi() {return this.prepareApiUri("/api/database/tables");},
    },

    mounted() {
      this.fetchDBTablesStats();
    },

    methods: {
      fetchDBTablesStats() {
        this.$http.get(this.dbTableStatsApi).then(response => {
          this.dbTables = response.data.data;
        });
      },

      refreshDBTable() {
        this.fetchDBTablesStats();
      },
    },
  };
</script>

<style scoped>
    .table-refresh {
        float: right;
        margin: 15px 0;
        cursor: pointer;
    }
</style>
