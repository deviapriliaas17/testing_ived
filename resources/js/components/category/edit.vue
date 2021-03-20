<template>
    <div class="card">
        <div class="card-header">
            Edit {{ category.name }}
        </div>
        <div class="card-body">
            <form @submit.prevent="UpdateCategory">
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
    created(){
        let uri = `/api/category/`+ this.$route.params.id;
        this.axios.get(uri).then((response) => {
            this.category = response.data.category
        });
    },
    methods: {
        UpdateCategory(){
            let uri = `/api/edit/category/` + this.$route.params.id;
            if(this.category.name == null){
                this.$swal.fire("Mohon Masukan Nama Kategori");
            }else{
                this.axios.post(uri, this.category).then((response) => {
                    this.$swal.fire("Berhasil");
                    this.$router.push({ name: 'blog'});
                });
            }
        }
    }
}
</script>