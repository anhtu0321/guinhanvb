<template>
    <div id="gui">
        <div class="gui">
            <!-- <div class="search">Form tìm kiếm</div> -->
            <div class="form">
				<div class="title">GỬI VĂN BẢN NỘI BỘ</div>
				<div class="form__content">
					<form @submit.prevent="guivanban()">
						<div class="row mb-3">
							<div class="col-md-4">
								<label for="loaivanban" class="form-label col-3">Loại Văn bản</label>
								<select class="form-control" id="loaivanban" v-model="loai">
									<option value="0">-- Không chọn --</option>
									<option v-for="list in listLoai" :key="list.id" :value="list.id">{{list.ten_loai}}</option>
								</select>
							</div>
							<div class="col-md-4">
								<label for="so" class="form-label col-3">Số văn bản</label>
								<input type="text" class="form-control" id="so" v-model="so">
							</div>
							<div class="col-md-4">
								<label for="domat" class="form-label col-3">Độ mật</label>
								<select class="form-control" id="domat" v-model="domat">
									<option value="0">Không mật</option>
									<option value="1">Mật</option>
									<option value="2">Tối mật</option>
									<option value="3">Tuyệt mật</option>
								</select>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-md-12">
								<label for="trichyeu" class="form-label col-3">Trích yếu</label>
								<!-- <input type="text" class="form-control" id="trichyeu" v-model="trichyeu"> -->
								<input type="text" class="form-control" v-model="trichyeu" :class="{'is-invalid':(errors && errors.trich_yeu)}" @focus="removeErr">
                            	<p class="thongbao" v-if="errors && errors.trich_yeu">{{ errors.trich_yeu[0] }}</p>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-md-4">
								<label for="file" class="form-label col-3">File đính kèm</label>
								<input type="file" class="form-control" id="file" @change="getFile">
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-md-12">
								<label for="donvinhan" class="form-label col-3">Đơn vị nhận</label>
								<div class="khoi">
									<div class="title-donvi"><input type="checkbox" id="bgd-check" @change="checkbgd"> <label for="bgd-check">Ban Giám đốc</label></div>
									<div class="items">
										<div class="item mb-3" v-for="list in bgd" :key="list.id">
											<input type="checkbox" :value="list.id" v-model="donvinhan" :id="list.id" @change="changecheck"> <label :for="list.id">{{list.ten_phong}}</label> 
										</div>
									</div>
								</div>
								
								<donvicheck :lists="xdll" :idtitle="'xdlltitle'" :title="'Khối Xây dựng lực lượng'" @loadDonViNhan="donvixdll" ></donvicheck>
								<donvicheck :lists="kan" :idtitle="'kantitle'" :title="'Khối An ninh'" @loadDonViNhan="donvikan"></donvicheck>
								<donvicheck :lists="kcs" :idtitle="'kcstitle'" :title="'Khối Cảnh sát'" @loadDonViNhan="donvikcs"></donvicheck>
								<donvicheck :lists="kh" :idtitle="'khtitle'" :title="'Khối huyện, thị, thành'" @loadDonViNhan="donvikh"></donvicheck>
									
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-md-12">
								<label for="ghichu" class="form-label col-3">Ghi chú</label>
								<input type="email" class="form-control" id="ghichu" v-model="ghichu">
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-md-12">
								<button type="submit" class="btn btn-primary">Gửi văn bản</button>
							</div>
						</div>
					</form>
				</div>
            </div>
        </div>
    </div>
</template>

