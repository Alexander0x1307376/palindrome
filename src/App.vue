<template>
<div id="app">
    <div class="header">
        <div class="svg_logo">
            <svg class="" viewBox="0 0 55 60" width="100%" height="100%">
                <path 
                    d="M0 
                    0v56h60V0zm43.6 
                    40.8h-6v-6.3l.6-11.7h-.1l-6.1 
                    18h-4l-6.1-17.9h-.1l.6 
                    11.5v6.4h-6V15.2h7.8l5.7 
                    17.9h.1l5.8-17.9h7.8z" 
                    fill="#007bff">
                </path>
            </svg>
        </div>
    </div>
    <div class="main">
        <h1 class="title">{{title}}</h1>
        <h2 class="subtitle">{{subtitle}}</h2>
        <input-field
            class="margin-top-offset"
            :placeholder="placeholder"
            :buttonText="buttonText" 
            @buttonClick="sendData"
        ></input-field>
        <item-list
            v-if="listItems != null || noResult == true"
            class="margin-top-offset-large"
            :title="searchResultMessage"
            :items="listItems"
        ></item-list>
    </div>
</div>
</template>

<script>
import routes from '@/config/routes';
import InputField from '@/components/InputField';
import ItemList from '@/components/ItemList';
import axios from 'axios';
import { log } from 'util';

export default {
    name: 'app',
    data () { return {
          // данные представления
          title: 'Приложение',
          subtitle: 'Веб-приложение, которое находит палиндромы',
          placeholder: 'палиндром',
          buttonText: 'Найти',

          // данные состояния
          noResult: false,
          listItems: null
    } },
    computed: {
        // строка, отображающая результат поиска
        searchResultMessage() {
            return this.noResult ? 
                'Не найдено ни одного палиндрома' : 
                this.declineResultMessage(this.listItems.length);
        },
        
    },
    methods: {
        sendData(value) {
            this.noResult = false;
            this.listItems = null;
            axios.post(routes.send, {
                string: value
            })
            .then(response => {
                if(response.data == 'no data')
                    this.noResult = true;
                else
                    this.listItems = response.data;
            })
        },

        // склоняем сообщение в зависимости от кол-ва найденных палиндромов
        declineResultMessage(value) {
            let mod10 = value % 10;  
            let mod100 = value % 100;
            
            if(mod10 == 1 && mod100 != 11) {
                return `Найден ${value} палиндром`;
            }
            else if ((1 < mod10 && mod10 < 5) && !(10 < mod100 && mod100 < 20)) {
                return `Найдено ${value} палиндрома`;
            } 
            else {
                return `Найдено ${value} палиндромов`;
            }
        },

    },
    components: {
        InputField,
        ItemList
    }
}
</script>

<style lang="scss">

    $col_border: rgba(236, 236, 236, 1);
    $col_button: rgba(16, 130, 210, 1);
    $col_button_text: rgba(255, 255, 255, 1);

    $width_hl: 1440px;
    $width_sm: 320px;

    $mainarea_width: 312px;

    $vertical_offset: 20px;
    $vertical_offset_large: 50px;

    #app {
        font-family: Helvetica, Arial, sans-serif;
        font-weight: normal;
    }
    .header {
        border-bottom: 1px solid $col_border;
        margin-bottom: 185px;
        height: 55px;
    }
    .svg_logo {
        margin-left: 10%;
        height: 55px;
        width: 60px;
    }
    .main {
        display: flex;
        flex-direction: column;        
        width: $mainarea_width;
        margin: 0 auto;      
    }
    .title {
        display: block;
        font-size: 30px;
        padding: 2.8px 0px;
        margin: 0px;
        font-weight: bolder;
    }
    .subtitle {
        display: block;
        font-size: 14px;
        padding: 1.1px 0px;
        margin: 0px;
        font-weight: normal;
    }

    .margin-top-offset {
        margin-top: $vertical_offset;
    }

    .margin-top-offset-large {
        margin-top: $vertical_offset_large;    
    }

    // элементы управления
    .input {
        border: 1px solid $col_border;
        padding: 10.6px;
        font-size: 14px; 
    }

    .button {
        font-size: 15px;
        padding: 11.2px;
        background-color: $col_button;
        color: $col_button_text;
        border: 0;
        cursor: pointer;
    }


    // for small screen size
    @media screen and (max-width: $width_sm) {
        #app {
            color: red;
        }
    }
</style>

