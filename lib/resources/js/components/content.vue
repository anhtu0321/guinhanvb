<template>
	<div id="content">
		<div class="content">
			<div class="content__box">
				<div class="box__title">BAN GIÁM ĐỐC</div>
				<div class="box__items">
					<div class="item">
						<button class="btn">Giám đốc</button>
					</div>
					<div class="item">
						<button class="btn">Đ/c Phạm Văn Đôn - PGĐ</button>
					</div>
					<div class="item">
						<button class="btn">Đ/c Nguyễn Xuân Hồng - PGĐ</button>
					</div>
					<div class="item">
						<button class="btn">Đ/c Nguyễn Văn Mừng - PGĐ</button>
					</div>
					<div class="item">
						<button class="btn">Đ/c Nguyễn Thành Sơn - PGĐ</button>
					</div>
					<div class="item">
						<button class="btn">Đ/c Nguyễn Trường Lâm - PGĐ</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {

}
</script>

<style scope>
#content{
	width:100%;
}
#content .content{
	max-width: 1390px;
	margin:0 auto;
	padding:0 30px;
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
	justify-content: center;
	flex-wrap: wrap;
}
.item{
	flex-basis: 45%;
	margin:2.5%;
	border-right:1px solid bisque;
}
.item:last-child{
	border:none;
	min-height:120px;

}
@media (min-width: 768px){
.item{
	flex-basis: 22%;
	margin:1.5%;
}
}
@media (min-width: 1200px){
.item{
	flex-basis: 15%;
	margin:0.833333%;
}
}
</style>