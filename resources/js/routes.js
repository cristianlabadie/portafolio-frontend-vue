// Componentes para Vue Router
import Home from './pages/Home.vue'

//Componentes para Configuraciones
import Configuraciones from "./pages/Configuraciones"
import Permisos from "./pages/configuraciones/Permisos"
import Usuarios from "./pages/configuraciones/Usuarios"

//Ayuda
import ReportarProblemaAdmin from "./pages/ReportarProblemaAdmin"

const routes = [
  { path: '/', name: 'home', component: Home },

  //Configuraciones del admin
  { path: "/configuraciones", name: "configuraciones", component: Configuraciones },
  { path: "/configuraciones/permisos", name: "permisos", component: Permisos },

  { path: "/usuarios", component: Usuarios },
]

export default routes
