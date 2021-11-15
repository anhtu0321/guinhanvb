<template>
	<div id="header">
		<div class="header">
			<div class="header__logo">
				<img src="/guinhanvb/lib/public/images/cand.png" alt="">
			</div>
			<div class="header__center">
				<div class="header__search">
					<input type="text" class="form-control" placeholder="Tìm kiếm đơn vị..."/>
					<button class="btn"><i class="fas fa-search"></i></button>
				</div>
				<div class="header__help">
					<i class="fas fa-blender-phone"></i>
					<div class="help__phone">
					
						<a>Hỗ trợ:</a>
						<a>069.2849.100</a>
					</div> 
				</div>
			</div>
			<div class="header__name">

				PHẦN MỀM GỬI NHẬN VĂN BẢN

			</div>

		</div>
		
	</div>
</template>

<script>
export default {

}
</script>

<style scoped>
#header{
  width:100%;
  height:90px;
  padding:0;
  margin:0;
  font-family: 'Montserrat';
}
.header{
	width:100%;
	line-height:90px;
	max-width:1390px;
	margin:0 auto;
	padding:0 30px;
	font-weight: bold;
	display: flex;
	justify-content: space-between;
	align-items: center;
}
.header__center{
	height:42px;
	display: flex;
	width:45%;
	justify-content: space-between;
	align-items: center;
	display:none;
}
.header__search{
	height:42px;
	display: flex;
	align-items: stretch;
	width:70%;
	border:1px solid #333333;
	border-radius: 42px;
	overflow: hidden;
	display: none;
}
.header__help{
	height:42px;
	width: 25%;
	display: flex;
	justify-content: space-between;
	align-items: center;
	position:relative;
	display:none;
}
.header__help i{
	font-size: 2.5rem;
}
.header__help .help__phone{
	width:70%;
	height:42px;
	display: flex;
	flex-direction: column;
	justify-content: flex-start;
	padding:0;
}
.header__help::before{
	position: absolute;
	content:'';
	width:5px;
	height:5px;
	border-radius:50px;
	border:1px solid red;
	animation-name: phone_animation;
	animation-duration: 1s;
	animation-iteration-count: infinite;
}
.header__help::after{
	position: absolute;
	content:'';
	width:5px;
	height:5px;
	border-radius:50px;
	border:1px solid red;
	animation-name: phone_animation;
	animation-duration: 1s;
	animation-delay: 0.5s;
	animation-iteration-count: infinite;
}
@keyframes phone_animation {
	0%{
		opacity: 1;
		transform:scale(1);
	}
	100%{
		opacity: 0;
		transform:scale(3.3);
	}
}
.help__phone a{
	padding-left:10px;
	font-size:1rem;
	height:21px;
	line-height: 21px;
}
.help__phone a:last-child{
	color:crimson;
	font-weight: bold;
	font-size: 1.3rem;
}
.form-control{
	display: block;
	width: 100%;
	padding: 0.375rem 1.75rem;
	font-size: 1rem;
	font-weight: 400;
	line-height: 1.5;
	border:none;
	outline: 0;
}

.btn{
	padding: 0.375rem 1.75rem;
	font-size: 1.5rem;
	border:none;
	background: none;
	cursor: pointer;
}

.header__logo{
	height:100%;
	display: flex;
	align-items: center;
}
.header__logo img{
	/* background:chocolate; */
	width:70px;
	height: 60px;
}
@media (min-width: 768px){
.header__center{
	display: flex;
}	
.header__search{
	display: flex;
}
}

@media (min-width: 1200px){
.header__help{
	display: flex;
}
}
</style>

