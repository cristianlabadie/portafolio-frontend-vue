<template>
</template>

<script>
export default {
	props: [],
	data(){
		return {},
		permisos:
		[{"id": 1, "ruta": "/", "icono": "el-icon-school", "nombre": "Home", "submenu": [], "visible": true, "opciones": [{"id": "o-1", "nombre": "grafico_resumen_pedidos", "visible": true},
		{"id": "o-2", "nombre": "grafico_resumen_registros", "visible": true},
		{"id": "o-3", "nombre": "grafico_resumen_formas_de_pago", "visible": true},
		{"id": "o-4", "nombre": "resumen_pendientes", "visible": true}]},
		{"id": 2, "ruta": "/rutas", "icono": "el-icon-truck", "nombre": "Rutas", "submenu": [], "visible": true, "opciones": []},
		{"id": 3, "ruta": "/pedidosOld", "icono": "el-icon-shopping-cart-full", "nombre": "Pedidos", "submenu": [{"id": "s-1", "ruta": "/pedidosOld", "icono": "el-icon-view", "nombre": "Ver Pedidos", "visible": true, "opciones": []},
		{"id": "s-2", "ruta": "/pedidos/etiquetas", "icono": "el-icon-printer", "nombre": "Etiquetas", "visible": true, "opciones": []},
		{"id": "s-3", "ruta": "/pedidos/listados", "icono": "el-icon-document-copy", "nombre": "Listados", "visible": true, "opciones": []}], "visible": true, "opciones": [{"id": "o-1", "nombre": "crear_despachos", "visible": true},
		{"id": "o-2", "nombre": "opciones_pedido", "visible": true}]},
		{"id": 4, "ruta": "/productos", "icono": "el-icon-apple", "nombre": "Productos", "submenu": [{"id": "s-1", "ruta": "/productos", "icono": "el-icon-view", "nombre": "Ver Productos", "visible": true, "opciones": [{"id": "o-1", "nombre": "reset_stock_temporal", "visible": true},
		{"id": "o-2", "nombre": "exportar_datos", "visible": true},
		{"id": "o-3", "nombre": "nuevo_producto", "visible": true}]},
		 {"id": "s-2", "ruta": "/productos/actualizaciones_stock", "icono": "el-icon-refresh", "nombre": "Actualizaciones Stock", "visible": true, "opciones": [{"id": "s-1-1", "nombre": "nueva_actualizacion", "visible": true}]}], "visible": true, "opciones": []},
		 {"id": 5, "ruta": "/clientes", "icono": "el-icon-user", "nombre": "Clientes", "submenu": [], "visible": true, "opciones": []},
		 {"id": 6, "ruta": "/compras", "icono": "el-icon-goods", "nombre": "Compras", "submenu": [{"id": "s-1", "ruta": "/compras/listados-compras", "icono": "el-icon-notebook-2", "nombre": "Listados Compras", "visible": true, "opciones": []},
		 {"id": "s-2", "ruta": "/compras/registro-compras-diario", "icono": "el-icon-edit-outline", "nombre": "Registro Compras Diario", "visible": true, "opciones": []},
		 {"id": "s-3", "ruta": "/compras/registro-gastos-diario", "icono": "el-icon-edit-outline", "nombre": "Registro Gastos Diario", "visible": true, "opciones": []},
		 {"id": "s-4", "ruta": "/compras/registro-giros-diario", "icono": "el-icon-edit-outline", "nombre": "Registro Giros Diario", "visible": true, "opciones": []},
		 {"id": "s-5", "ruta": "/compras/resumen", "icono": "el-icon-document-checked", "nombre": "Resumen", "visible": true, "opciones": []}], "visible": true},
		 {"id": 7, "ruta": "/codigos", "icono": "el-icon-discount", "nombre": "Códigos de Descuento", "submenu": [], "visible": true, "opciones": []},
		  {"id": 8, "ruta": "/cotizaciones", "icono": "el-icon-document", "nombre": "Cotizador", "submenu": [], "visible": true, "opciones": []},
		 {"id": 9, "ruta": "/web", "icono": "el-icon-mouse", "nombre": "Web", "submenu": [{"id": "s-1", "ruta": "/web/banners", "icono": "el-icon-monitor", "nombre": "Banners", "visible": true, "opciones": []},
		 {"id": "s-2", "ruta": "/web/lateralhome", "icono": "el-icon-monitor", "nombre": "Lateral Home", "visible": true, "opciones": []}], "visible": true, "opciones": []},
		 {"id": 10, "ruta": "/configuraciones", "icono": "el-icon-setting", "nombre": "Configuraciones", "submenu": [{"id": "s-1", "ruta": "/configuraciones/categorias", "icono": "el-icon-guide", "nombre": "Categorías", "visible": true, "opciones": []},
		 {"id": "s-2", "ruta": "/configuraciones/dias-despacho", "icono": "el-icon-date", "nombre": "Días de Despacho", "visible": true, "opciones": []},
		 {"id": "s-3", "ruta": "/configuraciones/clasificaciones-gastos", "icono": "el-icon-s-operation", "nombre": "Clasificaciones Gastos", "visible": true, "opciones": []},
		 {"id": "s-4", "ruta": "/configuraciones/permisos", "icono": "el-icon-finished", "nombre": "Permisos", "visible": true, "opciones": []},
		 {"id": "s-5", "ruta": "/configuraciones/feriados", "icono": "el-icon-date", "nombre": "Feriados", "visible": true, "opciones": []}], "visible": true, "opciones": []},
		 {"id": 11, "ruta": "/usuarios", "icono": "el-icon-basketball", "nombre": "Usuarios", "submenu": [], "visible": true, "opciones": []},
		 {"id": 12, "ruta": "/reportar-problema", "icono": "el-icon-help", "nombre": "Reportar Problema Admin", "submenu": [], "visible": true, "opciones": []}],


		 permisos2:
		 [{"id":1,"ruta":"\/","icono":"el-icon-school","nombre":"Home","submenu":[],"visible":true,"opciones":[]},{"id":4,"ruta":"\/productos","icono":"el-icon-apple","nombre":"Productos","submenu":[{"id":"s-1","ruta":"\/productos","icono":"el-icon-view","nombre":"Ver Productos","visible":true,"opciones":[{"id":"o-1","nombre":"reset_stock_temporal","visible":true},{"id":"o-2","nombre":"exportar_datos","visible":true},{"id":"o-3","nombre":"nuevo_producto","visible":true}]},{"id":"s-2","ruta":"\/productos\/actualizaciones_stock","icono":"el-icon-refresh","nombre":"Actualizaciones Stock","visible":true,"opciones":[{"id":"s-1-1","nombre":"nueva_actualizacion","visible":true}]}],"visible":true,"opciones":[]},{"id":9,"ruta":"\/web","icono":"el-icon-mouse","nombre":"Web","submenu":[{"id":"s-1","ruta":"\/web\/banners","icono":"el-icon-monitor","nombre":"Banners","visible":true,"opciones":[]},{"id":"s-2","ruta":"\/web\/lateralhome","icono":"el-icon-monitor","nombre":"Lateral Home","visible":true,"opciones":[]}],"visible":true,"opciones":[]},{"id":10,"ruta":"\/configuraciones","icono":"el-icon-setting","nombre":"Configuraciones","submenu":[{"id":"s-1","ruta":"\/configuraciones\/categorias","icono":"el-icon-guide","nombre":"Categor\u00edas","visible":true,"opciones":[]},{"id":"s-2","ruta":"\/configuraciones\/dias-despacho","icono":"el-icon-date","nombre":"D\u00edas de Despacho","visible":true,"opciones":[]},{"id":"s-3","ruta":"\/configuraciones\/clasificaciones-gastos","icono":"el-icon-s-operation","nombre":"Clasificaciones Gastos","visible":true,"opciones":[]},{"id":"s-4","ruta":"\/configuraciones\/permisos","icono":"el-icon-finished","nombre":"Permisos","visible":true,"opciones":[]},{"id":"s-5","ruta":"\/configuraciones\/feriados","icono":"el-icon-date","nombre":"Feriados","visible":true,"opciones":[]}],"visible":true,"opciones":[]},{"id":11,"ruta":"\/usuarios","icono":"el-icon-basketball","nombre":"Usuarios","submenu":[],"visible":true,"opciones":[]},{"id":12,"ruta":"\/profesionales","icono":"el-icon-s-custom","nombre":"Profesionales","submenu":[{"id":"s-1","ruta":"\/profesionales\/agregar","icono":"el-icon-plus","opciones":[],"nombre":"Agregar profesional","visible":false},{"id":"s-2","ruta":"\/profesionales\/editar","icono":"el-icon-edit","opciones":[],"nombre":"Modificar profesional","visible":false},{"id":"s-3","ruta":"\/profesionales\/eliminar","icono":"el-icon-delete","opciones":[],"nombre":"Eliminar profesional","visible":false},{"id":"s-4","ruta":"\/profesionales\/listar","icono":"el-icon-tickets","opciones":[],"nombre":"Listar profesionales","visible":false}],"visible":true,"opciones":[{"id":"s-0-1","nombre":"","visible":false},{"id":"s-1-1","nombre":"","visible":false}]},{"id":11,"ruta":"","icono":"","nombre":"","submenu":[],"visible":false,"opciones":[]}],


		 permisos3: [{"id":1,"ruta":"\/","icono":"el-icon-school","nombre":"Home","submenu":[],"visible":true,"opciones":[]},
		 {"id":9,"ruta":"\/web","icono":"el-icon-mouse","nombre":"Web","submenu":[{"id":"s-1","ruta":"\/web\/banners","icono":"el-icon-monitor","nombre":"Banners","visible":true,"opciones":[]},{"id":"s-2","ruta":"\/web\/lateralhome","icono":"el-icon-monitor","nombre":"Lateral Home","visible":true,"opciones":[]}],"visible":true,"opciones":[]},{"id":10,"ruta":"\/configuraciones","icono":"el-icon-setting","nombre":"Configuraciones","submenu":[{"id":"s-1","ruta":"\/configuraciones\/categorias","icono":"el-icon-guide","nombre":"Categor\u00edas","visible":true,"opciones":[]},{"id":"s-2","ruta":"\/configuraciones\/dias-despacho","icono":"el-icon-date","nombre":"D\u00edas de Despacho","visible":true,"opciones":[]},{"id":"s-3","ruta":"\/configuraciones\/clasificaciones-gastos","icono":"el-icon-s-operation","nombre":"Clasificaciones Gastos","visible":true,"opciones":[]},{"id":"s-4","ruta":"\/configuraciones\/permisos","icono":"el-icon-finished","nombre":"Permisos","visible":true,"opciones":[]},{"id":"s-5","ruta":"\/configuraciones\/feriados","icono":"el-icon-date","nombre":"Feriados","visible":true,"opciones":[]}],"visible":true,"opciones":[]},{"id":11,"ruta":"\/usuarios","icono":"el-icon-basketball","nombre":"Usuarios","submenu":[],"visible":true,"opciones":[]},{"id":12,"ruta":"\/profesionales","icono":"el-icon-s-custom","nombre":"Profesionales","submenu":[{"id":"s-1","ruta":"\/profesionales\/agregar","icono":"el-icon-plus","opciones":[],"nombre":"Agregar profesional","visible":false},{"id":"s-2","ruta":"\/profesionales\/editar","icono":"el-icon-edit","opciones":[],"nombre":"Modificar profesional","visible":false},{"id":"s-3","ruta":"\/profesionales\/eliminar","icono":"el-icon-delete","opciones":[],"nombre":"Eliminar profesional","visible":false},{"id":"s-4","ruta":"\/profesionales\/listar","icono":"el-icon-tickets","opciones":[],"nombre":"Listar profesionales","visible":false}],"visible":true,"opciones":[{"id":"s-0-1","nombre":"","visible":false},{"id":"s-1-1","nombre":"","visible":false}]},{"id":11,"ruta":"","icono":"","nombre":"","submenu":[],"visible":false,"opciones":[]}]
	},
	beforeCreate(){},
	created(){},
	beforeMount(){},
	mounted(){},
	beforeUpdate(){},
	updated(){},
	beforeDestroy(){},
	destroyed(){},
	methods: {}
}
</script>

<style scoped lang="scss">
</style>
