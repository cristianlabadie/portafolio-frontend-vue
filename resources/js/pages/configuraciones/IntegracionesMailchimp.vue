<template>
  <div class="">
    <el-row :gutter="20">
      <el-col :span="12">
        <h2>Integración Mailchimp</h2>
      </el-col>
      <el-col :span="12" align="right"> </el-col>
    </el-row>

    <el-row>
      <el-col :span="24">
        <h3>Herramientas</h3>
      </el-col>

      <el-col :span="12">
        <h4>Eliminar Productos</h4>
        <p>
          Se eliminar todos los productos del catálogo de Mailchimp.
        </p>
        <el-button type="primary" @click="eliminarProductos" :loading="loading.eliminarProductos"
          >Eliminar Productos</el-button
        >
      </el-col>

      <el-col :span="12">
        <h4>Cargar Productos</h4>
        <p>
          Se cargar todos los productos de la base de datos al catálogo de Mailchimp.
        </p>
        <el-button type="primary" @click="cargarProductos" :loading="loading.cargarProductos"
          >Cargar Productos</el-button
        >
      </el-col>
    </el-row>

    <el-row>
      <el-col :span="24">
        <h3>Configuraciones</h3>
      </el-col>
    </el-row>
  </div>
</template>

<script>
export default {
  name: "IntegracionesMailchimp",
  components: {},
  props: [],
  data() {
    return {
      loading: {
        eliminarProductos: false,
        cargarProductos: false
      }
    }
  },
  created() {},
  methods: {
    eliminarProductos() {
      this.loading.eliminarProductos = true
      axios
        .post("/integraciones/mailchimp/eliminarProductos")
        .then(response => {
          if (response.data.estado == "ok") {
            this.$message({
              message: "El trabajo se está ejecutando en el servidor.",
              type: "success"
            })
          } else {
            this.$alert(response.data.errores)
          }
          this.loading.eliminarProductos = false
        })
        .catch(response => {
          console.log(response)
        })
    },
    cargarProductos() {
      this.loading.cargarProductos = true
      axios
        .post("/integraciones/mailchimp/cargarProductos")
        .then(response => {
          if (response.data.estado == "ok") {
            this.$message({
              message: "El trabajo se está ejecutando en el servidor.",
              type: "success"
            })
          } else {
            this.$alert(response.data.errores)
          }
          this.loading.cargarProductos = false
        })
        .catch(response => {
          console.log(response)
        })
    }
  }
}
</script>

<style scoped lang="scss">
@import "~vars";
</style>
