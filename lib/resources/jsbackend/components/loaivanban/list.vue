<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 list">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên loại</th>
                            <th>Thứ tự</th>
                            <th>Trạng thái</th>
                            <th>Cập nhật</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(list, index) in listData.data" :key="list.id" :class="list.id == idEdit? 'tractive':''">
                            <td>{{index + 1}}</td>
                            <td>{{list.ten_loai}}</td>
                            <td>{{list.thu_tu}}</td>
                            <td>{{list.trang_thai == 1? "Sử dụng" : "Không sử dụng"}}</td>
                            <td>
                                <router-link class="btn btn-primary btn-sm" :to="`/loaivanban/edit/${list.id}`" @click.native="loadDataById(list.id)">Sửa</router-link>
                                <button class="btn btn-danger btn-sm" @click.prevent="deleteById(list.id)" >Xóa</button>
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
        }
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