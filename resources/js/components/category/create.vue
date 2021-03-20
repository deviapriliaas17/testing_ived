<template>
    <div class="card">
        <div class="card-header">
            Menambahkan Kategori Blog
        </div>
        <div class="card-body">
            <form @submit.prevent="CreateCategory">
                <div class="form-group">
                    <label for="">Nama Kategori</label>
                    <input type="text" class="form-control" v-model="category.name">
                </div>
                <button class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            category:{
                name:null
            }
        }
    },
    methods: {
        CreateCategory(){
            let uri = `/api/create/category`;
            if(this.category.name == null){
                this.$swal.fire("Mohon Masukan Nama Kategori");
            }else{
                this.axios.post(uri, this.category).then((response) => {
                    this.$swal.fire("Berhasil");
                    this.$router.push({ name: 'category'});
                });
            }
        }
    }
}
</script>