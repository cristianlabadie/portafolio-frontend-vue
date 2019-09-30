<template>
  <div id="sidebar" :class="{'open': this.$store.state.sidebarOpened}">
    <el-menu router>
      <div class="logo-container">
        <Logo :bajada="true"/>
      </div>

      <component :is="menu.submenu.length ? 'el-submenu' : 'el-menu-item'" :index="menu.ruta" v-for="menu in $store.state.user.permisos" :key="menu.id" v-if="menu.visible">

        <span v-if="!menu.submenu.length">
          <i :class="menu.icono"></i>
          <span>{{menu.nombre}}</span>
        </span>

        <template slot="title" v-if="menu.submenu.length">
          <i :class="menu.icono"></i>
          <span>{{menu.nombre}}</span>
        </template>
        <el-menu-item :index="submenu.ruta" v-for="submenu in menu.submenu" :key="submenu.id" v-if="menu.submenu.length && submenu.visible">
          <i :class="submenu.icono"></i>
          <span>{{submenu.nombre}}</span>
        </el-menu-item>

      </component>

    </el-menu>
  </div>
</template>

<script>
import Logo from '../components/svg/logo';

export default {
  name: 'Sidebar',
  components: {
    Logo
  },
  props: [],
  data(){
    return {
    }
  },
  created(){
  },
  methods: {

  }
}
</script>

<style scoped lang="scss">
@import "~vars";

#sidebar {
  z-index: 5;
  width: $sidebar-size;
  //border-right: 1px solid $grey;
  box-shadow: inset 0 0 0 0 $grey,0 2px 1px 0 rgba(47,61,73,.05);
  height: 100%;
  visibility: visible!important;
  overflow-x: hidden;
  will-change: transform;
  transition-duration: .2s;
  transition-timing-function: cubic-bezier(.4,0,.2,1);
  transition-property: transform;
  position: fixed;
  &.open {
    z-index: 11111;
    transform: translate3d(0, 0, 0)!important;
  }
  @include respond-to('sm', 'xs') {
    z-index: 1000;
    transform: translate3d(-#{$sidebar-size}, 0, 0)!important;
  }
  @include respond-to('lg') {
    transform: translate3d(0, 0, 0)!important;
  }

  .el-menu {
    height: 100%;
    display: flex;
    flex-direction: column;
  }

  .logo-app {
    padding: 5px;
  }

  .logo-container {
    text-align: center;
    width: 100%;
    height: 67px;
    background-color: #FFF;
    padding-top: 5px;
    svg {
      height: 70px;
    }

  }

}
</style>
