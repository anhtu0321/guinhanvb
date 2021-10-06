<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 list">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên Đơn vị</th>
                            <th>Ký hiệu</th>
                            <th>Đơn vị cha</th>
                            <th>Khối</th>
                            <th>Thứ tự</th>
                            <th>Trạng thái</th>
                            <th>Cập nhật</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(list, index) in listData.data" :key="list.id" :class="list.id == idEdit? 'tractive':''">
                            <td>{{index + 1}}</td>
                            <td>{{list.ten_phong}}</td>
                            <td>{{list.ky_hieu}}</td>
                            <td>{{list.donvicha != null?list.donvicha.ky_hieu:''}}</td>
                            <td>{{xulykhoi(list.khoi)}}</td>
                            <td>{{list.thu_tu}}</td>
                            <td>{{list.trang_thai == 1? "Sử dụng" : "Không sử dụng"}}</td>
                            <td>
                                <router-link class="btn btn-primary btn-sm" :to="`/loaivanban/edit/${list.id}`" @click.native="loadDataById(list.id)" v-if="ktquyen('loaivanban_sua')">Sửa</router-link>
                                <button class="btn btn-danger btn-sm" @click.prevent="deleteById(list.id)" v-if="ktquyen('loaivanban_xoa')">Xóa</button>
                            </td>
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
            idEdit:'',
        }
    },
    props:[
        'listData'
    ],
    computed:{
        listPermissionOfUser(){
			return this.$store.state.listPermissionOfUser;
		},
    },
    methods:{
        loadDataById(id){
            this.idEdit = id;
            this.$emit('loadDataById', id);
        },
        deleteById(id){
            axios.get('/guinhanvb/deleteLoaiVanBan/'+id)
            .then(res=>{
                this.$emit('deleted');
                alert('Xóa Thành công !');
            })
        },
        ktquyen(key_code){
			for(var i in this.listPermissionOfUser){
				if(this.listPermissionOfUser[i].key_code == key_code){
					return true;
				}
			}
			return false;
		},
        xulykhoi(number){
            switch (number) {
                case 1:
                    return "Ban Giám đốc"
                    break;
                case 2:
                    return "Khối Xây dựng lực lượng"
                    break;
                case 3:
                    return "Khối An ninh"
                    break;
                case 4:
                    return "Khối Cảnh sát"
                    break;
                case 5:
                    return "Khối huyện, thành phố"
                    break;
                default:
                    break;
            }
        },
    },
    mounted(){
        this.idEdit = this.$route.params.id;
    }
}
</script>

<style>
.list{
    margin:0 auto;
    margin-top:30px;
    padding:0;
}
.trang{
    margin:0 auto;
    padding:0;
}
.tractive, .tractive:hover{
    background:rgb(171, 204, 178);
}
</style>