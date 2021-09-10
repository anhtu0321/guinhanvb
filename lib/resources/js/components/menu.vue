<template>
	<div id="menu">
		<div class="menu">
			<ul class="navbar">
				<li><a href="#bgd">Ban Giám đốc</a></li>
				<li><a href="#xdll">Khối Xây dựng lực lượng</a></li>
				<li><a href="#kan">Khối An ninh</a></li>
				<li><a href="#kcs">Khối Cảnh sát</a></li>
				<li><a href="#kh">Khối huyện, thị, thành phố</a></li>
			</ul>
		</div>
	</div>
</template>

<script>
export default {
	data(){
		return{
			fix:false,
		}
	},
	methods:{
		
	},
	mounted(){
		document.addEventListener('scroll', function(){
			var menu = document.getElementById('menu');
			if(window.scrollY>150) {menu.classList.add('fix-menu');}
			else{menu.classList.remove('fix-menu');}
			
		});
	}
}
</script>

<style scope>
.fix-menu{
	position:fixed;
	top:0;
	overflow: hidden;
	z-index:99;
}
#menu{
	width:100%;
	background:#f7f8fa;
}
.menu{
	max-width:1390px;
	margin:0 auto;
	padding:0 30px;
}
.menu .navbar{
	width:100%;
	list-style: none;
}
.menu .navbar li{
	height:50px;
	line-height:50px;
}
.menu .navbar li:first-child{
	border-left:none;
}
.menu .navbar li:last-child{
	border-right:none;
}
.navbar li a{
	display: block;
	padding:0 20px;
	font-weight: bold;
}
.navbar li a:hover{
	color:red;
}
.navbar li a:focus{
	color:red;
}

@media (min-width: 768px){
.menu .navbar{
	display: flex;
	justify-content: flex-start;
}
.menu .navbar li{
	border-right:2px solid #e2e2e2;
	border-left:2px solid #ffffff;
}
.navbar li:first-child a{
	padding-left:0;
}
}
</style>