<script>
import donvicheck from './donvicheck.vue';
export default {
	data(){
		return{
			loai:0,
			so:'',
			domat:0,
			trichyeu:'',
			file:'',
			donvinhan:[],
			dvxdll:[],
			dvkan:[],
			dvkcs:[],
			dvkh:[],
			ghichu:'',
			listLoai:'',
			listDataDonVi:[],
			errors:'',
		}
	},
	computed:{
		bgd(){
			return this.listDataDonVi.filter(function(e){
				return e.khoi == 1;
			});
		},
		xdll(){
			return this.listDataDonVi.filter(function(e){
				return e.khoi == 2;
			});
		},
		kan(){
			return this.listDataDonVi.filter(function(e){
				return e.khoi == 3;
			});
		},
		kcs(){
			return this.listDataDonVi.filter(function(e){
				return e.khoi == 4;
			});
		},
		kh(){
			return this.listDataDonVi.filter(function(e){
				return e.khoi == 5;
			});
		}  
	},
	methods:{
		loadData(){
			axios.get('/guinhanvb/api/getDonViNoPage')
			.then(res=>{
				this.listDataDonVi = res.data;
			})
			.catch( e=>{
				this.loadData();
				console.log('da loi');
			})
		},
		loadLoai(){
			axios.get("/guinhanvb/api/getListLoaiFrontEnd")
			.then(res=>{
				this.listLoai = res.data;
			})
			.catch(e=>{
				this.loadLoai();
				console.log('da loi load loai van ban');
			})
		},
		checkbgd(){
			var check = document.getElementById('bgd-check');
			if(check.checked == false){
				this.donvinhan=[];
			}else{
				this.donvinhan = this.bgd.map(e=>{
					return e.id;
				})
			}
		},
		changecheck(){
			var check = document.getElementById('bgd-check');
			var length = this.donvinhan.length;
			var lengthbgd = this.bgd.length;
			if(length == lengthbgd){
				check.checked = true;
			}else{
				check.checked = false;
			}
		},
		donvixdll(data){
			this.dvxdll = data;
		},
		donvikan(data){
			this.dvkan = data;
		},
		donvikcs(data){
			this.dvkcs = data;
		},
		donvikh(data){
			this.dvkh = data;
		},
		getFile(e){
			if(e.target.files[0] != undefined){
				this.file = e.target.files[0];
			}else{
				this.file = "";
			}
		},
		guivanban(){
			var donviall = this.donvinhan.concat(this.dvxdll, this.dvkan, this.dvkcs, this.dvkh);
			let data = new FormData;
			data.append('loai', this.loai);
			data.append('so', this.so);
			data.append('do_mat', this.domat);
			data.append('trich_yeu', this.trichyeu);
			data.append('file', this.file);
			for(let i = 0;i< donviall.length;i++){
				data.append('donvinhan[]', donviall[i]);
			};
			axios.post('/guinhanvb/guivanban', data)
			.then(res=>{
				console.log(res);
			})
			.catch(err=>{
				this.errors = err.response.data.errors;
				console.log(this.errors);
			});
		},
		removeErr(){
            this.errors ='';
        },
	},
	created(){
		this.loadLoai();
		this.loadData();
	},
	components:{donvicheck}
}
</script>

<style scoped>
#gui{
	width:100%;
}
.gui{
	max-width: 1390px;
	margin:0 auto;
	padding:0 30px;
}
.title{
	font-family: Arial, Helvetica, sans-serif;
	font-size:1.3rem;
	padding:10px 0;
}
.title-donvi{
	font-weight: bold;
	color:#00abe4;
}
.title-donvi label{
	padding:10px 0;
	cursor: pointer;
}
.items{
	position: relative;
	display: flex;
	flex-wrap: wrap;
	justify-content: center;
}
.item{
	display: flex;
	justify-content: start;
	flex-basis: 23%;
	align-items: center;
	font-size: 1.1rem;
}
.item input{
	margin-right:5px;
}
.item label{
	cursor: pointer;
}
.thongbao{
	font-family: Arial, Helvetica, sans-serif;
	color:crimson;
	font-size:0.8rem;
	margin-top: 5px;
}
.is-invalid{
	border-color: #dc3545;
	padding-right: calc(1.5em + 0.75rem);
	background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
	background-repeat: no-repeat;
	background-position: right calc(0.375em + 0.1875rem) center;
	background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);                    
}
</style>