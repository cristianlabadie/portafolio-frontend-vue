<template>
  <div class="permisos" v-loading="loading">
    <h1>Permisos</h1>

    <el-button type="primary" @click="agregarMenuPrincipal" size="mini">Agregar Menú Principal</el-button>

    <div class="menu" v-for="(menu, index) in permisos">
      <el-form :model="menu" label-position="top">
        <el-form-item>
          <el-row :gutter="10">
            <el-col :span="8">
              <el-input
                v-model="menu.nombre"
                size="mini"
                placeholder="Nombre"
                @change="cambioMenu(index, menu)"
              ></el-input>
            </el-col>
            <el-col :span="6">
              <el-input
                v-model="menu.icono"
                size="mini"
                placeholder="Ícono"
                @change="cambioMenu(index, menu)"
              ></el-input>
            </el-col>
            <el-col :span="8">
              <el-input v-model="menu.ruta" size="mini" placeholder="Ruta" @change="cambioMenu(index, menu)"></el-input>
            </el-col>
            <el-col :span="2" class="text-right">
              <el-button
                type="danger"
                circle
                icon="el-icon-delete"
                size="mini"
                plain
                @click="eliminarMenuPrincipal(index)"
              ></el-button>
            </el-col>
          </el-row>
        </el-form-item>

        <div class="opciones">
          <h4>Opciones</h4>
          <div class="opcion" v-for="(opcion, indexOpcion) in menu.opciones">
            <el-row>
              <el-col :span="22">
                <el-input
                  v-model="opcion.nombre"
                  size="mini"
                  placeholder="Nombre opción"
                  @change="cambioOpcion(index, indexOpcion, opcion)"
                ></el-input>
              </el-col>
              <el-col :span="2" class="text-right">
                <el-button
                  type="danger"
                  circle
                  icon="el-icon-delete"
                  size="mini"
                  plain
                  @click="eliminarOpcion(index, indexOpcion)"
                ></el-button>
              </el-col>
            </el-row>
          </div>
          <el-button type="primary" size="mini" icon="el-icon-plus" @click="agregarOpcion(index)"
            >Agregar Opción</el-button
          >
        </div>

        <div class="submenu">
          <h4>Submenu</h4>
          <div class="item" v-for="(submenu, indexSubmenu) in menu.submenu">
            <el-form-item>
              <el-row :gutter="10">
                <el-col :span="8">
                  <el-input
                    v-model="submenu.nombre"
                    size="mini"
                    placeholder="Nombre"
                    @change="cambioSubmenu(index, indexSubmenu, submenu)"
                  ></el-input>
                </el-col>
                <el-col :span="6">
                  <el-input
                    v-model="submenu.icono"
                    size="mini"
                    placeholder="Ícono"
                    @change="cambioSubmenu(index, indexSubmenu, submenu)"
                  ></el-input>
                </el-col>
                <el-col :span="8">
                  <el-input
                    v-model="submenu.ruta"
                    size="mini"
                    placeholder="Ruta"
                    @change="cambioSubmenu(index, indexSubmenu, submenu)"
                  ></el-input>
                </el-col>
                <el-col :span="2" class="text-right">
                  <el-button
                    type="danger"
                    circle
                    icon="el-icon-delete"
                    size="mini"
                    plain
                    @click="eliminarSubmenu(index, indexSubmenu)"
                  ></el-button>
                </el-col>
              </el-row>
            </el-form-item>

            <div class="opciones_submenu">
              <h4>Opciones Submenu</h4>
              <div class="opcion_submenu" v-for="(opcionSubmenu, indexOpcionSubmenu) in submenu.opciones">
                <el-row>
                  <el-col :span="22">
                    <el-input
                      v-model="opcionSubmenu.nombre"
                      size="mini"
                      placeholder="Nombre opción"
                      @change="cambioOpcionSubmenu(index, indexSubmenu, indexOpcionSubmenu, opcionSubmenu)"
                    ></el-input>
                  </el-col>
                  <el-col :span="2" class="text-right">
                    <el-button
                      type="danger"
                      circle
                      icon="el-icon-delete"
                      size="mini"
                      plain
                      @click="eliminarSubmenuOpcion(index, indexSubmenu, indexOpcionSubmenu)"
                    ></el-button>
                  </el-col>
                </el-row>
              </div>
              <el-button
                class="b_agregar_opcion_submenu"
                type="primary"
                size="mini"
                icon="el-icon-plus"
                @click="agregarOpcionSubmenu(index, indexSubmenu)"
                >Agregar Opción Submenu</el-button
              >
            </div>
          </div>
          <el-button
            class="b_agregar_submenu"
            type="primary"
            size="mini"
            icon="el-icon-plus"
            @click="agregarSubmenu(index)"
            >Agregar Submenu</el-button
          >
        </div>
      </el-form>
    </div>
  </div>
