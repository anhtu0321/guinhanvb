<template>
    <div id="gui">
        <div class="gui">
            <!-- <div class="search">Form tìm kiếm</div> -->
			<!-- Form gửi văn bản -->
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
								<label for="donvinhan" class="form-label col-3 label-donvinhan" @click="show=!show">Đơn vị nhận</label>
								<span class="btn" @click="show=!show">
									<i class="fas fa-caret-down" v-if="show==false"></i>
									<i class="fas fa-caret-up" v-else></i>
								</span>
								<transition name="showdonvinhan">
									<div class="donvinhan" v-show="show">
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
								</transition>
								
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
			<!-- Danh sách văn bản gửi -->
			<div class="title">DANH SÁCH VĂN BẢN GỬI</div>
				<table class="table table-hover">
					<thead>
						<tr>
						<th scope="col">#</th>
						<th scope="col">Số văn bản</th>
						<th scope="col">Trích yếu</th>
						<th scope="col">Đơn vị nhận</th>
						<th scope="col"></th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(list,index) in lists" :key="list.id">
							<th scope="row">{{index + 1}}</th>
							<td>{{list.so}}</td>
							<td>{{list.trich_yeu}}</td>
							<td 
								v-html="hien5DonVi(list.donvis)" 
								@mouseover="showNoiDungAn('noidungan'+list.id)" 
								@mouseout="hideNoiDungAn('noidungan'+list.id)" 
								@click="showKyNhan(list.donvis)"
								style="cursor:pointer; font-weight:bold;">
							</td>
							<td></td>
							<div class="noidungan" :id="'noidungan'+list.id" v-html="hienTatDonVi(list.donvis)"></div>
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
</template>

<script>
import donvicheck from './gui/donvicheck.vue';
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
			show:false, //dùng để ẩn hiện đơn vị nhận
			lists:'', //dữ liệu danh sách văn bản gửi
			//data for page
			last_pages:'',
			currentPage: 1,
			offset: 4,
			from:1,
			to:1,
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
		loadData(){
			axios.get('/guinhanvb/api/getDonViNoPage')
			.then(res=>{
				this.listDataDonVi = res.data;
			})
			.catch( e=>{
				this.loadData();
				console.log('da loi load data');
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
		loadList(page){
			axios.get('/guinhanvb/getListGui?page='+page)
			.then(res=>{
				this.lists = res.data.data;
				this.last_pages = res.data.last_page;
			})
			.catch(e=>{
				this.loadList();
				console.log('da loi load van ban gui');
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
		//Khi click nút gửi
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
		// Xử lý danh sách văn bản gửi
		hien5DonVi(data){
			var str = '';
			var soDonVi = 0;
			var duoi = '';
			if(data.length <= 5){
				soDonVi = data.length;
			}else{
				soDonVi = 5;
				duoi = '...'
			}
			for(let i = 0; i<soDonVi; i++){
				let phancach = '';
				if(i == soDonVi-1){phancach = '.';}else{phancach =',';}
				if(data[i].ky_nhan == '1'){
					str += ' '+'<span style="color:green">'+data[i].ky_hieu + phancach +'</span>';
				}else{
					str += ' '+'<span style="color:red">'+data[i].ky_hieu + phancach +'</span>';
				}
			}
			return str+' '+duoi;
		},
		hienTatDonVi(data){
			var str = '';
			
			for(let i = 0; i<data.length; i++){
				let phancach = '';
				if(i == data.length-1){phancach = '.';}else{phancach =',';}
				if(data[i].ky_nhan == '1'){
					str += ' '+'<span style="color:green">'+data[i].ky_hieu + phancach +'</span>';
				}else{
					str += ' '+'<span style="color:red">'+data[i].ky_hieu + phancach +'</span>';
				}
			}
			return str;
		},
		showNoiDungAn(id){
			var ele = document.getElementById(id);
			ele.style.display = "block";
			function move(e){	
				let x = (window.Event) ? e.pageX : event.clientX + (document.documentElement.scrollLeft ? document.documentElement.scrollLeft : document.body.scrollLeft);
				let y = (window.Event) ? e.pageY : event.clientY + (document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop);
				ele.style.left=(x+20)+"px";
				ele.style.top= (y)+"px";
			}
			document.onmousemove=move;
		},
		hideNoiDungAn(id){
			document.getElementById(id).style.display = 'none';
		},
		// click để hiện thông tin người ký
		showKyNhan(data){
			console.log(data);
		},
		// Xử lý khi click vào nút trang
		setPage(newPage){
			this.currentPage = newPage;
			this.loadList(this.currentPage);
		},
		prev(){
			if(this.currentPage > 1){
				this.currentPage--;
				this.loadList(this.currentPage);
			}
		},
		next(){
			if(this.currentPage < this.last_pages){
				this.currentPage++;
				this.loadList(this.currentPage);
			}
		}
	},
	created(){
		this.loadLoai();
		this.loadData();
		this.loadList();
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
	font-family: 'Montserrat';
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
.showdonvinhan-enter-active, .showdonvinhan-leave-active {
  transition: opacity .7s;
}
.showdonvinhan-enter, .showdonvinhan-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
.label-donvinhan{
	cursor: pointer;
}
.label-donvinhan:hover{
	color:brown;
	font-weight: bold;
}
.pagination{
	display: flex;
	justify-content: end;
	margin-bottom:50px;
}
.noidungan{
	display: none;
	position:absolute;
	width:300px;
	overflow: hidden;
	background:white;
	box-shadow: 1px 2px 6px rgb(122, 121, 121);
	padding: 10px;
	border-radius: 3px;
	font-weight: bold;
}
</style>