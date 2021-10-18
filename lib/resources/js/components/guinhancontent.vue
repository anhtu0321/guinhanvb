<template>
    <div>
        <div id="guinhan">
            <div class="guinhan">
                <label class="guinhan__name">{{ ten_phong }}</label>
                <ul class="navbar">
                    <li><a href="#" @click.prevent="show('gui')" :class="menu=='gui'? 'active':''">Gửi văn bản</a></li>
                    <li><a href="#" @click.prevent="show('nhan')" :class="menu=='nhan'? 'active':''">Nhận văn bản</a></li>
                    <li><a href="#">Đổi mật khẩu</a></li>
                    <li><a href="#">Đăng xuất</a></li>
                </ul>
            </div>
        </div>
        <guivanban v-if="menu=='gui'"></guivanban>
        <nhanvanban v-if="menu=='nhan'"></nhanvanban>
    </div>
    
</template>

<script>
import guivanban from './guinhan/guivanban.vue';
import nhanvanban from './guinhan/nhanvanban.vue';
export default {
    data(){
        return{
            id:'',
            ten_phong:'',
            menu:'nhan',
        }
    },
    methods:{
        show(menu){
            this.menu = menu;
        }
    },
    created(){
        axios.get('/guinhanvb/guinhantheodonvi')
        .then(res=>{
            this.id = res.data.id;
            this.ten_phong = res.data.ten_phong;
        })
        .catch(error=>{

        })
    },
    components:{guivanban, nhanvanban}
}

</script>
<style scoped>
#guinhan{
    width:100%;
	background:#f7f8fa;
}
.guinhan{
    max-width:1390px;
	margin:0 auto;
	padding:0 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom:1px solid #ece6a9;
    overflow: hidden;
}
.guinhan__name{
    font-weight: bold;
	font-size: 1.6rem;
}
.guinhan .navbar{
	list-style: none;
}
.guinhan .navbar li{
	height:50px;
	line-height:50px;
}
.guinhan .navbar li:first-child{
	border-left:none;
}
.guinhan .navbar li:last-child{
	border-right:none;
}
.navbar li a{
	display: block;
	padding:0 20px;
	font-weight: bold;
}
.navbar li a:hover{
	color:red;
}
.navbar li a:focus{
	color:red;
}
.active{
    color:red;
}
@media (min-width: 768px){
.guinhan .navbar{
	display: flex;
	justify-content: flex-start;
}
.guinhan .navbar li{
	border-right:2px solid #e2e2e2;
	border-left:2px solid #ffffff;
}
.navbar li:first-child a{
	padding-left:0;
}
}
</style>

