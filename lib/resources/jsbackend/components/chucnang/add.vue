<template>
	<div v-if="ktquyen('chucnang_xem')">
		<content-header :tieude="tieude" :link="link"></content-header>
        <section class="content">
    		<div class="container-fluid">
				<div class="row">
					<div class="col-md-10 main">
						<!-- form -->
						<form method="post" @submit.prevent="add">

							<div class="form-row">
								<div class="form-group col-md-4">
									<label class="col-form-label col-form-label-sm">Tên chức năng</label>
									<input type="text" class="form-control form-control-sm" 
										:class="{'is-invalid' : (error && error.name)}" 
										v-model="name">
									<p class="thongbao" v-if="error && error.name">{{ error.name[0]}}</p>
								</div>
								<div class="form-group col-md-4">
									<label class="col-form-label col-form-label-sm">Tên Đầy đủ</label>
									<input type="text" class="form-control form-control-sm" 
										:class="{'is-invalid' : (error && error.display_name)}" 
										v-model="display_name">
									<p class="thongbao" v-if="error && error.display_name">{{ error.display_name[0]}}</p>
								</div>
								<div class="form-group col-md-4">
									<label class="col-form-label col-form-label-sm">Key Code</label>
									<input type="text" class="form-control form-control-sm" 
										:class="{'is-invalid' : (error && error.key_code)}" 
										v-model="key_code">
									<p class="thongbao" v-if="error && error.key_code">{{ error.key_code[0]}}</p>
								</div>
							</div>

							<div class="form-row">
								<div class="form-group col-md-5">
									<label class="col-form-label col-form-label-sm">Chức năng cha</label>
									<select class="form-control form-control-sm" 
										:class="{'is-invalid' : (error && error.parent_id)}" 
										v-model="parent_id">
										<option value="0">Chọn chức năng cha</option>
										<option v-for="listCha in chuc_nang_cha" :key="listCha.id" :value="listCha.id">{{listCha.name}}</option>
									</select>
									<p class="thongbao" v-if="error && error.parent_id">{{ error.parent_id[0]}}</p>
								</div>
								
							</div>
							<div class="form-group col-md-12 text-right">
								<button type="submit" class="btn btn-primary btn-sm" v-if="ktquyen('chucnang_them')">Thêm chức năng</button>
							</div>

					</form>
					<!-- end form -->
					</div>
				</div>
			</div>
  		</section>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-10 list">
					<list :listData='listData' @deleted="loadData()"></list>
				</div>
			</div>
		</div>
		<div class="row">
            <div class="col-md-10 trang justify-content-end">
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
			tieude:'THÊM CHỨC NĂNG',
			link:'Thêm',
			name:'',
			display_name:'',
			key_code:'',
			parent_id:0,
			error:'',
			listData:'',
			chuc_nang_cha:'',
		}
	},
	computed:{
		listPermissionOfUser(){
			return this.$store.state.listPermissionOfUser;
		},
		page(){
			return this.$store.state.pageChucNang;
		}
    },
	methods:{
		add(){
			let data = new FormData;
			data.append('name', this.name);
			data.append('display_name', this.display_name);
			data.append('key_code', this.key_code);
			data.append('parent_id', this.parent_id);
			axios.post('/guinhanvb/addChucNang', data)
			.then(response=>{
				this.name = '';
				this.display_name = '';
				this.key_code = '';
				this.error = '';
				this.listChucNangCha();
				this.loadData();
			})
			.catch(error=>{
				this.error = error.response.data.errors;
			});
		},
		listChucNangCha(){
			axios.get('/guinhanvb/api/listChucNangCha')
			.then(response=>{
				this.chuc_nang_cha = response.data;
			})
		},
		loadData(){
			axios.get('/guinhanvb/api/getListChucNang?page='+this.page)
            .then(response=>{
				this.listData = response.data;
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
		this.listChucNangCha();
		this.loadData();
	}
}
</script>

<style scoped>
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
.list{
    margin:0 auto;
    margin-top:30px;
    padding:0;
}
</style>