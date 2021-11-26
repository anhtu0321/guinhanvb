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
							<label for="hoten" class="form-label">Họ tên <span class="thongbao">( * )</span></label>
							<input id="hoten" class="form-control" type="text" v-model="hoten" :class="{'is-invalid':(errors && errors.hoten)}" @focus="removeErr">
							<p class="thongbao" v-if="errors && errors.hoten">{{ errors.hoten[0] }}</p>
						</div>
						<div class="col-md-5">
							<label for="sdt" class="form-label">Số điện thoại <span class="thongbao">( * )</span></label>
							<input id="sdt" class="form-control" type="text" v-model="sdt" :class="{'is-invalid':(errors && errors.sdt)}" @focus="removeErr">
							<p class="thongbao" v-if="errors && errors.sdt">{{ errors.sdt[0] }}</p>
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
				<!-- phân trang ở dưới -->
				
					<ul class="pagination justify-content-end">
						<li class="page-item" @click.prevent="prev()"><a class="page-link" href="#">Previous</a></li>
						<li class="page-item" :class="{'active': currentPage==page}" @click.prevent="setPage(page)" v-for="page in pagesNumber" :key="page"><a class="page-link" href="#">{{ page }}</a></li>
						<li class="page-item" @click.prevent="next()"><a class="page-link" href="#">Next</a></li>
					</ul>
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
			// bắt lỗi
			errors:'',
			//data for page
			last_pages:'',
			currentPage: 1,
			offset: 4,
			from:1,
			to:1,
			// Tự động load văn bản nhận
			autoLoad:'',
		}
	},
	computed:{
		vanBanAll(){
			return this.listChuaNhan.map(function(e){
				return e.id;
			});
		},
		// xử lý mảng số trang
		pagesNumber() {
			if(this.last_pages == null){return [];}
			if(this.last_pages<=this.offset*2+1){
				this.from = 1;
				this.to = this.last_pages;
			}else{
				if(this.currentPage <= this.offset){
					this.from = 1;
					this.to = 1 + this.offset*2;
					if(this.to > this.last_pages){
						this.to = this.last_pages;
					}
				}
				if((this.currentPage> this.offset) && (this.currentPage <= this.last_pages - this.offset)){
					this.from = this.currentPage - this.offset;
					this.to = this.currentPage + this.offset;
				}
				if(this.currentPage >this.last_pages - this.offset){
					this.from = this.last_pages - this.offset*2;
					this.to = this.last_pages;
				}
			}
			var pagesArray = [];
			for (var i=this.from; i <= this.to; i++) {
				pagesArray.push(i);
			}
			return pagesArray;
		},
	},
	methods:{
		listVanBanNhan(page){
			axios.get('/guinhanvb/getListNhan?page='+page)
			.then(res=>{
				this.listNhan = res.data.data;
				this.last_pages = res.data.last_page;
			})
			.catch(e=>{
				this.listVanBanNhan(page);
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
		auto(){
			this.autoLoad = setInterval(this.listVanBanChuaNhan, 30000);
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
				this.listVanBanNhan(this.currentPage);
				this.listVanBanChuaNhan();
			})
			.catch(err=>{
				this.errors = err.response.data.errors;
			})
		},
		removeErr(){
            this.errors ='';
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
						this.listVanBanNhan();
					})
					.catch()
					
				} else {
					swal("Đã hủy xóa văn bản!");
				}
			});
		},
		// Xử lý khi click vào nút trang
		setPage(newPage){
			this.currentPage = newPage;
			this.listVanBanNhan(this.currentPage);
		},
		prev(){
			if(this.currentPage > 1){
				this.currentPage--;
				this.listVanBanNhan(this.currentPage);
			}
		},
		next(){
			if(this.currentPage < this.last_pages){
				this.currentPage++;
				this.listVanBanNhan(this.currentPage);
			}
		}
	},
	created(){
		this.listVanBanNhan(this.currentPage);
		this.listVanBanChuaNhan();
		this.auto();
	},
	beforeDestroy(){
		clearInterval(this.autoLoad);
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

