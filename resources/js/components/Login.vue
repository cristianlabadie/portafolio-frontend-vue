<template>
  <div class="contenedor_login">
    <div id="login">
      <div class="logo">
        <Logo :bajada="true"/>
      </div>
      <el-form
        ref="form"
        method="post"
        :model="datos"
        :rules="rules"
        @submit.native.prevent="login"
      >
        <el-form-item prop="email">
          <el-input type="email" v-model="datos.email" name="email" placeholder="Email"></el-input>
        </el-form-item>
        <el-form-item prop="password">
          <el-input
            type="password"
            v-model="datos.password"
            name="password"
            placeholder="Contraseña"
          ></el-input>
        </el-form-item>
        <el-form-item align="right">
          <el-button plain type="primary" icon="el-icon-right" native-type="submit" :loading="loading">Entrar</el-button>
        </el-form-item>
      </el-form>
    </div>
  </div>
</template>

<script>
import Logo from '../components/svg/logo';

export default {
  name: 'Login',
  components: {
    Logo
  },
  props: ['errores'],
  data() {
    return {
      datos: {
        email: null,
        password: null,
      },
      rules: {
        email: [
          {
            require: true,
            type: 'email',
            message: 'Ingresa un email válido.',
            trigger: 'blur',
          },
        ],
        password: [
          {
            require: true,
            message: 'Ingresa un password por favor.',
          },
        ],
      },
      loading: false,
      alerta: {
        texto: 'Hola',
        tipo: 'error',
        mostrar: false,
      },
    };
  },
  beforeCreate() {},
  created() {},
  beforeMount() {},
  mounted() {},
  beforeUpdate() {},
  updated() {},
  beforeDestroy() {},
  destroyed() {},
  methods: {
    login() {
      this.$refs.form.validate((valid)=>{
        if(valid){
          this.loading = true;
          axios
            .post('/entrar', {
              email: this.datos.email,
              password: this.datos.password,
            })
            .then(response => {
              console.log(response.data);
              if (response.data.estado == 'ok') {
                window.location.reload();
              } else {
                this.$message({
                  message: 'Usuario o contraseña incorrectas.',
                  type: 'warning'
                });
              }
              this.loading = false;
            })
            .catch(response => {
              console.log(response);
            });
        }
      })
    },
  },
};
</script>

<style scoped lang="scss">
@import '~vars';

.logo {
  text-align: center;
  margin-top: 20px;
  margin-bottom: 20px;

  svg{
      height: 331px;
  }

}

h1 {
  font-size: 20px;
  text-align: center;
  margin-bottom: 40px;
}

#login {
  padding: 10px;
  margin: 0px auto;
	margin-top: 40px;
}

.errores {
  color: red;
  padding: 10px;
}

/* Small devices (tablets, 768px and up) */
@media (min-width: 768px) {
  #login {
    width: 500px;
    background-color: white;
    padding: 30px;
    box-shadow: 0px 0px 80px -15px black;
  }

  .contenedor_login {
    background-image: './components/svg/fondo.jpg';
    height: 100vh;
    background-size: cover;
    display: flex;
    align-items: center;
  }

}


</style>
