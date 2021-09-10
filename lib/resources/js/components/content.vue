<template>
	<div id="content">
		<div class="content">
			<div id="bgd" class="content__box">
				<div class="box__title">BAN GIÁM ĐỐC</div>
				<div class="box__items">
					<div class="item">
						<div class="item__info">
							Giám đốc
							<span class="item__total">12</span>
						</div>
					</div>
					<div class="item">
						<div class="item__info">
							Đ/c Phạm Văn Đôn - PGĐ
							<span class="item__total">12</span>
						</div>
						
					</div>
					<div class="item">
						<div class="item__info">
							Đ/c Nguyễn Xuân Hồng - PGĐ
							<span class="item__total">12</span>
						</div>
						
					</div>
					<div class="item">
						<div class="item__info">
							Đ/c Nguyễn Văn Mừng - PGĐ
							<span class="item__total">12</span>
						</div>
						
					</div>
					<div class="item">
						<div class="item__info">
							Đ/c Nguyễn Thành Sơn - PGĐ
							<span class="item__total">12</span>
						</div>
						
					</div>
					<div class="item">
						<div class="item__info">
							Đ/c Nguyễn Trường Lâm - PGĐ
							<span class="item__total">12</span>
						</div>
						
					</div>
				</div>
			</div>
			<div id="xdll" class="content__box">
				<div class="box__title">KHỐI XÂY DỰNG LỰC LƯỢNG</div>
				<div class="box__items">
					<donvi></donvi>
					<donvi></donvi>
					
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import donvi from './contents/donvi.vue';
export default {
	components:{
		donvi
	}
}
</script>

<style scope>
#content{
	width:100%;
	min-height:800px;
}
#content .content{
	max-width: 1390px;
	margin:0 auto;
	padding:0 20px;
}
.box__title{
	width:100%;
	padding:10px;
	padding-left:0;
	margin:10px 0;
	font-weight: bold;
	font-size: 1.8rem;
}
.box__items{
	display: flex;
	justify-content: start;
	flex-wrap: wrap;
}
.item{
	flex-basis: 45%;
	margin:2.5%;
	display: flex;
	justify-content: start;
	align-items: baseline;
}

.item .item__info{
	margin-left:10px;
	font-size:1.1rem;
	font-weight: bold;
	color:#ffffff;
	background: #00abe4;
	padding:5px 15px;
	border-radius:5px;
	border:1px solid #dadada;
	cursor: pointer;
	position: relative;
}
.item .item__info:hover{
	color:#fff9bd;
}
.item .item__total{
	position: absolute;
	width:25px;
	height: 25px;
	padding:5px;
	border-radius: 50%;
	background: crimson;
	color: white;
	top:-10px;
	right:-10px;
	font-size: 0.8rem;
	font-weight: 600;
	display: flex;
	justify-content: center;
	align-items: center;
}
.btn{
	padding:5px;
	background:white;
	border:1px solid #dadada;
	cursor: pointer;
}
@media (min-width: 768px){
.item{
	flex-basis: 30%;
	margin:1.666%;
}
}
@media (min-width: 1200px){
.item{
	flex-basis: 23%;
	margin:1%;
}
}
</style>