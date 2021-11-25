<template>
    <div id="nhan">
        <div class="nhan">
			<div class="chuanhan">
				<div class="title">DANH SÁCH VĂN BẢN CHƯA NHẬN</div>
				<table class="table table-light">
					<thead class="thead-light">
						<tr>
							<th>#</th>
							<th>Đơn vị gửi</th>
							<th>Loại văn bản</th>
							<th>Số văn bản</th>
							<th>Độ mật</th>
							<th>Trích yếu</th>
							<th>Ghi chú</th>
							<th>File</th>
							<th><input type="checkbox" @change="checkAll"> All</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(list, index) in this.listChuaNhan" :key="list.id" >
							<td>{{index + 1}}</td>
							<td>{{list.ky_hieu}}</td>
							<td>{{list.ten_loai}}</td>
							<td>{{list.so}}</td>
							<td>{{getNameDoMat(list.do_mat)}}</td>
							<td>{{list.trich_yeu}}</td>
							<td>{{list.ghi_chu}}</td>
							<!--  tính toán để lấy đuôi file và hiện icon -->
							<td v-if="['doc', 'docx', 'xls', 'xlsx'].includes(catDuoiFile(list.file))">
								<a style="cursor: pointer;" @click="warning">
									<img width="25px" src="/guinhanvb/lib/public/images/word-icon.png">
								</a>
							</td>
							<td v-else-if="['pdf'].includes(catDuoiFile(list.file))">
								<a style="cursor: pointer;" @click="warning">
									<img width="25px" src="/guinhanvb/lib/public/images/pdf-icon.png">
								</a>
							</td>
							<td v-else-if="['jpg', 'jpeg', 'png'].includes(catDuoiFile(list.file))">
								<a style="cursor: pointer;" @click="warning">
									<img width="25px" src="/guinhanvb/lib/public/images/img-icon.png">
								</a>
							</td>
							<td v-else-if="(list.file == '') || (list.file == null) "></td>
							<td v-else>
								<a style="cursor: pointer;" @click="warning">
									<img width="25px" src="/guinhanvb/lib/public/images/blank-file-icon.png">
								</a>
							</td>
							<!-- end -->
							<td><input type="checkbox" :value="list.id" v-model="vanbannhan"></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="form">
				<form @submit.prevent="kynhan">
					<div class="row mb-3">
						<div class="col-md-5">
							<label for="hoten" class="form-label">Họ tên</label>
							<input id="hoten" class="form-control" type="text" v-model="hoten">
						</div>
						<div class="col-md-5">
							<label for="sdt" class="form-label">Số điện thoại</label>
							<input id="sdt" class="form-control" type="text" v-model="sdt">
						</div>
						<div class="col-md-2">
							<button class="btn btn-primary mt-4" style="width:100%;" type="submit">Ký nhận</button>
						</div>
					</div>
				</form>
			</div>
			<div class="danhan">
				<div class="title">DANH SÁCH VĂN BẢN ĐÃ KÝ NHẬN</div>
				<table class="table table-light">
					<thead class="thead-light">
						<tr>
							<th>#</th>
							<th>Đơn vị gửi</th>
							<th>Loại văn bản</th>
							<th>Số văn bản</th>
							<th>Độ mật</th>
							<th>Trích yếu</th>
							<th>Ghi chú</th>
							<th>Người nhận</th>
							<th>File</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(list, index) in this.listNhan" :key="list.id" >
							<td>{{index + 1}}</td>
							<td>{{list.ky_hieu}}</td>
							<td>{{list.ten_loai}}</td>
							<td>{{list.so}}</td>
							<td>{{getNameDoMat(list.do_mat)}}</td>
							<td>{{list.trich_yeu}}</td>
							<td>{{list.ghi_chu}}</td>
							<td>{{list.nguoi_nhan}}</td>
							<!--  tính toán để lấy đuôi file và hiện icon -->
							<td v-if="['doc', 'docx', 'xls', 'xlsx'].includes(catDuoiFile(list.file))">
								<a :href="`/guinhanvb/lib/public/vanbangui/${ list.file }`">
									<img width="25px" src="/guinhanvb/lib/public/images/word-icon.png">
								</a>
							</td>
							<td v-else-if="['pdf'].includes(catDuoiFile(list.file))">
								<a :href="`/guinhanvb/lib/public/vanbangui/${ list.file }`">
									<img width="25px" src="/guinhanvb/lib/public/images/pdf-icon.png">
								</a>
							</td>
							<td v-else-if="['jpg', 'jpeg', 'png'].includes(catDuoiFile(list.file))">
								<a :href="`/guinhanvb/lib/public/vanbangui/${ list.file }`">
									<img width="25px" src="/guinhanvb/lib/public/images/img-icon.png">
								</a>
							</td>
							<td v-else-if="(list.file == '') || (list.file == null) "></td>
							<td v-else>
								<a :href="`/guinhanvb/lib/public/vanbangui/${ list.file }`">
									<img width="25px" src="/guinhanvb/lib/public/images/blank-file-icon.png">
								</a>
							</td>
							<!-- end -->
							<td><i class="far fa-trash-alt btn-del" @click="delVanBanNhan(list.id)"></i></td>
						</tr>
					</tbody>
				</table>
			</div>
        </div>
    </div>