</template>

<script>
export default {
  props: [],
  data() {
    return {
      loading: false,
      permisos: []
    }
  },
  created() {
    this.getPermisos()
  },
  methods: {
    getPermisos() {
      this.loading = true
      axios.post("/getPermisos").then(response => {
        if (response.data.estado == "ok") {
          this.permisos = response.data.permisos
          this.loading = false
        } else {
          this.$alert(response.data.errores.join(', '))
        }
      })
    },
    cambioMenu(index, menu) {
      this.postCambio("/cambioMenu", { index, menu })
    },
    cambioOpcion(index, indexOpcion, opcion) {
      this.postCambio("/cambioOpcion", { index, indexOpcion, opcion })
    },
    agregarOpcion(index) {
      this.postCambio("/agregarOpcion", { index })
    },
    agregarSubmenu(index) {
      this.postCambio("/agregarSubmenu", { index })
    },
    agregarOpcionSubmenu(index, indexSubmenu) {
      this.postCambio("/agregarOpcionSubmenu", { index, indexSubmenu })
    },
    eliminarSubmenu(index, indexSubmenu) {
      this.$confirm("¿Seguro que quieres eliminar este submenu?", "¡Atención!", {
        confirmButtonText: "OK",
        cancelButtonText: "Cancel",
        type: "warning"
      })
        .then(() => {
          this.postCambio("/eliminarSubmenu", { index, indexSubmenu })
        })
        .catch()
    },
    eliminarOpcion(index, indexOpcion) {
      this.$confirm("¿Seguro que quieres eliminar esta opción?", "¡Atención!", {
        confirmButtonText: "OK",
        cancelButtonText: "Cancel",
        type: "warning"
      })
        .then(() => {
          this.postCambio("/eliminarOpcion", { index, indexOpcion })
        })
        .catch()
    },
    eliminarSubmenuOpcion(index, indexSubmenu, indexOpcionSubmenu) {
      this.$confirm("¿Seguro que quieres eliminar esta opción?", "¡Atención!", {
        confirmButtonText: "OK",
        cancelButtonText: "Cancel",
        type: "warning"
      })
        .then(() => {
          this.postCambio("/eliminarSubmenuOpcion", { index, indexSubmenu, indexOpcionSubmenu })
        })
        .catch()
    },
    cambioSubmenu(index, indexSubmenu, submenu) {
      this.postCambio("/cambioSubmenu", { index, indexSubmenu, submenu })
    },
    cambioOpcionSubmenu(index, indexSubmenu, indexOpcionSubmenu, opcionSubmenu) {
      this.postCambio("/cambioOpcionSubmenu", { index, indexSubmenu, indexOpcionSubmenu, opcionSubmenu })
    },
    postCambio(ruta, datos) {
      this.loading = true
      axios.post(ruta, datos).then(response => {
        if (response.data.estado == "ok") {
          this.getPermisos()
        } else {
          this.$alert(response.data.errores)
        }
      })
    },
    agregarMenuPrincipal() {
      this.postCambio("/agregarMenuPrincipal", {})
    },
    eliminarMenuPrincipal(index) {
      this.$confirm("¿Seguro que quieres eliminar este menú principal?", "¡Atención!", {
        confirmButtonText: "OK",
        cancelButtonText: "Cancel",
        type: "warning"
      })
        .then(() => {
          this.postCambio("/eliminarMenuPrincipal", { index })
        })
        .catch()
    }
  }
}
</script>

<style scoped lang="scss">
@import "~vars";

.menu {
  margin-top: 40px;
  padding-top: 10px;
  margin-bottom: 40px;
  padding-bottom: 10px;
  border-top: 1px solid #ccc;
}

.opcion {
  margin-bottom: 5px;
}

.opciones {
  padding-left: 50px;
}

.opciones_submenu {
  padding-left: 50px;
}

.submenu {
  padding-left: 50px;
}

.b_agregar_submenu {
  margin-top: 20px;
}

.b_agregar_opcion_submenu {
  margin-top: 20px;
}
</style>
