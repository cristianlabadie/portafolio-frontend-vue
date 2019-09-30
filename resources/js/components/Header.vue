<template>
	<header>
		<el-menu mode="horizontal" background-color="#eee" text-color="#333" active-text-color="#ffd04b">
			<el-menu-item class="header-navicon" index="1"  @click="openSidebar">
				<el-button type="text">
					<i class="el-icon-menu"></i>
				</el-button>
			</el-menu-item>
			<!-- <span class="header-title">{{title}}</span> -->
			<el-submenu class="header-menu" index="2">
				<template slot="title">{{$store.state.user.name}}</template>
				<el-menu-item index="2-1" @click="salir">Cerrar Sesión</el-menu-item>
			</el-submenu>
		</el-menu>
	</header>
</template>

<script>
export default {
	name: 'Header',
	props: ['openSidebar', 'title'],
	data(){
		return {
		}
	},
	beforeCreate(){},
	created(){},
	beforeMount(){},
	mounted(){},
	beforeUpdate(){},
	updated(){},
	beforeDestroy(){},
	destroyed(){},
	methods: {
		salir(){
			window.location.href = "/logout";
			
		}
	}
}
</script>

<style scoped lang="scss">
@import "~vars";

header {
	z-index: 6;
	background: #fff;
	border-bottom: 1px solid $grey;
	color: #2e3d49;
	position: fixed;
	transform-style: preserve-3d;
	will-change: transform;
	transition-duration: .2s;
	transition-timing-function: cubic-bezier(.4,0,.2,1);
	transition-property: transform;
	width: 100%;
	height: $header-height;

	@include respond-to('sm', 'xs') {
		transform: translate3d(0, 0, 0)!important;
	}

	@include respond-to('lg') {
		width: calc(100% - #{$sidebar-size});
		transform: translate3d($sidebar-size, 0, 0)!important;
	}

	.el-menu {
		border-radius: 0;
	}

	&.no_sidebar {
		transform: translate3d(0, 0, 0)!important;
		width: 100%;
	}

	.header-navicon {
		display: flex;
		align-items: center;
		align-content: center;
		@include respond-to('lg') {
			display: none;
		}
		i {
			color: #333 !important;
			font-size: 2rem!important;
		}
	}
	.header-menu {
		float: right!important;
	}

	.header-title {
		font-size: 24px;
		color: $white;
		margin-left: 0;
		line-height: 60px;
		@include respond-to('lg') {
			margin-left: 24px;
		}
	}
}

</style>
