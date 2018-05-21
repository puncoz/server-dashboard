<template>
    <aside id="mainSidebar">
        <ul class="nav flex-column">
            <router-link tag="li"
                         to="/dashboard"
                         active-class="active"
                         class="nav-item">
                <a class="nav-link"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            </router-link>

            <router-link tag="li"
                         to="/database"
                         active-class="active"
                         class="nav-item">
                <a class="nav-link"><i class="fas fa-database"></i> Database</a>
            </router-link>

            <router-link tag="li"
                         to="/sql"
                         active-class="active"
                         class="nav-item">
                <a class="nav-link"><i class="fas fa-code"></i> Sql Editor</a>
            </router-link>
        </ul>
    </aside>
</template>

<script type="text/ecmascript-6">
  export default {
    name: "MainSidebar",
  };
</script>

<style scoped>

</style>
