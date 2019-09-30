<template>
  <div class="clasificaciones_gastos">
    <el-row>
      <el-col :span="24">
        <h1>Clasificaciones Gastos</h1>
      </el-col>

      <div class="botones">
        <el-button type="primary" icon="el-icon-plus" @click="append(true, null)" size="small">Nueva Clasificación Base</el-button>
      </div>


      <el-row>
        <el-col :span="24">
          <el-tree
            :data="$store.state.clasificacionesGastos"
            node-key="id"
            :props="defaultProps"
            :expand-on-click-node="false">
            <span class="custom-tree-node" slot-scope="{ node, data }">
              <input class="campo" type="text" v-model="data.nombre" @blur="cambioNombre(data)"/>

              <span>
                <el-button
                  type="text"
                  size="mini"
                  @click="() => append(false, data)"
                  icon="el-icon-plus">
                </el-button>

                <el-button
                  type="text"
                  size="mini"
                  :disabled="Boolean(data.hijos.length)"
                  @click="() => remove(node, data)"
                  icon="el-icon-delete">
                </el-button>
              </span>
            </span>
          </el-tree>
        </el-col>
      </el-row>
    </el-row>
  </div>
</template>

<script>

export default {
	props: [],
	data(){
		return {
      defaultProps: {
        children: 'hijos'
      },
		}
	},
	created(){},
	methods: {
    append(base = false, data) {
      axios.post('/nuevaClasificacionGasto', {
        id: (data ? data.id : null)
      }).then((response) => {
        if(response.data.estado == 'ok'){
          if(data){
            data.hijos.push(response.data.clasificacion);
          }else{
            this.$store.commit('agregarClasificacionGasto', response.data.clasificacion);
          }
        }else{
          this.$alert(response.data.errores);
        }
      }).catch((response) => {
        console.log(response);
      })

    },
    remove(node, data) {
      axios.post('/eliminarClasificacionGasto', {
        id: data.id
      }).then((response) => {
        if(response.data.estado == 'ok'){
          const parent = node.parent;
          const hijos = parent.data.hijos || parent.data;
          const index = hijos.findIndex(d => d.id === data.id);
          hijos.splice(index, 1);
        }else{
          this.$alert(response.data.errores);
        }
      }).catch((response) => {
        console.log(response);
      })
    },
    cambioNombre(node){
      axios.post('/cambioNombreClasificacionGasto', {
        node: node
      }).then((response) => {
        if(response.data.estado == 'ok'){

        }else{
          this.$alert(response.data.errores);
        }
      }).catch((response) => {
        console.log(response);
      })
    }
  }
}
</script>

<style scoped lang="scss">
@import '~vars';

  .custom-tree-node {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 14px;
    padding-right: 8px;
  }

  .botones{
    margin-top: 20px;
    margin-bottom: 20px;
    text-align: right;
  }

  .campo{
    border: none;
    width: 300px;

    &:focus{
      outline: none;
    }
  }

</style>
