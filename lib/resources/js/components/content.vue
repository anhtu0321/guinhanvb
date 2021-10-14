<template>
	<div id="content">
		<div class="content">
			<div id="bgd" class="content__box">
				<div class="box__title">BAN GIÁM ĐỐC</div>
				<div class="box__items">
					<div v-for="list in bgd" :key="list.id" class="item">
						<div  class="item__info" @click="showModal(list.ten_phong)">
							{{ list.ten_phong }}
							<span class="item__total">12</span>
						</div>
					</div>
				</div>
			</div>
			<div id="xdll" class="content__box">
				<div class="box__title">KHỐI XÂY DỰNG LỰC LƯỢNG</div>
				<div class="box__items">
					<div v-for="list in xdll" :key="list.id" class="item">
						<donvi :list="list"></donvi>
					</div>
				</div>
			</div>
			<div id="kan" class="content__box">
				<div class="box__title">KHỐI AN NINH</div>
				<div class="box__items">
					<div v-for="list in kan" :key="list.id" class="item">
						<donvi :list="list"></donvi>
					</div>
				</div>
			</div>
			<div id="kcs" class="content__box">
				<div class="box__title">KHỐI CẢNH SÁT</div>
				<div class="box__items">
					<div v-for="list in kcs" :key="list.id" class="item">
						<donvi :list="list"></donvi>
					</div>
				</div>
			</div>
			<div id="kh" class="content__box">
				<div class="box__title">KHỐI HUYỆN, THỊ, THÀNH</div>
				<div class="box__items">
					<div v-for="list in kh" :key="list.id" class="item">
						<donvi :list="list"></donvi>
					</div>
				</div>
			</div>
		</div>
		<!-- test thử modal -->

		<!-- Modal -->
		<div class="modal" v-show="modal" @click="hideModal()">
			<div class="modal-dialog">
				<div class="btn-close" @click="hideModal()">
					<i class="fas fa-times"></i>
				</div>
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">{{ten_phong}}</h5>
					</div>
					<div class="modal-body">
						<form>
							<div class="form-group">
								<label for="inputPassword" >Mật khẩu</label>
								<div class="col-sm-10">
									<input type="password" class="form-control" id="inputPassword" placeholder="Password">
								</div>
							</div>
							<div class="form-group text-center">
								<button type="submit" class="btn btn-primary">Đăng nhập</button>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" @click="hideModal()">Close</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import donvi from './contents/donvi.vue';
export default {
	data(){
		return {
			listData:[],
			modal: false,
			ten_phong:'',
		}
	},
	computed:{
		bgd(){
			return this.listData.filter(function(e){
				return e.khoi == 1;
			});
		},
		xdll(){
			return this.listData.filter(function(e){
				return e.khoi == 2;
			});
		},
		kan(){
			return this.listData.filter(function(e){
				return e.khoi == 3;
			});
		},
		kcs(){
			return this.listData.filter(function(e){
				return e.khoi == 4;
			});
		},
		kh	(){
			return this.listData.filter(function(e){
				return e.khoi == 5;
			});
		}  
	},
	methods:{
		loadData(){
			axios.get('/guinhanvb/api/getDonViNoPage')
			.then(res=>{
				this.listData = res.data;
			})
		},
		hideModal(){
			this.modal = false;
		},
		showModal(ten_phong){
			this.ten_phong = ten_phong.toUpperCase();
			this.modal = true;
		},
		keepModal(){
			var dialog = document.getElementsByClassName('modal-dialog')[0];
			dialog.addEventListener('click', function(event){
			event.stopPropagation();
		});
		}
	},
	components:{
		donvi
	},
	created(){
		this.loadData();
	},
	mounted(){
		this.keepModal();
	}
}
</script>

<style scoped>
#content{
	width:100%;
	min-height:800px;
	margin-bottom:50px;
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
/* css cho modal */
.modal {
  position: fixed;
  top: 0;
  left: 0;
  z-index: 1055;
  width: 100%;
  height: 100%;
  overflow-x: hidden;
  overflow-y: auto;
  outline: 0;
  background: rgba(0, 0, 0, 0.4);
  display: flex;
  align-items: center;
  justify-content: center;
}
.modal-dialog {
  	position: relative;
	width:500px;
	max-width:calc(100% - 50px);
	background: #ffffff;
	margin-top:-300px;
	border-radius:calc(0.5rem - 1px);
	box-shadow: 1px 2px 5px #3f3f3f;
	animation: modalFadeIn ease .5s;
}
 .modal-header {
	font-family: Arial, Helvetica, sans-serif;
	display: flex;
	align-items: center;
	justify-content: space-between;
	padding: 1.5rem 1rem;
	border-bottom: 1px solid #dee2e6;
	border-top-left-radius: calc(0.5rem - 1px);
	border-top-right-radius: calc(0.5rem - 1px);
	background: #aa1717;
}
.modal-dialog .btn-close {
	position: absolute;
	right: 0.5rem;
	top: 0.5rem;
	padding: 0.5rem 0.5rem;
	margin: -0.5rem -0.5rem -0.5rem auto;
	cursor: pointer;
	color: rgb(255, 255, 255);

}
.modal-title {
	margin-bottom: 0;
	line-height: 1.5;
	color:#ffffff;
	font-size: 1.3rem;
	text-align: center;
}
.modal-body {
	position: relative;
	padding: 1.75rem 1rem;
}
.modal-body .form-group{
	width:100%;
}
.form-group .form-control{
	width:100%;
	padding: 0.75rem 0.75rem;
	margin: 24px 24px 24px auto;
	border: 1px solid #c5c5c5;
	border-radius: 0.3rem;
	box-sizing: border-box;
}
.form-group .form-control:focus{
	border: 2px solid #d44330;
	margin:23px 23px 23px auto;
	outline:none;
}
.form-group .btn{
	width:100%;
}
.modal-footer {
	display: flex;
	flex-wrap: wrap;
	flex-shrink: 0;
	align-items: center;
	justify-content: flex-start;
	padding: 0.75rem;
	border-top: 1px solid #dee2e6;
	border-bottom-right-radius: calc(0.3rem - 1px);
	border-bottom-left-radius: calc(0.3rem - 1px);
}
.modal-footer > * {
  	margin: 0.25rem;
} 
@keyframes modalFadeIn{
	from{
		opacity: 0;
		transform: translateY(-100px);
	}
	to{
		opacity:1;
		transform: translateY(0px);
	}
}
</style>