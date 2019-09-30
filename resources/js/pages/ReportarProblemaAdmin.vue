<template>
  <div class="reportar-problema">

    <el-row :gutter="20">
      <el-col :span="12">
        <h2>Reportar Problema Admin</h2>
      </el-col>
      <el-col :span="12" align="right">
      </el-col>
    </el-row>

    <el-row :gutter="20">
      <el-col :span="24">
        <p>Muy pronto prodrás reportar tus problemas aquí. Ojo que solo podrás reportar problemas relacionados con esta aplicación y no tus problemas emocionales.</p>
      </el-col>
    </el-row>

  </div>
</template>

<script>

export default {
  name: 'ReportarProblemaAdmin',
  components: {},
  props: [],
  data(){
    return {}
  },
  created(){},
  methods: {
    setPermisos(){
      var vm = this;
      _.each(this.$store.state.user.permisos[11].opciones, function(o){
        vm.$set(vm.permisos, o.nombre, o.visible);
      })
    },
  }
}
</script>

<style scoped lang="scss">
@import '~vars';


</style>
