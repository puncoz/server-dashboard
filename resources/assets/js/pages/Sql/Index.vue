<template>
    <div class="container p-0">
        <div class="card">
            <sql-editor @input="onSqlInput" :query="query"/>
            <button class="btn btn-light btn-flat btn-no-radius" @click="execute">Execute</button>
        </div>
    </div>
</template>

<script type="text/ecmascript-6">
  import SqlEditor from "../../components/SqlEditor";

  export default {
    name: "Sql",

    components: {SqlEditor},

    inject: ["prepareApiUri"],

    data() {
      return {
        query: "",
      };
    },

    computed: {
      sqlQueryExecutionApi() {return this.prepareApiUri("/api/sql/execute");},
    },

    methods: {
      onSqlInput(query) {
        this.query = query;
      },

      execute() {
        this.$http.post(this.sqlQueryExecutionApi, {query: this.query}).then(response => {

        });
      },
    },
  };
</script>

<style scoped>

</style>
