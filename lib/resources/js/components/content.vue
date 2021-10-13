<template>
	<div id="content">
		<div class="content">
			<div id="bgd" class="content__box">
				<div class="box__title">BAN GIÁM ĐỐC</div>
				<div class="box__items">
					<div v-for="list in bgd" :key="list.id" class="item">
						<div  class="item__info">
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
		<div class="modal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">TÊN ĐƠN VỊ Ở ĐÂY</h5>
						<button type="button" class="btn-close"><i class="fas fa-times"></i></button>
					</div>
					<div class="modal-body">
						<form>
							<div class="form-group row">
								<label for="inputPassword" class="col-sm-2 col-form-label">Mật khẩu</label>
								<div class="col-sm-10">
								<input type="password" class="form-control" id="inputPassword" placeholder="Password">
								</div>
							</div>
							<button type="submit" class="btn btn-primary">Đăng nhập</button>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary">Close</button>
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
				console.log(res.data);
			})
		}
	},
	components:{
		donvi
	},
	created(){
		this.loadData();
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
	border-radius:5px;
	box-shadow: 1px 2px 5px #3f3f3f;
}
.modal-header {
  display: flex;
  flex-shrink: 0;
  align-items: center;
  justify-content: space-between;
  padding: 1rem 1rem;
  border-bottom: 1px solid #dee2e6;
  border-top-left-radius: calc(0.3rem - 1px);
  border-top-right-radius: calc(0.3rem - 1px);
}
.modal-header .btn-close {
  padding: 0.5rem 0.5rem;
  margin: -0.5rem -0.5rem -0.5rem auto;
}

.modal-title {
  margin-bottom: 0;
  line-height: 1.5;
}

.modal-body {
  position: relative;
  flex: 1 1 auto;
  padding: 1rem;
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

@media (min-width: 576px) {
  .modal-dialog {
    max-width: 500px;
    margin: 1.75rem auto;
  }

  .modal-dialog-scrollable {
    height: calc(100% - 3.5rem);
  }

  .modal-dialog-centered {
    min-height: calc(100% - 3.5rem);
  }

  .modal-sm {
    max-width: 300px;
  }
}
@media (min-width: 992px) {
  .modal-lg,
.modal-xl {
    max-width: 800px;
  }
}
@media (min-width: 1200px) {
  .modal-xl {
    max-width: 1140px;
  }
}
</style>