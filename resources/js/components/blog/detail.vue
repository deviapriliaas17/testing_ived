<template>
        <div class="card">
            <div class="card-header">Blog</div>
            <div class="card-body">
                <div class="card-title">
                    <h2 class="text-center">{{ blog.title }}</h2>
                </div>
                <div class="card-text">
                    <img :src="'/uploads/images/' + blog.image" alt="" class="img-thumbnail">
                    {{ blog.content }}
                </div>
            </div>
        </div>
</template>

<script>
export default {
    data(){
        return {
            blog:{}
        }
    },
    created(){
        let uri = `/api/blog/ ${this.$route.params.id}`;
        this.axios.get(uri).then((response) => {
            this.blog = response.data.blog;
        });
    }
}
</script>