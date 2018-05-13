<template>
    <div class="container">
        <div id="mainHeader" class="pt-4 pb-4">
            <div class="row">
                <div class="col">
                    <h1>Server Dashboard</h1>
                </div>
            </div>
        </div>

        <main class="mt-4 mb-4">
            <div class="row">
                <div class="col-md-2">
                    <main-sidebar/>
                </div>

                <div class="col-md-10">
                    <slot/>
                </div>
            </div>
        </main>

        <footer id="mainFooter" class="pt-4 pb-4 text-center">
            Copyright &copy; puncoz.com | All rights reserved.
        </footer>
    </div>
</template>

<script type="text/ecmascript-6">
  import MainSidebar from "./MainSidebar";

  export default {
    name: "MainLayout",

    components: {MainSidebar},
  };
</script>

<style scoped>

</style>
