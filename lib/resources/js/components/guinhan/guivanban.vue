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
								<input type="text" class="form-control" id="trichyeu" v-model="trichyeu">
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-md-4">
								<label for="file" class="form-label col-3">File đính kèm</label>
								<input type="file" class="form-control" id="file">
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-md-12">
								<label for="donvinhan" class="form-label col-3">Đơn vị nhận</label>
								<div class="khoi">
									<div class="title-donvi"><input type="checkbox"> Ban Giám đốc</div>
									<div class="items">
										<div class="item" v-for="list in bgd" :key="list.id">
											<input type="checkbox" :value="list.id" v-model="donvinhan"> {{list.ten_phong}}
										</div>
									</div>
								</div>
								<div class="khoi">
									<div class="title-donvi"><input type="checkbox"> Khối Xây dựng lực lượng</div>
									<div class="items">
										
										<donvicheck :lists="xdll" @loadDonViNhan="donvixdll"></donvicheck>
										
									</div>
								</div>
								<div class="khoi">
									<div class="title-donvi"><input type="checkbox"> Khối An ninh</div>
									<div class="items">
										<div class="item" v-for="list in kan" :key="list.id">
											<donvicheck :list="list" @loadDonViNhan="donvikan"></donvicheck>
										</div>
									</div>
								</div>
								<div class="khoi">
									<div class="title-donvi"><input type="checkbox"> Khối Cảnh sát</div>
									<div class="items">
										<div class="item" v-for="list in kcs" :key="list.id">
											<donvicheck :list="list" @loadDonViNhan="donvikcs"></donvicheck>
										</div>
									</div>
								</div>
								<div class="khoi">
									<div class="title-donvi"><input type="checkbox"> Khối huyện, thị, thành</div>
									<div class="items">
										<donvicheck :lists="kh" @loadDonViNhan="donvikh"></donvicheck>
									</div>
								</div>
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
		},
		loadLoai(){
			axios.get("/guinhanvb/api/getListLoaiFrontEnd")
			.then(res=>{
				this.listLoai = res.data;
			})
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
		guivanban(){
			var donviall = this.donvinhan.concat(this.dvxdll, this.dvkan, this.dvkcs, this.dvkh);
			console.log(donviall);
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
	padding:10px 0;
	color:#00abe4;
}
</style>