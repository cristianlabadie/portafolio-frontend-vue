<template>
  <div class="home">

  </div>
</template>

<script>

export default {
  name: "Home",
  components: {},
  props: [],
  data() {
    return {
      permisos: {}
    }
  },
  beforeCreate() {},
  created() {
    this.setPermisos()
  },
  beforeMount() {},
  mounted() {},
  beforeUpdate() {},
  updated() {},
  beforeDestroy() {},
  destroyed() {},
  methods: {
    setPermisos() {
      var vm = this
      _.each(this.$store.state.user.permisos[0].opciones, function(o) {
        vm.$set(vm.permisos, o.nombre, o.visible)
      })
    }
  }
}
</script>

<style scoped lang="scss">
@import "~vars";
#grafico {
  margin-top: 20px;
}

.total_pendientes {
  font-size: 3em;
  text-align: center;
}
</style>
