<template>
	<div>
		<header-component></header-component>
		<menu-component></menu-component>
		<banner-component></banner-component>
		<content-component></content-component>
		<footer-component></footer-component>
	</div>
</template>

<script>
import headerComponent from './components/header.vue';
import bannerComponent from './components/banner.vue';
import menuComponent from './components/menu.vue';
import contentComponent from './components/content.vue';
import footerComponent from './components/footer.vue';
export default {
	components:{
		headerComponent,
		bannerComponent,
		menuComponent,
		contentComponent,
		footerComponent,
	}
}
</script>
