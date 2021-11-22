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
							<th>Số văn bản</th>
							<th>Độ mật</th>
							<th>Trích yếu</th>
							<th>Ghi chú</th>
							<th>File</th>
							<th><input type="checkbox" @change="checkAll"> All</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(list, index) in this.chuaNhan" :key="list.id" >
							<td>{{index + 1}}</td>
							<td>{{list.vanbannhans.don_vi_gui}}</td>
							<td>{{list.vanbannhans.so}}</td>
							<td>{{list.vanbannhans.do_mat}}</td>
							<td>{{list.vanbannhans.trich_yeu}}</td>
							<td>{{list.vanbannhans.ghi_chu}}</td>
							<td>{{list.vanbannhans.file}}</td>
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
							<th>Số văn bản</th>
							<th>Độ mật</th>
							<th>Trích yếu</th>
							<th>Ghi chú</th>
							<th>File</th>
							<th><input type="checkbox" @change="checkAll"> All</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(list, index) in this.daNhan" :key="list.id" >
							<td>{{index + 1}}</td>
							<td>{{list.vanbannhans.don_vi_gui}}</td>
							<td>{{list.vanbannhans.so}}</td>
							<td>{{list.vanbannhans.do_mat}}</td>
							<td>{{list.vanbannhans.trich_yeu}}</td>
							<td>{{list.vanbannhans.ghi_chu}}</td>
							<td>{{list.vanbannhans.file}}</td>
							<td><input type="checkbox" :value="list.id" v-model="vanbannhan"></td>
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
			vanbannhan:[],
			hoten:'',
			sdt:'',
			check:false,
		}
	},
	computed:{
		chuaNhan(){
			return this.listNhan.filter(function(e){
				return (e.ky_nhan == null && e.vanbannhans != undefined);
			});
		},
		daNhan(){
			return this.listNhan.filter(e=>{
				return e.ky_nhan == '1';
			});
		},
		vanBanAll(){
			return this.listNhan.map(function(e){
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
		checkAll(){
			if(this.check == false){
				this.check = true;
				this.vanbannhan = this.vanBanAll;
			}else{
				this.check = false;
				this.vanbannhan = [];
			}
		},
		kynhan(){
			let data = new FormData();
			data.append('hoten', this.hoten);
			data.append('sdt', this.sdt);
			for( let i = 0; i< this.vanbannhan.length; i++){
				data.append('vanbannhan[]', this.vanbannhan[i]);
			}
			axios.post('/guinhanvb/kynhan', data)
			.then()
			.catch()
		}
	},
	created(){
		this.listVanBanNhan();
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

