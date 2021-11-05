<template>
<div class="khoi">
	<div class="title-donvi">
		<input type="checkbox" :id="idtitle" @change="checkall"> <label :for="idtitle"> {{ title }}</label>
	</div>
	<div class="items">
		<div class="item-component">
			<div class="item" v-for="list in lists" :key="list.id">
				<span class="btn" @click="hide(list.id)" v-if="checkshow(list.id)"><i class="fas fa-minus"></i></span> 
				<span class="btn" @click="show(list.id)" v-else><i class="fas fa-plus"></i></span> 
				<div class="item__all">
					<div class="item__parent">
						<div class="item__info">
							<input type="checkbox" :value="list.id" v-model="donvicha" @change="emitData()" :id="list.id"> <label :for="list.id">{{ list.ky_hieu }}</label>
						</div>
					</div>
					<transition name="showdonvi">
						<div class="item__children" v-if="checkshow(list.id)">
							<input type="checkbox" @change="checkallchild(list.donvicon, list.id+'1')" :id="list.id+'1'"> <label :for="list.id+'1'"> Tất cả</label>
							<div v-for="listc in list.donvicon" :key="listc.id" class="item__info">
								<input type="checkbox" :value="listc.id" v-model="donvicon" @change="emitData(list.donvicon, list.id+'1')" :id="listc.id"> <label :for="listc.id"> {{ listc.ten_phong }}</label>
							</div>
						</div>
					</transition>
				</div>
			</div>
		</div>
	</div>
</div>
</template>

<script>
export default {
    data(){
        return{
			donvicha:[],
			donvicon:[],
			key:[],
        }
	},
	props:["lists","idtitle", "title"],
    methods:{
        show(key){
			this.key.push(key);
		},
		hide(key){
			this.key = this.key.filter(e=>{
				return e != key;
			});
		},
		checkshow(key){
			return this.key.includes(key);
		},
		emitData(data ,id){
			this.changecheck();
			if(data != undefined && id != undefined){
				console.log(data);
			}
			// this.changecheckchild();
			
			var data = this.donvicha.concat(this.donvicon);
			this.$emit('loadDonViNhan', data);
		},
		checkall(){
			var check = document.getElementById(this.idtitle);
			if(check != undefined){
				if(check.checked == true){
					this.donvicha = this.lists.map(e=>{
						return e.id;
					})
				}else{
					this.donvicha = [];
				}
			}
			this.emitData();
		},
		changecheck(){
			var check = document.getElementById(this.idtitle);
			if(check != undefined){
				var length = this.donvicha.length;
				var lengthlist = this.lists.length;
				if(length == lengthlist){
					check.checked = true;
				}else{
					check.checked = false;
				}
			}
		},
		checkallchild(data, id){
			var check = document.getElementById(id);
			if(check != undefined){
				let listId = data.map(e=>{
					return e.id;
				});
				if(check.checked == true){
					let dvchuatick = listId.filter(e=>{
						return this.donvicon.includes(e) == false;
					})
					this.donvicon = this.donvicon.concat(dvchuatick);
				}else{
					this.donvicon = this.donvicon.filter(e=>{
						return listId.includes(e) == false;
					});
				}
			}
			this.emitData();
		},
		changecheckchild(classname){
			var check = document.getElementsByClassName(classname);
			if(check != undefined){
				for(let i = 1; i< check.length; i++){
					if(check[i].checked == false){
						return check[0].checked = false;
					}
				}
				return check[0].checked = true;
			}
		},
    }
}
</script>

<style scoped>
.item-component{
	display: flex;
	flex-direction: row;
	flex-wrap: wrap;
	justify-content: center;
	width:100%;
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
	display:flex;
	align-items: baseline;
	justify-content: start;
	flex-basis: 22% !important;
}
.item-component label{
	cursor: pointer;
}
.item__all{
	display:flex;
	flex-direction: column;
}
.item__children{
	position:relative;
	display:flex;
	flex-direction: column;
	align-items: baseline;
	justify-content: space-evenly;
	margin-left:10px;
}
.item__children .item__info{
	margin-top:5px;
	display:flex;
	align-items: center;
}
.item__children .item__info input{
	margin-right:5px;
}
.item__children .item__info::before,.item__children .item__info::after{
	content:'';
	position:absolute;
	width:10px;
	height:50% ;
	left:-10px;
	top:-8px;
	border-left:1px solid #000000;
}
.item__children .item__info::before{
	padding-bottom:10px;
}
.item__children .item__info::after{
	top:50%;
	border-top:1px solid #000000;
}
.item__children .item__info:last-child::after{
	border-left:none;
}
.item__info{
	margin-left:10px;
	/* font-size:1.1rem; */
	/* font-weight: bold; */
	/* color:#ffffff;
	background: #00abe4; */
	/* padding:5px 15px; */
	/* border-radius:5px;
	border:1px solid #dadada; */
	position: relative;
}
.item__info:hover{
	/* color:#fff9bd; */
}
.item__total{
	position: absolute;
	width:25px;
	height: 25px;
	padding:5px;
	border-radius: 50%;
	background: crimson;
	color: white;
	top:-10px;
	right:-10px;
	font-size: 0.8rem;
	font-weight: 600;
	display: flex;
	justify-content: center;
	align-items: center;

}
.btn{
	padding:5px;
	background:white;
	border:1px solid #dadada;
	cursor: pointer;
}
@media (min-width: 768px){
.item{
	flex-basis: 30%;
	margin:1.666%;
}
}
@media (min-width: 1200px){
.item{
	flex-basis: 23%;
	margin:1%;
}
}
.showdonvi-enter-active, .showdonvi-leave-active {
  transition: opacity .5s;
}
.showdonvi-enter, .showdonvi-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>