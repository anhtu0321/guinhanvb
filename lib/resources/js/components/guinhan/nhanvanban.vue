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
							<th><input type="checkbox" @change="check = !check"></th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(list, index) in this.chuanhan" :key="list.id">
							<td>{{index + 1}}</td>
							<td>{{list.vanbannhans.don_vi_gui}}</td>
							<td>{{list.vanbannhans.so}}</td>
							<td>{{list.vanbannhans.do_mat}}</td>
							<td>{{list.vanbannhans.trich_yeu}}</td>
							<td>{{list.vanbannhans.ghi_chu}}</td>
							<td>{{list.vanbannhans.file}}</td>
							<td><input type="checkbox" v-mode="vanbannhan"></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="form">
				<form method="post" action="">
					<div class="row mb-3">
						<div class="col-md-5">
							<label for="hoten" class="form-label">Họ tên</label>
							<input id="hoten" class="form-control" type="text" name="">
						</div>
						<div class="col-md-5">
							<label for="sdt" class="form-label">Số điện thoại</label>
							<input id="sdt" class="form-control" type="text" name="">
						</div>
						<div class="col-md-2">
							<button class="btn btn-primary mt-4" style="width:100%;" type="button">Ký nhận</button>
						</div>
					</div>
				</form>
			</div>
			<div class="danhan">
				<div class="title">DANH SÁCH VĂN BẢN ĐÃ KÝ NHẬN</div>
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
			check:false,
		}
	},
	computed:{
		chuanhan(){
			// console.log(this.listNhan);
			return this.listNhan.filter(function(e){
				return e.ky_nhan == null;
			});
		},
		danhan(){
			return this.listNhan.filter(e=>{
				return e.ky_nhan == '1';
			});
		}
	},
	methods:{
		listVanBanNhan(){
			axios.get('/guinhanvb/getListNhan')
			.then(res=>{
				this.listNhan = res.data.data;
			})
			.catch(e=>{
				this.listVanBanNhan;
			})
		},
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

