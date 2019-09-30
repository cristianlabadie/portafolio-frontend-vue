<template>
  <div class="">
    <el-row :gutter="20">
      <el-col :span="12">
        <h2>Integraciones</h2>
      </el-col>
      <el-col :span="12" align="right"> </el-col>
    </el-row>

    <el-row>
      <el-col :span="24">
        <el-table :data="integraciones" :loading="loading">
          <el-table-column label="Nombre" prop="nombre"></el-table-column>
          <el-table-column label="Observaciones" prop="observaciones"></el-table-column>
          <el-table-column label="Estado" prop="estado">
            <template slot-scope="scope">
              <el-switch v-model="scope.row.estado"></el-switch>
            </template>
          </el-table-column>
          <el-table-column width="40px">
            <template slot-scope="scope">
              <el-button type="text" icon="el-icon-edit" @click="$router.push(scope.row.url_detalle)"></el-button>
            </template>
          </el-table-column>
        </el-table>
      </el-col>
    </el-row>
  </div>
</template>

<script>
export default {
  name: "Integraciones",
  components: {},
  props: [],
  data() {
    return {
      integraciones: [],
      loading: false
    }
  },
  created() {
    this.getIntegraciones()
  },
  methods: {
    getIntegraciones() {
      this.loading = true
      axios
        .post("/integraciones/getIntegraciones")
        .then(response => {
          if (response.data.estado == "ok") {
            this.integraciones = response.data.integraciones
          } else {
            this.$alert(response.data.errores)
          }
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
