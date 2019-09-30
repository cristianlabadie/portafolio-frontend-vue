<template>
  <div class="super-contenedor">
    <div class="page-layout">
      <Sidebar />

      <div class="page-layout-inner">
        <Header :openSidebar="openSidebar" />

        <main>
          <!-- <div class="breadcrumb">
            <el-breadcrumb separator-class="el-icon-arrow-right">
              <el-breadcrumb-item :to="{ path: '/' }">Home</el-breadcrumb-item>
              <el-breadcrumb-item>promotion management</el-breadcrumb-item>
              <el-breadcrumb-item>promotion list</el-breadcrumb-item>
              <el-breadcrumb-item>promotion detail</el-breadcrumb-item>
            </el-breadcrumb>
          </div> -->
          <div class="main-content">
            <router-view></router-view>
          </div>
        </main>
      </div>

      <div class="dimmer" :class="{ active: $store.state.sidebarOpened }" @click="closeSidebar"></div>
    </div>
  </div>
</template>

<script>
import Sidebar from "./Sidebar"
import Header from "./Header"
export default {
  name: "App",
  props: {
    user: {
      type: Object
    }
  },
  components: {
    Sidebar,
    Header
  },
  data() {
    return {}
  },
  created() {
    this.$store.commit("establecerUser", this.user)
  },
  mounted() {},
  methods: {
    openSidebar() {
      this.$store.commit("openSidebar")
    },
    closeSidebar() {
      this.$store.commit("closeSidebar")
    },
    handleResize() {
      this.$store.commit("windowResize")
    }
  },
  computed: {
    obfuscatorActive() {
      this.$store.state.obfuscatorActive
    }
  }
}
</script>

<style lang="scss">
@import "~vars";

body {
  font-family: "Nunito", sans-serif;
}

div {
  box-sizing: border-box;
}

.super-contenedor {
  color: #333;
  width: 100%;
  height: 100%;
  .page-layout {
    position: absolute;
    width: 100%;
    height: 100%;
    main {
      z-index: 1;
      overflow-x: auto;
      padding-top: 60px;
      position: absolute;
      width: 100%;
      @include respond-to("lg") {
        width: calc(100% - #{$sidebar-size}); //
        margin-left: $sidebar-size;
      }
      .main-content {
        width: 100%;
        margin: 0;
        padding: 20px;
        @include respond-to("sm", "xs") {
          margin: 0 auto;
        }
      }
    }
  }
}
.dimmer {
  position: fixed;
  top: 0 !important;
  left: 0 !important;
  text-align: center;
  vertical-align: middle;
  background-color: rgba(0, 0, 0, 0.85);
  opacity: 0;
  line-height: 1;
  animation-fill-mode: both;
  transition: background-color 0.5s linear;
  user-select: none;
  will-change: opacity;
  z-index: 100;
  width: 100%;
  height: 100%;
  display: none;
  &.active {
    display: block !important;
    visibility: visible !important;
    opacity: 1;
  }
}
</style>
