<template>
    <div class="inputfield_component">
        <input 
            class="input"
            type="text" 
            v-model="inputModel"
            :placeholder="placeholder"
        >
        <button 
            class="button top-offset"
            @click="send"
        >{{buttonText}}</button>
    </div>
</template>

<script>
export default {
    props: {
        placeholder: {
            type: String,
        },
        buttonText: {
            type: String,
            default: 'Отправить',
        }
    },
    data() {return {
        inputModel: '',
    }},
    methods: {
        send() {
            this.$emit('buttonClick', this.inputModel)
        }
    }
}
</script>

<style scoped lang="scss">
    .inputfield_component {
        display: flex;
        flex-direction: column;
        padding: 0px;
    }

    .top-offset {
        margin-top: 20px;
    }
</style>


