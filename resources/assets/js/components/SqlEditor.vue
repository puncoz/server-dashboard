<template>
    <div>
        <textarea id="code-mirror-sql-editor" class="form-control" cols="30" rows="10" v-text="query"></textarea>
    </div>
</template>

<script type="text/ecmascript-6">
  const CodeMirror = require("codemirror/lib/codemirror");

  require("codemirror/lib/codemirror.css");
  require("codemirror/mode/sql/sql");
  require("codemirror/addon/hint/show-hint.css");
  require("codemirror/addon/hint/show-hint");
  require("codemirror/addon/hint/sql-hint");

  export default {
    name: "SqlEditor",

    props: ["query"],

    data() {
      return {
        configs: {
          sqlEditor: {
            lineNumbers: true,
            smartIndent: true,
            indentWithTabs: true,
            extraKeys: {"Ctrl-Space": "autocomplete"},
            mode: "text/x-pgsql",
            matchBrackets: true,
            autofocus: true,
          },
        },

        codeMirror: {},
      };
    },

    mounted() {
      this.codeMirror = CodeMirror.fromTextArea(
          document.getElementById("code-mirror-sql-editor"), this.configs.sqlEditor,
      ).on("change", (changeObj) => {
        this.$emit("input", changeObj.getValue());
      });
    },
  };
</script>

<style scoped>

</style>
