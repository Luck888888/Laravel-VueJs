<template>
    <div className="row mt-5">
        <div className="col-12 p-3">
            <img :src="article.img" class="border rounded mx-auto d-block" alt="...">
            <h5 className="mt-5">{{ article.title }}</h5>
            <p>
        <span className="tag" v-for="(tag,index) in article.tags">
            <span v-if="tagsLen == (index+1)">{{ tag.label }}</span>
            <span v-else>{{ tag.label }} | </span>
        </span>
            </p>
            <p className="card-text">{{ article.body }}</p>
            <p>Опубликованно: <i>{{ article.created_at }}</i></p>
            <div className="mt-3">
                <views-component></views-component>
                <likes-component></likes-component>
            </div>
        </div>
    </div>
</template>

<script>
import {mapState} from 'vuex'

export default {
    computed: mapState({
        // article: 'article',
        article: state => state.article.article,
        tagsLen: state => state.article.article.tags.length,
    }),
    mounted() {
        console.log('Component article mounted.')
    }
}
</script>

<style scoped>


</style>
