<template>
    <div class="container">
        <div class="table-connection">
            Connection:
            <i class="fas" :class="connectionStatusClass"
               data-toggle="tooltip" data-placement="top" :title="connectionStatus ? 'Database connection succeed' : 'Database connection failed'"
               @click="refreshDBTable"></i>
        </div>
        <div class="table-refresh">
            <i class="fas fa-sync-alt"
               data-toggle="tooltip" data-placement="top" title="Refresh database table"
               @click="refreshDBTable"></i>
        </div>
        <div class="table-wrapper table-responsive">
            <loading :show-loader="tableLoadingStatus"></loading>
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
                    <td v-text="table.last_updated_at || '-'"></td>
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
  import Loading from "../../components/Loading/Loading";

  export default {
    name: "Database",

    components: {Loading},

    inject: ["prepareApiUri"],

    data() {
      return {
        dbTables: [],

        tableLoadingStatus: true,
        connectionStatus: true,
      };
    },

    computed: {
      dbTableStatsApi() {return this.prepareApiUri("/api/database/tables");},
      connectionStatusClass() {
        return this.connectionStatus ? "fa-check-circle" : "fa-times-circle";
      },
    },

    mounted() {
      this.fetchDBTablesStats();
    },

    methods: {
      fetchDBTablesStats() {
        this.showLoading();

        this.$http.get(this.dbTableStatsApi).then(response => {
          const data = response.data.data;

          if (data.hasOwnProperty("connection") && data.connection === false) {
            this.dbTables = [];
            this.connectionStatus = false;
          } else {
            this.connectionStatus = true;
            this.dbTables = response.data.data;
          }

          this.hideLoading();
        });
      },

      refreshDBTable() {
        this.fetchDBTablesStats();
      },

      showLoading() {
        this.tableLoadingStatus = true;
      },
      hideLoading() {
        this.tableLoadingStatus = false;
      },
    },
  };
</script>

<style scoped>
    .table-connection {
        float: left;
        margin: 15px 0;
    }

    .table-connection .fa-check-circle {
        color: #116811;
    }

    .table-connection .fa-times-circle {
        color: #b9160e;
    }

    .table-refresh {
        float: right;
        margin: 15px 0;
        cursor: pointer;
    }

    .table-wrapper {
        position: relative;
    }
</style>
