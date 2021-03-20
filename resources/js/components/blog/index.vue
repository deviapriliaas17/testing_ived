<template>
    <div class="card">
        <div class="card-header">
            Daftar Blog
        </div>
        <div class="card-body">
            <router-link :to="{ name : 'blog-create'}" class="btn btn-success mb-2">Tambahkan</router-link>
            <table class="table">
                <thead>
                    <th>No</th>
                    <th>Title</th>
                    <th>Kategori</th>
                    <th>Action</th>
                </thead>
                <tbody v-for="(blog, index) in blogs" :key="blog.id">
                    <td> {{ index+1}}</td>
                    <td>{{ blog.title }}</td>
                    <td>{{ blog.category.name }}</td>
                    <td>
                        <router-link :to="{ name: 'blog-edit', params: { 'id' : blog.key}}" class="btn btn-info">Edit</router-link>
                        <button class="btn btn-danger" @click="DeleteBlog(blog.key, blog.title)">Hapus</button>
                        <router-link :to="{ name: 'blog-detail', params: { 'id' : blog.key}}" class="btn btn-warning">Detail</router-link>
                    </td>
                </tbody>
            </table>
        </div>

    </div>
</template>

<script>
export default {
    data(){
        return {
            blogs: {},
            detail: {}
        }
    },
    created() {
        let uriBlog = `/api/blog`;
        this.axios.get(uriBlog).then((response) => {
            this.blogs = response.data.blogs;
        });
    },
    methods:{
        DeleteBlog(id, title){
            this.$swal.fire({
                title: 'Hapus Judul ' + title,
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: `Hapus`,
                denyButtonText: `Tidak Hapus`,
                }).then((result) => {
                if (result.isConfirmed) {
                    let uri = `/api/delete/blog/` + id; 
                    this.axios.post(uri).then((response) => {
                        this.$swal.fire("Berhasil");
                        this.blogs = response.data.blogs;
                    })
                } else if(result.isDenied) {
                    this.$swal.fire('Changes are not saved', '', 'info')
                }
            })
        },
    }
}
</script>