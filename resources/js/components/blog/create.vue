<template>
    <div class="card">
        <div class="card-header">
            Menambahkan Blog
        </div>
        <div class="card-body">
            <form @submit.prevent="CreateBlog">
                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" v-model="title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Content</label>
                    <textarea class="form-control" id="" cols="30" rows="10" v-model="content"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Image</label>
                    <input type="file" name="" id="" class="form-control" @change="imageChange">
                    <h4 v-if="imageObject" class="text-center font-bold mt-2">Upload Terbaru</h4>
                    <img :src="imageObject" alt="" class="img-thumbnail">
                </div>
                <div class="form-group">
                    <label for="">Kategori</label>
                    <select name="" id="" class="form-control" v-model="category_id">
                        <option value="">Pilih Kategori</option>
                        <option v-for="(category) in categories" :key="category.id" :value="category.id">
                            {{ category.name }}
                        </option>
                    </select>
                </div>
                <button class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            categories: {},
            title:'',
            content:'',
            image:'',
            category_id:'',
            url:'',
            imageObject:''
        }
    }, 
    created(){
        let uriCategory = `/api/category`;
        this.axios.get(uriCategory).then((response) => {
            this.categories = response.data.categories;
        });
    },
    methods : {
        imageChange(e){
            let file = e.target.files[0];
            this.url = file;
            this.imageObject = URL.createObjectURL(file);
        },
        CreateBlog()
        {
            let uri = `/api/create/blog`;
            let BlogData = new FormData();
            if(this.title == null){
                this.$swal.fire("Silahkan Masukan Judul Blog");
            }else{
                BlogData.append("title",this.title);
                BlogData.append("content",this.content);
                BlogData.append("category_id",this.category_id);
                BlogData.append("image",this.url);
                this.axios.post(uri,BlogData).then((response) => {
                    this.$swal.fire("Berhasil");
                    this.$router.push({ name : 'blog'});
                })
            }
        }
    }
}
</script>