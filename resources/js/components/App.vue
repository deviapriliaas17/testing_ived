<template>
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    Menu
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <router-link :to="{ name: 'category'}">Category</router-link>
                        </li>
                        <li class="list-group-item">
                            <router-link :to="{ name: 'blog'}">Blog</router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-8">
            <router-view></router-view>
        </div>
    </div>
</template>