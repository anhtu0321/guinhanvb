<template>
	<div>
		<header-component></header-component>
		<banner-component></banner-component>
		<guinhan-component></guinhan-component>
		<footer-component></footer-component>
	</div>
</template>

<script>
import headerComponent from './components/header.vue';
import bannerComponent from './components/banner.vue';
import guinhanComponent from './components/guinhancontent.vue';
import footerComponent from './components/footer.vue';
export default {
	components:{
		headerComponent,
		bannerComponent,
		guinhanComponent,
		footerComponent,
	},
	methods:{
		checklogin(){
			axios.get('/guinhanvb/checksession')
			.then(e=>{
	
			})
			.catch(e=>{
				this.$router.push('/');
			});
		},
	},
	created(){
		this.checklogin();
	}
}
</script>


