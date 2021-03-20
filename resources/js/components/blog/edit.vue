<template>
    <div class="card">
        <div class="card-header">
            Edit Blog 
        </div>
        <div class="card-body">
            <form @submit.prevent="UpdateBlog">
                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" v-model="blog.title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Content</label>
                    <textarea class="form-control" id="" cols="30" rows="10" v-model="blog.content"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Image</label>
                    <input type="file" name="" id="" class="form-control" @change="imageChange">
                    <img  class="img-thumbnail" :src="'/uploads/images/' + blog.image" alt="">
                    <h4 v-if="imageObject" class="text-center font-bold mt-2">Upload Terbaru</h4>
                    <img :src="imageObject" alt="" class="img-thumbnail">
                </div>
                <div class="form-group">
                    <label for="">Kategori</label>
                    <select name="" id="" class="form-control">
                        <option v-for="(category) in categories" :key="category.id" :value="category.id" :selected="blog.category_id == category.id">
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
            blog:{
                title:'',
                content:'',
                image:'',
                category_id:''
            },
            url:'',
            imageObject:''
        }
    }, 
    created(){
        let uriCategory = `/api/category`;
        let uriBlog = `/api/blog/` + this.$route.params.id;
        this.axios.get(uriCategory).then((response) => {
            this.categories = response.data.categories;
        });
        this.axios.get(uriBlog).then((response) => {
            this.blog = response.data.blog;
        });
    },
    methods : {
        imageChange(e){
            let file = e.target.files[0];
            this.url = file;
            this.imageObject = URL.createObjectURL(file);
        },
        UpdateBlog()
        {
            let uri = `/api/edit/blog/`+ this.$route.params.id;
            let BlogData = new FormData();
            BlogData.append("title",this.blog.title);
            BlogData.append("content",this.blog.content);
            BlogData.append("category_id",this.blog.category_id);
            BlogData.append("image",this.url);
            this.axios.post(uri,BlogData).then((response) => {
                this.$swal.fire("Berhasil");
                this.$router.push({ name : 'blog'})
            })
        }
    }
}
</script>