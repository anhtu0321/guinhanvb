<template>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên hiển thị</th>
                <th>Tài khoản</th>
                <th>Phân quyền</th>
                <th>Cập nhật</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(list, index) in listData.data" :key="list.id" :class="list.id == idEdit? 'tractive':''">
                <td>{{index + 1}}</td>
                <td>{{list.fullname}}</td>
                <td>{{list.username}}</td>
                <td>
                    <span v-for="role in list.roles" :key="role.id">{{ role.name }}, </span>
                </td>
                <td>
                    <router-link class="btn btn-primary btn-sm" :to="`/taikhoan/edit/${list.id}`" @click.native="loadDataById(list.id)" v-if="ktquyen('taikhoan_sua')">Sửa</router-link>
                    <button class="btn btn-danger btn-sm" @click.prevent="deleteData(list.id)" v-if="ktquyen('taikhoan_xoa')">Xóa</button>
                </td>
            </tr>
        </tbody>
    </table>

</template>

<script>
export default {
    data(){
        return{
            idEdit:'',
        }
    },
    props:['listData'],
    computed:{
		listPermissionOfUser(){
			return this.$store.state.listPermissionOfUser;
        }
    },
    methods:{
        loadDataById(id){
            this.idEdit = this.$route.params.id;
            this.$emit('loadDataById', id);
        },
        deleteData(id){
            if(confirm('ban muon xoa that a ?') == true){
                axios.get(`/guinhanvb/deleteTaiKhoan/${id}`)
                .then(reponse=>{
                    this.$emit('deleted');
                    alert('Xóa Thành công !');
                })
            }
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
    mounted(){
        this.idEdit = this.$route.params.id;
    }
}
</script>

<style>

.tractive, .tractive:hover{
    background:rgb(171, 204, 178);
}
</style>