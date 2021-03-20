<template>
    <div class="card">
        <div class="card-header">
            Daftar Kategori
        </div>
        <div class="card-body">
            <router-link :to="{ name : 'category-create'}" class="btn btn-success">Menambahkan</router-link>
            <table class="table">
                <thead>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Action</th>
                </thead>
                <tbody v-for="(category, index) in categories" :key="category.id">
                    <td> {{ index+1 }}</td>
                    <td>{{ category.name }}</td>
                    <td>
                        <router-link class="btn btn-info text-white" :to="{ name: 'category-edit',params:{'id':category.id}}">Edit</router-link>
                        <button class="btn btn-danger" @click="DeleteCategory(category.id, category.name)">Hapus</button>
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
            categories: {}
        }
    },
    created() {
        let uriCategory = `/api/category`;
        this.axios.get(uriCategory).then((response) => {
            this.categories = response.data.categories;
        });
    },
    methods: {
        DeleteCategory(id,name){
            this.$swal.fire({
                title: 'Hapus Kategori ' + name,
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: `Yes`,
                denyButtonText: `Don't save`,
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                   let uri = `/api/delete/category/` + id;
                   this.axios.post(uri).then((response) => {
                       this.$swal.fire("Berhasil Menghapus");
                       this.categories = response.data.categories;
                   })
                } else if (result.isDenied) {
                    this.$swal.fire('Changes are not saved', '', 'info')
                }
            })
        }
    }
}
</script>