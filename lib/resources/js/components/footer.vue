<template>
	<div id="footer">
		<div class="footer">
			<div class="footer__top">
				<div class="footer__left">
					<p>PHẦN MỀM GỬI NHẬN VĂN BẢN</p>
					<P>CÔNG AN TỈNH HƯNG YÊN</P>
					<P>Số 45 Hải Thượng Lãn Ông, Hiến Nam, TP Hưng Yên</P>
					<P>SĐT: 069.2849.100</P>
				</div>
				<div class="footer__right">
					<img src="/guinhanvb/lib/public/images/cand.png" alt="">
				</div>
			</div>
			<div class="footer__bottom">
				Bản quyền thuộc Phòng Tham mưu - Công an tỉnh Hưng Yên
			</div>
		</div>
	</div>
</template>

<script>
export default {

}
</script>

<style scoped>
#footer{
	width:100%;
	min-height:200px;
	background:#24272e;
}
.footer{
	max-width: 1390px;
	margin:0 auto;
	padding:0 20px;
}
.footer__top{
	padding:25px 0;
	display: flex;
	justify-content: space-between;
}
.footer__top p{
	margin:0;
	padding:0;
	line-height: 30px;
	color: #8b8e96;
	font-weight: bold;
}
.footer__top p:first-child{
	margin-bottom:15px;
	font-size: 1.2rem;
	font-weight: bold;
	color: rgb(255, 255, 255);
}
.footer__right img{
	width:150px;
}
.footer__bottom{
	border-top:1px solid #373a43;
	height:60px;
	line-height: 60px;
	color: #8b8e96;
	font-weight: bold;
	font-size:0.8rem;
}
</style>