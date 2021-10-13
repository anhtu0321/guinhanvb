<template>
	<div v-if="ktquyen('donvi_xem')">
		<content-header :tieude="tieude" :link="link"></content-header>
        <section class="content">
    		<div class="container-fluid">
				<div class="row">
					<div class="col-md-8 main">
						<form method="post" @submit.prevent="add">

							<div class="form-row">
								<div class="form-group col-md-5">
									<label class="col-form-label col-form-label-sm">Tên đơn vị</label>
									<input type="text" class="form-control form-control-sm" 
										:class="{'is-invalid' : (error && error.ten_phong)}" 
										v-model="ten_phong">
									<p class="thongbao" v-if="error && error.ten_phong">{{ error.ten_phong[0]}}</p>
								</div>
								<div class="form-group col-md-2">
									<label class="col-form-label col-form-label-sm">Ký hiệu</label>
									<input type="text" class="form-control form-control-sm" 
										:class="{'is-invalid' : (error && error.ky_hieu)}" 
										v-model="ky_hieu">
									<p class="thongbao" v-if="error && error.ky_hieu">{{ error.ky_hieu[0]}}</p>
								</div>
								<div class="form-group col-md-2">
									<label class="col-form-label col-form-label-sm">Đơn vị cha</label>
									<select v-model="parent_id" class="form-control form-control-sm" 
										:class="{'is-invalid' : (error && error.parent_id)}">
										<option value="0">-- Không --</option>
										<option v-for="list in listDonViCha" :key="list.id" :value="list.id">{{list.ky_hieu}}</option>
									</select>
									<p class="thongbao" v-if="error && error.parent_id">{{ error.parent_id[0]}}</p>
								</div>
							</div>

							<div class="form-row">
								<div class="form-group col-md-5">
									<label class="col-form-label col-form-label-sm">Khối</label>
									<select class="form-control form-control-sm" 
										:class="{'is-invalid' : (error && error.khoi)}" 
										v-model="khoi">
										<option value="0">-- Không --</option>
										<option value="1">Ban Giám đốc</option>
										<option value="2">Khối Xây dựng lực lượng</option>
										<option value="3">Khối An ninh</option>
										<option value="4">Khối Cảnh sát</option>
										<option value="5">Khối huyện, thành phố</option>
									</select>
									<p class="thongbao" v-if="error && error.khoi">{{ error.khoi[0]}}</p>
								</div>
								<div class="form-group col-md-2">
									<label class="col-form-label col-form-label-sm">Thứ tự</label>
									<input type="text" class="form-control form-control-sm" 
										:class="{'is-invalid' : (error && error.thu_tu)}" 
										v-model="thu_tu">
									<p class="thongbao" v-if="error && error.thu_tu">{{ error.thu_tu[0]}}</p>
								</div>
								<div class="form-group col-md-3">
									<label class="col-form-label col-form-label-sm">Trạng thái</label>
									<select class="form-control form-control-sm" v-model="trang_thai">
										<option value="1">Sử dụng</option>
										<option value="0">Không Sử dụng</option>
									</select>
								</div>
							</div>
							<div class="form-group col-md-12 text-right">
								<button type="submit" class="btn btn-primary btn-sm" v-if="ktquyen('donvi_them')">Thêm đơn vị</button>
							</div>

						</form>
					</div>
				</div>
				
			</div>
  		</section>
		<list :listData='listData' @deleted="loadData()"></list>
		<div class="row">
            <div class="col-md-8 trang justify-content-end">
                <paginate :last_pages="listData.last_page" @loadData="loadData"></paginate>
            </div>
        </div>
		
	</div>
	<div v-else>
		<div class="container-fluid">
			<div class="row">
				<div class="mt-2 mr-2 alert" style="font-size:2rem; color:red">
					Bạn không có quyền xem mục này !
				</div>
			</div>
		</div>
	</div>

</template>

<script>
// import các components
import contentHeader from '../content_header.vue'
import list from './list.vue'
import paginate from './page.vue'
export default {
	data(){
		return{
			tieude:'THÊM ĐƠN VỊ',
			link:'Thêm',
			ten_phong:'',
            ky_hieu:'',
            khoi:0,
            thu_tu:'',
            trang_thai:1,
            parent_id:0,
			listData:'',
			listDonViCha:'',
			error:'',
		}
	},
	computed:{
		listPermissionOfUser(){
			return this.$store.state.listPermissionOfUser;
		},
		page(){
			return this.$store.state.pageDonVi;
		}
    },
	methods:{
		add(){
			let data = new FormData;
			data.append('ten_phong', this.ten_phong);
			data.append('ky_hieu', this.ky_hieu);
			data.append('khoi', this.khoi);
			data.append('parent_id', this.parent_id);
			data.append('thu_tu', this.thu_tu);
			data.append('trang_thai', this.trang_thai);
			axios.post('/guinhanvb/addDonVi', data)
			.then(response=>{
				this.ten_phong = '';
				this.ky_hieu = '';
				this.thu_tu = '';
				this.error = '';
				this.loadData(this.page);
				this.loadDonViCha();
			})
			.catch(error=>{
				this.error = error.response.data.errors;
			});
			
		},
		loadData(){
			axios.get('/guinhanvb/api/getDonVi?page='+this.page)
            .then(response=>{
				this.listData = response.data;
            })
		},
		loadDonViCha(){
			axios.get('/guinhanvb/api/getDonViCha')
            .then(response=>{
				this.listDonViCha = response.data;
            })
		},
		ktquyen(key_code){
			for(var i in this.listPermissionOfUser){
				if(this.listPermissionOfUser[i].key_code == key_code){
					return true;
				}
			}
			return false;
		}
	},
	components:{contentHeader, list, paginate},
	created(){
		this.loadData(this.page);
		this.loadDonViCha();
	}
}
</script>

<style>
.main{
	margin:0 auto;
	box-shadow: -5px -5px 10px #ffffffe3, 5px 5px 8px rgba(94, 104, 121, 0.288);
	border-radius: 10px;
	padding:15px;
}
.thongbao{
	color:crimson;
	font-size:0.8rem;
	margin:0;
}

</style>