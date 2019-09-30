<template>
  <div class="usuarios" v-loading="loading">
    <h1>Usuarios</h1>

    <el-table :data="usuarios">
      <el-table-column label="ID" prop="id" width="100px" align="center"></el-table-column>
      <el-table-column label="Nombre" prop="nombre_completo"></el-table-column>
      <el-table-column width="100px" align="right">
        <template slot-scope="scope">
          <el-button type="text" icon="el-icon-edit" @click="editarUsuario(scope.row)"></el-button>
        </template>
      </el-table-column>
    </el-table>

    <el-dialog
      :title="user.nombre_completo"
      :visible.sync="editar"
      :before-close="handleClose"
      top="10px"
      append-to-body
    >
      <h2>Permisos</h2>

      <div class="permiso" v-for="permiso in user.permisos" :key="permiso.id">
        <div class="menu" :class="{ desactivado: !permiso.visible }">
          <div class="nombre">{{ permiso.nombre }}</div>
          <div class="switch">
            <el-switch v-model="permiso.visible" @change="cambioPermiso(permiso)"></el-switch>
          </div>
        </div>
        <div
          class="opcion"
          :class="{ desactivado: !opcion.visible }"
          v-for="opcion in permiso.opciones"
          :key="opcion.id"
        >
          <div class="nombre">{{ opcion.nombre }}</div>
          <div class="switch">
            <el-switch v-model="opcion.visible" @change="guardarCambiosPermisos"></el-switch>
          </div>
        </div>
        <div class="submenu" v-for="submenu in permiso.submenu" :key="submenu.id">
          <div class="nombre_submenu" :class="{ desactivado: !submenu.visible }">
            <div class="nombre">{{ submenu.nombre }}</div>
            <div class="switch">
              <el-switch v-model="submenu.visible" @change="cambioSubmenu(submenu)"></el-switch>
            </div>
          </div>
          <div
            class="opcion_submenu"
            :class="{ desactivado: !opcion_submenu.visible }"
            v-for="opcion_submenu in submenu.opciones"
            :key="opcion_submenu.id"
          >
            <div class="nombre">{{ opcion_submenu.nombre }}</div>
            <div class="switch">
              <el-switch v-model="opcion_submenu.visible" @change="guardarCambiosPermisos"></el-switch>
            </div>
          </div>
        </div>
      </div>

      <span slot="footer" class="dialog-footer">
        <el-button @click="editar = false">Cerrar</el-button>
      </span>
    </el-dialog>
  </div>
</template>

<script>
export default {
  name: "Usuarios",
  props: [],
  data() {
    return {
      permisos: [],
      loading: false,
      usuarios: [],
      editar: false,
      user: {}
    }
  },
  created() {
    this.permisos = _.find(this.$store.state.user.permisos, function(o) {
      return o.nombre == "Usuarios"
    })

    if (!this.permisos.visible) {
      this.$router.push("/")
    }

    this.getUsers()
  },
  methods: {
    getUsers(id) {
      this.loading = true
      axios
        .post("/getUsersAdmin", {
          id: id
        })
        .then(response => {
          if (response.data.estado == "ok") {
            this.usuarios = response.data.users
          } else {
            this.$alert(response.data.errores)
          }
          this.loading = false
        })
        .catch(response => {
          console.log(response)
        })
    },
    editarUsuario(user) {
      this.user = user
      this.editar = true
    },
    handleClose(done) {
      done()
    },
    cambioPermiso(permiso) {
      var vm = this
      if (permiso.visible == false) {
        _.each(permiso.opciones, function(opcion) {
          opcion.visible = false
        })
        _.each(permiso.submenu, function(submenu) {
          vm.desactivarSubmenu(submenu)
        })
      }
      this.guardarCambiosPermisos()
    },
    cambioSubmenu(submenu) {
      if (submenu.visible == false) {
        this.desactivarSubmenu(submenu)
      }
      this.guardarCambiosPermisos()
    },
    desactivarSubmenu(submenu) {
      submenu.visible = false
      _.each(submenu.opciones, function(opcionSubmenu) {
        opcionSubmenu.visible = false
      })
    },
    guardarCambiosPermisos() {
      axios
        .post("/guardarCambiosPermisos", {
          user: this.user
        })
        .then(response => {
          if (response.data.estado == "ok") {
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
.usuarios {
  min-height: 300px;
}

.permiso {
  margin-bottom: 10px;
}

.menu {
  display: flex;
  justify-content: space-between;
}

.opcion {
  padding-left: 20px;
  display: flex;
  justify-content: space-between;
}

.nombre_submenu {
  padding-left: 20px;
  display: flex;
  justify-content: space-between;
}

.opcion_submenu {
  padding-left: 40px;
  display: flex;
  justify-content: space-between;
}

.desactivado {
  color: #ccc;
}
</style>
