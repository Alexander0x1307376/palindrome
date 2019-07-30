<template>
<div>
    <h2 class="itemlist_title">{{title}}</h2>
    <div v-if="!noResult">
        <ol class="itemlist_list">
            <li v-for="(item, index) in items" :key="index">{{item}}</li>
        </ol>
    </div>
</div>
</template>

<script>
export default {
    props: {
        title: { type: String },
        items: { type: Array },
        noResult: { type: Boolean }
    }
}
</script>

<style>

    .itemlist_title {
        border-bottom: 1px solid rgba(236, 236, 236, 1);
        display: block;
        font-size: 14px;

        padding-top: 1.1px;
        padding-left: 0;
        padding-right: 0;
        padding-bottom: 10px;
        font-weight: normal;
        margin: 0;
    }

    .itemlist_list {
        margin: 0;
        padding: 40px 18px 0 18px;
    }

</style>