</template>

<script>
export default {
	data(){
		return{
			listNhan:[],
			listChuaNhan:[],
			vanbannhan:[],
			hoten:'',
			sdt:'',
			check:false,
		}
	},
	computed:{
		vanBanAll(){
			return this.listChuaNhan.map(function(e){
				return e.id;
			});
		},
	},
	methods:{
		listVanBanNhan(){
			axios.get('/guinhanvb/getListNhan')
			.then(res=>{
				this.listNhan = res.data.data;
			})
			.catch(e=>{
				this.listVanBanNhan();
			})
		},
		listVanBanChuaNhan(){
			axios.get('/guinhanvb/getListChuaNhan')
			.then(res=>{
				this.listChuaNhan = res.data;
			})
			.catch(e=>{
				this.listVanBanChuaNhan();
			})
		},
		getNameDoMat(domat){
            switch (domat) {
                case 1:
                    return "C";
                    break;
                case 2:
                    return "B";
                    break;
                case 3:
                    return "A";
                    break;
                default:
                    return "-";
                    break;
            }
		},
		catDuoiFile(filename){
			let vitri = filename.lastIndexOf('.') + 1;
			let duoi = filename.slice(vitri);
			return duoi;
		},
		checkAll(){
			if(this.check == false){
				this.check = true;
				this.vanbannhan = this.vanBanAll;
			}else{
				this.check = false;
				this.vanbannhan = [];
			}
		},
		warning(){
			swal('Bạn phải ký nhận mới được phép tải file');
		},
		kynhan(){
			let data = new FormData();
			data.append('hoten', this.hoten);
			data.append('sdt', this.sdt);
			for( let i = 0; i< this.vanbannhan.length; i++){
				data.append('vanbannhan[]', this.vanbannhan[i]);
			}
			axios.post('/guinhanvb/kynhan', data)
			.then(res=>{
				swal(
					'Ký nhận thành công!',
					{icon: "success",}
				);
				this.listVanBanNhan();
				this.listVanBanChuaNhan();
			})
			.catch()
		},
		delVanBanNhan(id){
			swal({
				title: "XÓA VĂN BẢN NHẬN ?",
				text: "Văn bản đã xóa sẽ không thể khôi phục lại !",
				icon: "warning",
				buttons: true,
				dangerMode: true,
				})
				.then((willDelete) => {
				if (willDelete) {
					axios.get('/guinhanvb/delVanBanNhan/'+id)
					.then(res=>{
						swal("Văn bản đã bị xóa!", {
							icon: "success",
						});
						// this.loadList(this.currentPage);
						this.listVanBanNhan();
					})
					.catch()
					
				} else {
					swal("Đã hủy xóa văn bản!");
				}
			});
		},
	},
	created(){
		this.listVanBanNhan();
		this.listVanBanChuaNhan();
	}
}
</script>

<style scoped>
	#nhan{
		width:100%;
	}
	.nhan{
		max-width: 1390px;
		margin:0 auto;
		padding:0 30px;
	}
	.title{
		font-family: 'Montserrat';
		font-size:1.3rem;
		padding:10px 0;
	}
	
</style>

