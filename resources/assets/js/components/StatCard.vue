<template>
    <div class="tile_stats_count">
        <span class="count-top"><i :class="icon"></i> {{ title }}</span>
        <span class="count">{{ value }}</span>
        <span class="count-bottom" v-if="subTitle">{{ subTitle }}</span>
    </div>
</template>

<script type="text/ecmascript-6">
  export default {
    name: "StatCard",

    props: {
      title: {required: true, type: String},
      value: {required: true},
      subTitle: {required: false},
      icon: {required: false, type: String},
    },
  };
</script>

<style scoped>

</style>
